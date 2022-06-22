<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Entity\Page;
use App\Form\PageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class AdminPageController extends AdminBaseController
{
    /**
     * @Route("/fbt-site-admin/pages", name="admin_pages")
     * @return Response
     */
    public function index(){
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Страницы';
        $em = $this->getDoctrine()->getManager();
        $forRender['pages'] = $em->getRepository(Page::class)->findAll();
        return $this->render('admin/Page/index.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/pages/create_page", name="admin_page_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Создание страницы';
        $em = $this->getDoctrine()->getManager();
        $page = new Page();
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $page = $form->getData();
            $em->persist($page);
            $em->flush();
            return $this->redirectToRoute('admin_pages');
        }
        return $this->render('admin/Page/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/pages/edit_page/{id}", name="admin_page_edit")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(int $id, Request $request)
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Редактирование страницы';
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository(Page::class)->find($id);
        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $page = $form->getData();
            $em->persist($page);
            $em->flush();
        }
        return $this->render('admin/Page/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/pages/delete_page/{id}", name="admin_page_delete")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository(Page::class)->find($id);
        $em->remove($page);
        $em->flush();
        return $this->redirectToRoute('admin_pages');
    }


}