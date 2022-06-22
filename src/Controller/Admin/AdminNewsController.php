<?php

namespace App\Controller\Admin;

use App\Entity\Rate;
use App\Entity\News;
use App\Entity\Region;
use App\Form\RateType;
use App\Form\NewsType;
use App\Form\RegionType;
use App\Service\FileManagerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminNewsController extends AdminBaseController
{

    /**
     * @Route("/fbt-site-admin/news", name="admin_news")
     * @return Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $request = Request::createFromGlobals();
        $forRender['title'] = 'Новости';
        $region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['admin_region']->getName()]);
        $forRender['news'] =  $em->getRepository(News::class)->findAll();/*findBy(['Region' =>
            $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['admin_region']->getName()])]);*/
        return $this->render('admin/News/index.html.twig', $forRender);
    }


    /**
     * @Route ("/fbt-site-admin/news/create", name="admin_news_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $news = $form->getData();
            $fms = new FileManagerService('uploads/news');
            $news->setImage($fms->imagePostUpload($form['Image']->getData()));
            $news->setDate(date("d.m.y"));
            $em->persist($news);
            $em->flush();
            $this->addFlash('success', 'Тариф добавлен');
            return $this->redirectToRoute('admin_news');
        }
        $forRender['form'] = $form->createView();
        return $this->render('admin/News/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/news/edit/{id}", name="admin_news_edit")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $news = $em->getRepository(News::class)->find($id);
        if($news->getImage() != null)
        {
            $forRender['image'] = $news->getImage();
        }
        else
            $forRender['image'] = null;
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $news = $form->getData();
            if($form['Image']->getData() != null)
            {
                $fms = new FileManagerService('uploads/news');
                $fms->removePostImage($form['Image']->getData());
                $news->setImage($fms->imagePostUpload($form['Image']->getData()));
            }
            $em->persist($news);
            $em->flush();
            return $this->redirectToRoute('admin_news');
        }
        return $this->render('admin/News/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/news/delete/{id}", name="admin_news_delete")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $em->getRepository(News::class)->findOneBy(['id' => $id]);
        if($news != null)
            $em->remove($news);
        $em->flush();
        return $this->redirectToRoute('admin_news');
    }
}