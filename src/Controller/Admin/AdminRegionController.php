<?php

namespace App\Controller\Admin;

use App\Entity\Rate;
use App\Entity\Region;
use App\Entity\InternetAdvantages;
use App\Form\RateType;
use App\Form\RegionType;
use App\Form\InternetAdvantagesType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileManagerService;

class AdminRegionController extends AdminBaseController
{
    /**
     * @Route("/fbt-site-admin/regions", name="admin_regions")
     * @return Response
     */
    public function index(){
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Регионы';
        $forRender['regions'] =  $em->getRepository(Region::class)->findAll();
        return $this->render('admin/Region/index.html.twig', $forRender);
    }


    /**
     * @Route ("/fbt-site-admin/regions/create_region", name="admin_region_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $region = new Region();
        $form = $this->createForm(RegionType::class, $region);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $region = $form->getData();
            $region->setGeolocation($region->getName());
            $em->persist($region);
            $em->flush();
            $this->addFlash('success', 'Регион добавлен');
            return $this->redirectToRoute('admin_home');
        }
        $forRender['internet_advantages'] = null;
        $forRender['form'] = $form->createView();
        return $this->render('admin/Region/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/regions/edit_region/{id}", name="admin_region_edit")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $region = $em->getRepository(Region::class)->find($id);
        $form = $this->createForm(RegionType::class, $region);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        $forRender['internet_advantages'] = $em->getRepository(InternetAdvantages::class)->findBy(['Region' => $region->getName()]);
        if($form->isSubmitted())
        {
            $region = $form->getData();
            $em->persist($region);
            $em->flush();
            return $this->redirectToRoute('admin_regions');
        }
        return $this->render('admin/Region/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/regions/delete_region/{id}", name="admin_region_delete")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $region = $em->getRepository(Region::class)->find($id);
        $em->remove($region);
        $em->flush();
        return $this->redirectToRoute('admin_home');
    }
    
    /**
     * @Route ("/fbt-site-admin/regions/add_internet_advantage", name="admin_regions_internet_adv_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function add_i_adv(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $adv = new InternetAdvantages();
        $form = $this->createForm(InternetAdvantagesType::class, $adv);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $adv = $form->getData();
            $adv->setRegion($forRender['admin_region']->getName());
            $fms = new FileManagerService('uploads/internetadvantages');
            if($form['Image']->getData() != null)
                $adv->setImage($fms->imagePostUpload($form['Image']->getData()));
            $em->persist($adv);
            $em->flush();
            return $this->redirectToRoute('admin_page_settings');
        }
        return $this->render('admin/PageSettings/internetadvantages.html.twig', $forRender);
    }
    
    /**
     * @Route ("/fbt-site-admin/regions/edit_internet_advantage/{id}", name="admin_regions_internet_adv_edit")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit_i_adv(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $adv = $em->getRepository(InternetAdvantages::class)->find($id);
        $form = $this->createForm(InternetAdvantagesType::class, $adv);
        $form->handleRequest($request);
        $image = null;
        if($adv->getImage() != null)
            $image = $adv->getImage();
        $forRender['image'] = $image;
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $adv = $form->getData();
            $fms = new FileManagerService('uploads/internetadvantages');
            if($form['Image']->getData() != null)
                $adv->setImage($fms->imagePostUpload($form['Image']->getData()));
            $em->persist($adv);
            $em->flush();
            return $this->redirectToRoute('admin_page_settings');
        }
        return $this->render('admin/PageSettings/internetadvantages.html.twig', $forRender);
    }
    
    /**
     * @Route ("/fbt-site-admin/regions/delete_internet_advantage/{id}", name="admin_regions_internet_adv_delete")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete_i_adv(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rate = $em->getRepository(InternetAdvantages::class)->findOneBy(['id' => $id]);
        if($rate->getImage() != null)
        {
            $fms = new FileManagerService('uploads/internetadvantages');
            $fms->removePostImage($rate->getImage());
            $em->remove($rate);
        }
        $em->flush();
        return $this->redirectToRoute('admin_page_settings');
    }
}