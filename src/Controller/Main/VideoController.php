<?php

namespace App\Controller\Main;


use App\Entity\Rate;
use App\Entity\Region;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends BaseController
{
    /**
     * @Route("/video", name="video")
     * @param Request $request
     */
    public function index(Request $request){
        $forRender = parent::renderDefault($request);
        $responce = new Response();
        if($forRender['region'] != null)
        {
            $cookie = new Cookie('region', $forRender['region']);
            $region = $this->getDoctrine()->getRepository(Region::class)->findBy(['Name' => $forRender['region']]);
            $forRender['rates'] = $this->getDoctrine()->getRepository(Rate::class)->findBy(['Type' => 'Video', 'Region' => $region]);
            $responce->headers->setCookie($cookie);
        }
        return $this->render('main/video.html.twig',$forRender, $responce);
    }
}