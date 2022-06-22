<?php

namespace App\Controller\Admin;

use App\Entity\Rate;
use App\Entity\Region;
use App\Entity\VacantPosition;
use App\Form\VacantPositionType;
use App\Form\RegionType;
use App\Service\FileManagerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminVacantPositionController extends AdminBaseController
{

    /**
     * @Route("/fbt-site-admin/vacancy", name="admin_vacancy")
     * @return Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $request = Request::createFromGlobals();
        $forRender['title'] = 'Вакансии';
        $region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['admin_region']]);
        $forRender['vacancy'] =  $em->getRepository(VacantPosition::class)->findBy(['Region' =>
            $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $request->cookies->get('admin_region')])]);
        return $this->render('admin/Vacancy/index.html.twig', $forRender);
    }


    /**
     * @Route ("/fbt-site-admin/vacancy/create_vacancy", name="admin_vacancy_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $vacancy = new VacantPosition();
        $form = $this->createForm(VacantPositionType::class, $vacancy);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $vacancy = $form->getData();
            $fms = new FileManagerService('uploads/vacancy');
            $vacancy->setImage($fms->imagePostUpload($form['Image']->getData()));
            $region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['admin_region']->getName()]);
            $vacancy->setRegion($region);
            $em->persist($vacancy);
            $em->flush();
            $this->addFlash('success', 'Тариф добавлен');
            return $this->redirectToRoute('admin_vacancy');
        }
        $forRender['form'] = $form->createView();
        return $this->render('admin/Vacancy/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/vacancy/edit_vacancy/{id}", name="admin_vacancy_edit")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $vacancy = $em->getRepository(VacantPosition::class)->find($id);
        $form = $this->createForm(VacantPositionType::class, $vacancy);
        $form->handleRequest($request);
        if($vacancy->getImage() != null)
            $forRender['image'] = $vacancy->getImage();
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $vacancy = $form->getData();
            if($form['Image']->getData() != null)
            {
                $fms = new FileManagerService('uploads/vacancy');
                $vacancy->setImage($fms->imagePostUpload($form['Image']->getData()));
            }
            $em->persist($vacancy);
            $em->flush();
            return $this->redirectToRoute('admin_vacancy');
        }
        return $this->render('admin/Vacancy/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/vacancy/delete_vacancy/{id}", name="admin_vacancy_delete")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $vacancy = $em->getRepository(VacantPosition::class)->find($id);
        if($vacancy->getImage() != null)
        {
            $fms = new FileManagerService('uploads/vacancy');
            $fms->removePostImage($vacancy->getImage());
        }
        $em->remove($vacancy);
        $em->flush();
        return $this->redirectToRoute('admin_vacancy');
    }
}