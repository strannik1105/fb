<?php

namespace App\Controller\Main;

use App\Entity\Region;
use App\Entity\GeneralInformation;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends BaseController
{
    /**
     * @Route("/", name="home")
     * @param Request $request
     */
    public function index(Request $request){
        $forRender = parent::renderDefault($request);
        $responce = new Response();
        $region = $forRender['region'];
        $region = $request->cookies->get('region');
        $i = new GeneralInformation();
        //if($region != null)
        {
            $cookie = new Cookie('region', $region);
            $responce->headers->setCookie($cookie);
        }
        return $this->render('main/index.html.twig',$forRender, $responce);
    }
}