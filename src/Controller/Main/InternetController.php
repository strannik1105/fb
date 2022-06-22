<?php

namespace App\Controller\Main;

use App\Entity\Rate;
use App\Entity\Region;
use App\Entity\Stock;
use App\Entity\InternetAdvantages;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InternetController extends BaseController
{
    /**
     * @Route("/internet", name="internet")
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
            $cookie = new Cookie('region', $forRender['region']);
            $responce->headers->setCookie($cookie);
        }
        $forRender['internetadvantages'] = $em->getRepository(InternetAdvantages::class)->findBy(['Region' => $forRender['region']]);
        if($forRender['internetadvantages'] == null)
            $forRender['internetadvantages'] = $em->getRepository(InternetAdvantages::class)->findAll();
        $forRender['stocks'] = $em->getRepository(Stock::class)->findBy(['Region' => $region->getId()]);
        $forRender['rates'] = $em->getRepository(Rate::class)->findBy(['Type' => 'Internet', 'Region' => $region->getId()]);
        $forRender['warning'] = $region->getInternetWarning();
        return $this->render('main/internet.html.twig',$forRender, $responce);
    }
}