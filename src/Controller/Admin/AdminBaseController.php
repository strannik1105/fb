<?php

namespace App\Controller\Admin;

use App\Entity\Region;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBaseController extends AbstractController
{
    public function renderDefault(){
        $all_regions = $this->getDoctrine()->getRepository(Region::class)->findAll();
        $request = Request::createFromGlobals();
        $admin_region = null;
        if($all_regions != null)
                $admin_region = array_shift($all_regions);
        if($request->cookies->get('admin_region') == null)
        {
            if($all_regions != null)
            {
                $admin_region = array_shift($all_regions);
            }
        }
        else
        {
            $admin_region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $request->cookies->get('admin_region')]);
        }
        if($admin_region == null)
        {
            $admin_region = array_shift($all_regions);
        }
        return [
            'title' => 'FB-телеком',
            'image' => null,
            'all_regions' => $this->getDoctrine()->getRepository(Region::class)->findAll(),
            'admin_region' => $admin_region,
        ];
    }

    /**
     * @Route("/fbt-site-admin/select_region/{name}", name="admin_select_region")
     * @param Request $request
     * @param string $name
     */
    public function SelectRegion(Request $request, string $name)
    {
        //$forRender = renderDefault($request);
        //$region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $name]);
        $responce = new Response();
        $cookie = new Cookie('admin_region', $name);
        //$responce->headers->setCookie($cookie);
        //$url = $request->server->get('referer');

        $request->cookies->remove('admin_region');
        $request->cookies->set('admin_region', $name);
        $request->overrideGlobals();
        //$params = $this->getRefererParams($request);
        //$forRender['region'] = $name;
        $cookie = new Cookie('admin_region', $name);
        $url = $request->server->get('HTTP_REFERER');

        //$this->redirect($url);
        $response = new RedirectResponse($url);
        $response->headers->setCookie($cookie);
        return $response;
        //return $this->redirectToRoute('admin_home');
    }
}