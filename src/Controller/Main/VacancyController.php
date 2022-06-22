<?php

namespace App\Controller\Main;

use App\Entity\Region;
use App\Entity\VacantPosition;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VacancyController extends BaseController
{
    /**
     * @Route("/vacancy", name="vacancy")
     * @param Request $request
     */
    public function index(Request $request){
        $forRender = parent::renderDefault($request);
        $responce = new Response();
        $region = null;
        if($forRender['region'] != null)
        {
            $region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['region']]);
            $cookie = new Cookie('region', $forRender['region']);
            $responce->headers->setCookie($cookie);
        }

        $forRender['vacancy'] = $this->getDoctrine()->getRepository(VacantPosition::class)->findBy(['Region' => $region]);
        return $this->render('main/vacancy.html.twig',$forRender, $responce);
    }
}