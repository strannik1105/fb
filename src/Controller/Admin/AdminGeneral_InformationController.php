<?php

namespace App\Controller\Admin;

use App\Entity\GeneralInformation;
use App\Form\GeneralInformationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminGeneral_InformationController extends AdminBaseController
{
    /**
     * @Route("/fbt-site-admin/seo", name="admin_seo")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request){
        $forRender = parent::renderDefault();
        $em = $this->getDoctrine()->getManager();
        $g = $this->getDoctrine()->getRepository(GeneralInformation::class)->find(1);
        $form = $this->createForm(GeneralInformationType::class, $g);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $g = $form->getData();
            $em->persist($g);
            $em->flush($g);
        }
        return $this->render('admin/General_Information/form.html.twig', $forRender);
    }
}