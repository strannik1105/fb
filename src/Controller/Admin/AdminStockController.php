<?php

namespace App\Controller\Admin;

use App\Entity\Rate;
use App\Entity\Stock;
use App\Entity\Region;
use App\Form\RateType;
use App\Form\StockType;
use App\Form\RegionType;
use App\Service\FileManagerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminStockController extends AdminBaseController
{

    /**
     * @Route("/fbt-site-admin/stocks", name="admin_stocks")
     * @return Response
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $request = Request::createFromGlobals();
        $forRender['title'] = 'Акции';
        $region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['admin_region']->getName()]);
        //$forRender['stocks'] =  $em->getRepository(Stock::class)->findAll();
        $forRender['stocks'] =  $em->getRepository(Stock::class)->findBy(['Region' =>
            $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['admin_region']->getName()])]);
        return $this->render('admin/Stock/index.html.twig', $forRender);
    }


    /**
     * @Route ("/fbt-site-admin/stocks/create_stock", name="admin_stock_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $stock = new Stock();
        $form = $this->createForm(StockType::class, $stock, ['choices' => $em->getRepository(Region::class)->findAll()]);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $stock = $form->getData();
            $fms = new FileManagerService('uploads/stocks');
            $stock->setImage($fms->imagePostUpload($form['Image']->getData()));
            $region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $forRender['admin_region']->getName()]);
            $stock->setRegion($region);
            $em->persist($stock);
            $em->flush();
            $this->addFlash('success', 'Тариф добавлен');
            return $this->redirectToRoute('admin_stocks');
        }
        $forRender['form'] = $form->createView();
        return $this->render('admin/Stock/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/stocks/edit_stock/{id}", name="admin_stock_edit")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $forRender = parent::renderDefault();
        $stock = $em->getRepository(Stock::class)->find($id);
        if($stock->getImage() != null)
        {
            $forRender['image'] = $stock->getImage();
        }
        else
            $forRender['image'] = null;
        $form = $this->createForm(StockType::class, $stock, ['choices' => $em->getRepository(Region::class)->findAll()]);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $stock = $form->getData();
            $em->persist($stock);
            $em->flush();
            return $this->redirectToRoute('admin_stocks');
        }
        return $this->render('admin/Stock/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/stocks/delete_stock/{id}", name="admin_stock_delete")
     * @param int $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete(int $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rate = $em->getRepository(Stock::class)->findOneBy(['id' => $id]);
        if($rate != null)
            $em->remove($rate);
        $em->flush();
        return $this->redirectToRoute('admin_stocks');
    }
}