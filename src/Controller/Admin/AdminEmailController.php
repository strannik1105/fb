<?php

namespace App\Controller\Admin;

use App\Entity\Email;
use App\Form\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class AdminEmailController extends AdminBaseController
{
    /**
     * @Route("/fbt-site-admin/emails", name="admin_emails")
     * @return Response
     */
    public function index(){
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Уведомления';
        $em = $this->getDoctrine()->getManager();
        $forRender['pages'] = $em->getRepository(Email::class)->findAll();
        return $this->render('admin/Email/index.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/emails/create_page", name="admin_email_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Добавить почту';
        $em = $this->getDoctrine()->getManager();
        $page = new Email();
        $form = $this->createForm(EmailType::class, $page);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $page = $form->getData();
            $em->persist($page);
            $em->flush();
            return $this->redirectToRoute('admin_emails');
        }
        return $this->render('admin/Email/form.html.twig', $forRender);
    }


    /**
     * @Route ("/fbt-site-admin/emails/delete_page/{id}", name="admin_email_delete")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $email = $em->getRepository(Email::class)->find($id);
        $em->remove($email);
        $em->flush();
        return $this->redirectToRoute('admin_emails');
    }


}