<?php

namespace App\Controller\Main;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\SupportQuestion;

class SupportController extends BaseController
{
    /**
     * @Route("/support", name="support")
     * @param Request $request
     */
    public function index(Request $request){
        $forRender = parent::renderDefault($request);
        $responce = new Response();
        if($forRender['region'] != null)
        {
            $cookie = new Cookie('region', $forRender['region']);
            $responce->headers->setCookie($cookie);
        }
        $forRender['supportquestions'] = $this->getDoctrine()->getRepository(SupportQuestion::class)->findAll();
        return $this->render('main/support.html.twig',$forRender, $responce);
    }
}