<?php

namespace App\Controller\Main;

use App\Entity\GeneralInformation;
use App\Service\geoPlugin;
use App\Service\SxGeo;
use App\Entity\Region;
use App\Entity\Menu;
use App\Entity\PageSettings;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

trait Referer {
    private function getRefererParams(Request $request) {

        /*$referer = $request->headers->get('referer');
        $baseUrl = $request->getBaseUrl();
        $lastPath = substr($referer, strpos($referer, $baseUrl) + strlen($baseUrl));
        return $this->get('router')->getMatcher()->match($lastPath);*/
    }
}

class BaseController extends AbstractController
{
    use Referer;

    public function renderDefault(Request $request){
        $em = $this->getDoctrine()->getManager();
        $dialog = false;
        //$request->headers->set('Access-Control-Allow-Origin', '*');//'http://www.geoplugin.net');
        $request->overrideGlobals();
        $region = $request->cookies->get('region');
        //$geoPlugin->locate($request->server->get('HTTP_X_REAL_IP'));
        if($request->cookies->get('region') != null)
        {
            $dialog = false;
            if($em->getRepository(Region::class)->findOneBy(['Name' => $request->cookies->get('region')]) != null)
                $region = $em->getRepository(Region::class)->findOneBy(['Name' => $request->cookies->get('region')])->getName();
            else
                $region = null;
            
        }
        //$geoPlugin->locate($request->server->get('HTTP_X_REAL_IP'));

        $sxgeo = new SxGeo();
        $detected_city = null;
        $detected_region = null;
        if($sxgeo->getCity($request->server->get('REMOTE_ADDR')) != false)
            $detected_city = $sxgeo->getCity($request->server->get('REMOTE_ADDR'))['city']['name_ru'];
        if($sxgeo->getCityFull($request->server->get('REMOTE_ADDR')) != false)
            $detected_region = $sxgeo->getCityFull($request->server->get('REMOTE_ADDR'))['region']['name_ru'];
        $regions = $em->getRepository(Region::class)->findAll();
        
        if($region == null)
        {
            
            if($em->getRepository(Region::class)->findOneBy(['Name' => $detected_region]) != null && $detected_region != null)
            {
                $region = $em->getRepository(Region::class)->findOneBy(['Name' => $detected_region])->getName();
                $dialog = true;
            }
            else if($em->getRepository(Region::class)->findOneBy(['Name' => $detected_city]) != null && $detected_city != null)
            {
                $region = $em->getRepository(Region::class)->findOneBy(['Name' => $detected_city])->getName();
                $dialog = true;
            }
            else
            {
                if($em->getRepository(Region::class)->findAll() != null )
                {
                    $arr_r = $em->getRepository(Region::class)->findAll();
                    $region = array_shift($arr_r)->getName();
                    $dialog = true;
                }
            }
        }
        /*else
        {
            $region = $em->getRepository(Region::class)->findOneBy(['Geolocation' => $request->cookies->get('region')]);
        }*/
        //if($dialog == false)
        //{
        //    $cookie = new Cookie('region', $region->getName());
        //    $request->setCookie($cookie);
        //}
        $all_menu_items = $em->getRepository(Menu::class)->findBy(['Level' => 0]);
        $menu = array();
        $menu1 = array();
        $i = 0;
        $max_i = 0;
        foreach ($all_menu_items as $item)
        {
            if($max_i < $item->getNumber())
                $max_i = $item->getNumber();
        }
        for($i = 0; $i <= $max_i; $i++)
        {
            $m = $em->getRepository(Menu::class)->findOneBy(['Level' => 0, 'Number' => $i]);
            $arr = array(); $arr[0] = $m;

            //array_push($menu, $m);
            $childs = array();
            $j = 0;
            $max_j = 0;
            if($m != null)
            {
                if($m->getChilds() != null) {
                    foreach ($m->getChilds() as $c) {
                        /*$childs[$j] = $em->getRepository(Menu::class)->find($c);
                        if($max_j < $em->getRepository(Menu::class)->find($c)->getNumber())
                        {
                            $max_j = $em->getRepository(Menu::class)->find($c)->getNumber();
                        }*/
                        if ($em->getRepository(Menu::class)->find($c) != null)
                            $childs[$em->getRepository(Menu::class)->find($c)->getNumber()] = $em->getRepository(Menu::class)->find($c);
                    }
                }
            }
            ksort($childs);
            //array_push($menu1[$i], $childs);
            $arr[1] = $childs;
            $menu[$i] = $arr;
        }
        //$sxgeo->getCity('188.133.218.89');
        $phone = null;
        if($em->getRepository(Region::class)->findOneBy(['Name' => $region]) != null)
        {
            $phone = $em->getRepository(Region::class)->findOneBy(['Name' => $region])->getPhone();
            $adress = $em->getRepository(Region::class)->findOneBy(['Name' => $region])->getAdress();
            $whatsapp = $em->getRepository(Region::class)->findOneBy(['Name' => $region])->getWhatsApp();
            $telegram = $em->getRepository(Region::class)->findOneBy(['Name' => $region])->getTelegram();
            $viber = $em->getRepository(Region::class)->findOneBy(['Name' => $region])->getViber();
        }
        $ps = $em->getRepository(PageSettings::class)->findAll();
        return [
            'title' => 'Title по умолчанию',
            'phone' => $phone,
            'adress'=> $adress, 
            'whatsapp' => $whatsapp,
            'telegram' => $telegram,
            'viber' => $viber,
            'region' => $region,
            'settings' => array_shift($ps),
            'dialog' => $dialog,
            'regions' => $regions,
            'menu' => $menu,
            'menu1' => $menu1,
            'year' => date("y"),
            'gen_info' => $this->getDoctrine()->getRepository(GeneralInformation::class)->find(1),
        ];
    }

    /**
     * @Route("/select_region/{name}", name="select_region")
     * @param Request $request
     * @param string $name
     */
    public function SelectRegion(Request $request, string $name)
    {
        //$forRender = renderDefault($request);
        //$region = $this->getDoctrine()->getRepository(Region::class)->findOneBy(['Name' => $name]);
        $responce = new Response();
        $cookie = new Cookie('region', $name);
        //$responce->headers->setCookie($cookie);
        //$url = $request->server->get('referer');

        $request->cookies->remove('region');
        $request->cookies->set('region', $name);
        $request->overrideGlobals();
        //$params = $this->getRefererParams($request);
        //$forRender['region'] = $name;
        $cookie = new Cookie('region', $name);
        $url = $request->headers->get('referer');

        //$this->redirect($url);
        $response = new RedirectResponse($url);
        $response->headers->setCookie($cookie);
        return $response;
    }
}