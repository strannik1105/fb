<?php

namespace App\Controller\Main;

use App\Entity\Region;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends BaseController
{
    /**
     * @Route("/company", name="company")
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
        $forRender['region_info'] = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['region']]);
        return $this->render('main/company.html.twig',$forRender, $responce);
    }
}