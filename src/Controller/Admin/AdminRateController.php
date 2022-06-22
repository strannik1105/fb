<?php

namespace App\Controller\Admin;

use App\Entity\Rate;
use App\Entity\Region;
use App\Form\RateType;
use App\Form\RegionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminRateController extends AdminBaseController
{

    /**
     * @Route("/fbt-site-admin/rates", name="admin_rates")
     * @return Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $request = Request::createFromGlobals();
        $forRender['title'] = 'Тарифы';
        $region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['admin_region']->getName()]);
        $forRender['rates'] =  $em->getRepository(Rate::class)->findBy(['Region' =>
            $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['admin_region']->getName()])]);
        return $this->render('admin/Rate/index.html.twig', $forRender);
    }


    /**
     * @Route ("/fbt-site-admin/rates/create_rate", name="admin_rate_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $rate = new Rate();
        $form = $this->createForm(RateType::class, $rate, ['choices' => $em->getRepository(Region::class)->findAll()]);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $rate = $form->getData();
            $region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['admin_region']->getName()]);
            $rate->setRegion($region);
            $em->persist($rate);
            $em->flush();
            $this->addFlash('success', 'Тариф добавлен');
            return $this->redirectToRoute('admin_rates');
        }
        $forRender['form'] = $form->createView();
        return $this->render('admin/Rate/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/rates/edit_rate/{id}", name="admin_rate_edit")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $rate = $em->getRepository(Rate::class)->find($id);
        $form = $this->createForm(RateType::class, $rate, ['choices' => $em->getRepository(Region::class)->findAll()]);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $rate = $form->getData();
            $em->persist($rate);
            $em->flush();
            return $this->redirectToRoute('admin_rates');
        }
        return $this->render('admin/Rate/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/rates/delete_rate/{id}", name="admin_rate_delete")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rate = $em->getRepository(Rate::class)->find($id);
        $em->remove($rate);
        $em->flush();
        return $this->redirectToRoute('admin_rates');
    }
}