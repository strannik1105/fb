<?php

namespace App\Controller\Admin;

use App\Entity\PageSettings;
use App\Entity\TVBanner;
use App\Entity\InternetAdvantages;
use App\Entity\SupportQuestion;
use App\Form\PageSettingsFormType;
use App\Form\InternetAdvantagesType;
use App\Form\SupportQuestionType;
use App\Form\TVBannerType;
use App\Service\FileManagerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminPageSettingsController extends AdminBaseController
{
    /**
     * @Route ("/fbt-site-admin/pages_settings", name="admin_page_settings")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $settings = null;
        $companyimage = null;
        $vacancyimage = null;
        $supportimage = null;
        $tvbanner = null;
		if($em->getRepository(PageSettings::class)->findAll() == null)
		{
			$settings = new PageSettings();
			$em->persist($settings);
			$em->flush();
		}
		$ps = $em->getRepository(PageSettings::class)->findAll();
        $settings = array_shift($ps);
        if($settings->getCompanyImage() != null)
        {
            $companyimage = $settings->getCompanyImage();
        }
        if($settings->getVacancyImage() != null)
        {
            $vacancyimage = $settings->getVacancyImage();
        }
        if($settings->getSupportImage() != null)
        {
            $supportimage = $settings->getSupportImage();
        }
        if($settings->getTVBanner() != null)
        {
            $tvbanner = $settings->getTVBanner();
        }
        $form = $this->createForm(PageSettingsFormType::class, $settings);
        $form->handleRequest($request);
        $forRender['support_questions'] = $em->getRepository(SupportQuestion::class)->findAll();
        $forRender['internet_advantages'] = $em->getRepository(InternetAdvantages::class)->findBy(['Region' => null]);
        $forRender['form'] = $form->createView();
        $forRender['companyimage'] = $companyimage;
        $forRender['vacancyimage'] = $vacancyimage;
        $forRender['supportimage'] = $supportimage;
        $forRender['tvbanner'] = $tvbanner;
        $forRender['tvbs'] = $em->getRepository(TVBanner::class)->findAll();
        if($form->isSubmitted())
        {
            $settings = $form->getData();
            if($form['CompanyImage']->getData() != null)
            {
                $fms = new FileManagerService('uploads/company');
                if($settings->getCompanyImage() != null)
                {
                    $fms->removePostImage($settings->getCompanyImage());
                }
                $settings->setCompanyImage($fms->imagePostUpload($form['CompanyImage']->getData()));
            }
            if($form['VacancyImage']->getData() != null)
            {
                $fms = new FileManagerService('uploads/vacancy');
                if($settings->getVacancyImage() != null)
                {
                    $fms->removePostImage($settings->getVacancyImage());
                }
                $settings->setVacancyImage($fms->imagePostUpload($form['VacancyImage']->getData()));
            }
            if($form['SupportImage']->getData() != null)
            {
                $fms = new FileManagerService('uploads/support');
                if($settings->getSupportImage() != null)
                {
                    $fms->removePostImage($settings->getSupportImage());
                }
                $settings->setSupportImage($fms->imagePostUpload($form['SupportImage']->getData()));
            }
            if($form['TVBanner']->getData() != null)
            {
                $fms = new FileManagerService('uploads/tv');
                if($settings->getTVBanner() != null)
                {
                    $fms->removePostImage($settings->getTVBanner());
                }
                $settings->setTVBanner($fms->imagePostUpload($form['TVBanner']->getData()));
            }
            $em->persist($settings);
            $em->flush();
            return $this->redirectToRoute('admin_page_settings');
        }
        return $this->render('admin/PageSettings/form.html.twig', $forRender);
    }
    
    /**
     * @Route ("/fbt-site-admin/pages_settings/add_internet_advantage", name="admin_internet_adv_add")
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
     * @Route ("/fbt-site-admin/pages_settings/edit_internet_advantage/{id}", name="admin_internet_adv_edit")
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
     * @Route ("/fbt-site-admin/pages_settings/delete_internet_advantage/{id}", name="admin_internet_adv_delete")
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
    
    
    /**
     * @Route ("/fbt-site-admin/pages_settings/tv_banner_add", name="admin_tv_banner_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function add_tv_banner(Request $request)
    {
        $forRender = parent::renderDefault();
        $em = $this->getDoctrine()->getManager();
        $image = null;
        $tvb = new TVBanner();
        $form = $form = $this->createForm(TVBannerType::class, $tvb);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        $forRender['image'] = $image;
        if($form->isSubmitted())
        {
            $adv = $form->getData();
            $fms = new FileManagerService('uploads/tvbanner');
            if($form['Image']->getData() != null)
                $adv->setImage($fms->imagePostUpload($form['Image']->getData()));
            $em->persist($adv);
            $em->flush();
            return $this->redirectToRoute('admin_page_settings');
        }
        return $this->render('admin/TVBanner/form.html.twig', $forRender);
    }
    
    /**
     * @Route ("/fbt-site-admin/pages_settings/tv_banner_delete/{id}", name="admin_tv_banner_delete")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete_tv_banner(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rate = $em->getRepository(TVBanner::class)->findOneBy(['id' => $id]);
        if($rate->getImage() != null)
        {
            $fms = new FileManagerService('uploads/tvbanner');
            $fms->removePostImage($rate->getImage());
            $em->remove($rate);
        }
        $em->remove($rate);
        $em->flush();
        return $this->redirectToRoute('admin_page_settings');
    }
    
    /**
     * @Route ("/fbt-site-admin/pages_settings/support_question_add", name="admin_support_question_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function add_support_question(Request $request)
    {
        $forRender = parent::renderDefault();
        $em = $this->getDoctrine()->getManager();
        $i = new SupportQuestion();
        $form = $form = $this->createForm(SupportQuestionType::class, $i);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $i = $form->getData();
            $em->persist($i);
            $em->flush();
            return $this->redirectToRoute('admin_page_settings');
        }
        return $this->render('admin/SupportQuestion/form.html.twig', $forRender);
    }
    
    /**
     * @Route ("/fbt-site-admin/pages_settings/support_question_delete/{id}", name="admin_support_question_delete")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete_support_question(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $i = $em->getRepository(SupportQuestion::class)->findOneBy(['id' => $id]);
        $em->remove($i);
        $em->flush();
        return $this->redirectToRoute('admin_page_settings');
    }
}