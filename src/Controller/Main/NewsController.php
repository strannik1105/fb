<?php

namespace App\Controller\Main;

use App\Entity\Region;
use App\Entity\News;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends BaseController
{
    /**
     * @Route("/news", name="news")
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
        $forRender['news'] = $this->getDoctrine()->getRepository(News::class)->findAll();
        $forRender['region_info'] = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['region']]);
        return $this->render('main/news.html.twig',$forRender, $responce);
    }
    
    /**
     * @Route("/news/{id}", name="news_item")
     * @param int $id
     * @param Request $request
     */
    public function index_item(int $id, Request $request){
        $forRender = parent::renderDefault($request);
        $responce = new Response();
        if($forRender['region'] != null)
        {
            $cookie = new Cookie('region', $forRender['region']);
            $responce->headers->setCookie($cookie);
        }
        $forRender['news'] = $this->getDoctrine()->getRepository(News::class)->find($id);
        $forRender['region_info'] = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['region']]);
        return $this->render('main/news_item.html.twig',$forRender, $responce);
    }
}