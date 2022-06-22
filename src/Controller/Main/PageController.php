<?php

namespace App\Controller\Main;

use App\Entity\Page;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends BaseController
{
    /**
     * @Route ("/page/{url}", name="page")
     * @param string $url
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(string $url, Request $request)
    {
        $forRender = parent::renderDefault($request);
        $em = $this->getDoctrine()->getManager();
        $forRender['page'] = $em->getRepository(Page::class)->findOneBy(['URL' => $url]);
        $responce = new Response();
        if($forRender['region'] != null)
        {
            $cookie = new Cookie('region', $forRender['region']);
            $responce->headers->setCookie($cookie);
        }
        return $this->render('main/page.html.twig',$forRender, $responce);
    }
}