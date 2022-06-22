<?php

namespace App\Controller\Admin;

use App\Entity\Applications;
use App\Entity\SupportApplication;
use App\Entity\Vacancy1;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminApplicationsController extends AdminBaseController
{
    /**
     * @Route("/fbt-site-admin/applications", name="admin_applications")
     * @return Response
     */
    public function index(){
        $forRender = parent::renderDefault();
        $em = $this->getDoctrine()->getManager();
        $forRender['applications'] = $em->getRepository(Applications::class)->findAll();
        $forRender['vacancy'] = $em->getRepository(Vacancy1::class)->findAll();
        $forRender['support'] = $em->getRepository(SupportApplication::class)->findAll();
        return $this->render('admin/Applications/index.html.twig', $forRender);
    }

    /**
     * @Route("/fbt-site-admin/application/delete/{id}", name="admin_application_delete")
     * @param int $id;
     * @return Response
     */
    public function delete(int $id){
        $forRender = parent::renderDefault();
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository(Applications::class)->find($id);
        $em->remove($a);
        $em->flush();
        return $this->redirectToRoute('admin_applications');
        //$forRender['applications'] = $em->getRepository(Applications::class)->findAll();
        //return $this->render('admin/Applications/index.html.twig', $forRender);
    }

    /**
     * @Route("/fbt-site-admin/vacancy/delete/{id}", name="admin_vacancy_delete")
     * @param int $id;
     * @return Response
     */
    public function delete_vacancy(int $id){
        $forRender = parent::renderDefault();
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository(Vacancy1::class)->find($id);
        $em->remove($a);
        $em->flush();
        return $this->redirectToRoute('admin_applications');
        //$forRender['applications'] = $em->getRepository(Applications::class)->findAll();
        //return $this->render('admin/Applications/index.html.twig', $forRender);
    }

    /**
     * @Route("/fbt-site-admin/support_application/delete/{id}", name="admin_support_application_delete")
     * @param int $id;
     * @return Response
     */
    public function support_application(int $id){
        $forRender = parent::renderDefault();
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository(SupportApplication::class)->find($id);
        $em->remove($a);
        $em->flush();
        return $this->redirectToRoute('admin_applications');
        //$forRender['applications'] = $em->getRepository(Applications::class)->findAll();
        //return $this->render('admin/Applications/index.html.twig', $forRender);
    }
}