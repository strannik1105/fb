<?php

namespace App\Controller\Main;

use App\Entity\Rate;
use App\Entity\Region;
use App\Entity\TVBanner;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TVController extends BaseController
{
    /**
     * @Route("/tv", name="tv")
     * @param Request $request
     */
    public function index(Request $request){
        $forRender = parent::renderDefault($request);
        $em = $this->getDoctrine()->getManager();
        $responce = new Response();
        $region = null;
        if($forRender['region'] != null)
        {
            $region = $em->getRepository(Region::class)->findOneBy(['Name' => $forRender['region']]);
            $forRender['rates'] = $this->getDoctrine()->getRepository(Rate::class)->findBy(['Type' => 'TV', 'Region' => $forRender['region']]);
            $cookie = new Cookie('region', $forRender['region']);
            $responce->headers->setCookie($cookie);
        }
        $forRender['tvbs'] = $em->getRepository(TVBanner::class)->findAll();
        $forRender['rates'] = $em->getRepository(Rate::class)->findBy(['Type' => 'TV', 'Region' => $region->getId()]);
        return $this->render('main/tv_new.html.twig',$forRender, $responce);
    }
    
    /*
    public function index(Request $request){
        $forRender = parent::renderDefault($request);
        $em = $this->getDoctrine()->getManager();
        $responce = new Response();
        $region = null;
        if($forRender['region'] != null)
        {
            $region = $em->getRepository(Region::class)->findOneBy(['Name' => $forRender['region']]);
            $forRender['rates'] = $this->getDoctrine()->getRepository(Rate::class)->findBy(['Type' => 'TV', 'Region' => $forRender['region']]);
            $cookie = new Cookie('region', $forRender['region']);
            $responce->headers->setCookie($cookie);
        }
        $forRender['rates'] = $em->getRepository(Rate::class)->findBy(['Type' => 'TV', 'Region' => $region->getId()]);
        return $this->render('main/tv.html.twig',$forRender, $responce);
    }*/
}