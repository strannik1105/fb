<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Form\MenuType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminMenuController extends AdminBaseController
{
    /**
     * @Route("/fbt-site-admin/menu", name="admin_menu")
     * @return Response
     */
    public function index(){
        $forRender = parent::renderDefault();
        $em = $this->getDoctrine()->getManager();
        $menu_items = $em->getRepository(Menu::class)->findAll();
        $menu = array();
        $i = 0;
        /*foreach ($menu_items as $item )
        {
            if($item->getLevel() == 0)
            {
                $menu[$i] = array();//new Menu_item($item->getName());
                $menu[$i][0] = $item;
                $menu[$i][1] = array();
                $y = 0;
                $childs1 = array();
                if($item->getChilds() != null) {
                    foreach ($item->getChilds() as $child1_id) {
                        $child1_item = $em->getRepository(Menu::class)->find($child1_id);
                        $childs1[$y] = $child1_item;
                        $y++;
                    }
                }
                $menu[$i][1] = $childs1;
            }
            $i++;
        }
        for($i = 0; $i < count($menu); $i++)
        {
            for($j = 0; $j < count($menu); $j++)
            {
                if(array_key_exists($j + 1, $menu) && array_key_exists($j, $menu))
                {
                    $x = $menu[$j][0];
                    $y = $menu[$j+1][0];
                    //$x = $em->getRepository(Menu::class)->find($menu[$j][0]);
                    //$y = $em->getRepository(Menu::class)->find($menu[$j+1][0]);
                    if($x->getNumber() > $y->getNumber())
                    {
                        $sw = $menu[$j];
                        $menu[$j] = $menu[$j+1];
                        $menu[$j+1] = $sw;
                    }
                }
            }
        }
        foreach ($menu as $mi)
        {
            $childs_i = $mi[1];
            $max_index = 0;
            foreach ($childs_i as $c)
            {
                if($c != null)
                {
                    if($c->getNumber() > $max_index)
                        $max_index = $c->getNumber();
                }
            }
            for($i = 0; $i <= $max_index; $i++)
            {
                for($j = 0; $j <= $max_index; $j++)
                {
                    if(array_key_exists($i, $childs_i))
                    $x = $em->getRepository(Menu::class)->findOneBy(['id' => $childs_i[$i]]);
                    if(array_key_exists($j+1, $childs_i))
                    $y = $em->getRepository(Menu::class)->findOneBy(['id' => $childs_i[$j+1]]);
                    if($x != null && $y != null)
                    {
                        if($x->getNumber() > $y->getNumber())
                        {
                            $s = $childs_i[$j];
                            $childs_i[$j] = $childs_i[$j+1];
                            $childs_i[$j+1] = $s;
                        }
                    }
                }
            }
            ksort($childs_i);
            $mi[1] = $childs_i;
        }*/
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


        $forRender['menu'] = $menu;
        $forRender['menu1'] = $menu1;
        return $this->render('admin/Menu/index.html.twig', $forRender);
    }



    /**
     * @Route ("/fbt-site-admin/menu/create_menu_item", name="admin_menu_item_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = '';
        $em = $this->getDoctrine()->getManager();
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $menu = $form->getData();
            $menu->setNumber(0);
            $menu->setLevel(0);
            $em->persist($menu);
            $em->flush();
            return $this->redirectToRoute('admin_menu');
        }
        return $this->render('admin/Menu/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/menu/insert_before_menu_item/{id}", name="admin_menu_item_insert_before")
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function insert_before(Request $request, int $id)
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = '';
        $em = $this->getDoctrine()->getManager();
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $item = $em->getRepository(Menu::class)->find($id);
            $all_items = $em->getRepository(Menu::class)->findAll();
            foreach ($all_items as $i)
            {
                if($i->getLevel() == 0)
                {
                    if($i->getNumber() >= $item->getNumber())
                    {
                        $i->setNumber($i->getNumber() + 1);
                    }
                }
            }
            $menu = $form->getData();
            $menu->setNumber($item->getNumber() - 1);
            $menu->setLevel(0);
            $em->persist($menu);
            $em->flush();
            return $this->redirectToRoute('admin_menu');
        }
        return $this->render('admin/Menu/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/menu/insert_after_menu_item/{id}", name="admin_menu_item_insert_after")
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function insert_after(Request $request, int $id)
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = '';
        $em = $this->getDoctrine()->getManager();
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $item = $em->getRepository(Menu::class)->find($id);
            $all_items = $em->getRepository(Menu::class)->findAll();
            foreach ($all_items as $i)
            {
                if($i->getNumber() > $item->getNumber())
                {
                    $i->setNumber($i->getNumber() + 1);
                }
            }
            $menu = $form->getData();
            $menu->setNumber($item->getNumber() + 1);
            $menu->setLevel(0);
            $em->persist($menu);
            $em->flush();
            return $this->redirectToRoute('admin_menu');
        }
        return $this->render('admin/Menu/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/menu/insert_after_menu_child_item/{id}", name="admin_menu_child_item_insert_after")
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function child_insert_after(Request $request, int $id)
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = '';
        $em = $this->getDoctrine()->getManager();
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $item = $em->getRepository(Menu::class)->find($id);
            $parent = null;
            $all_items = $em->getRepository(Menu::class)->findBy(['Level' => 0]);
            foreach ($all_items as $i)
            {
                if($i->getChilds() != null) {
                    foreach ($i->getChilds() as $j) {
                        if ($j == $item->getId()) {
                            $parent = $em->getRepository(Menu::class)->find($i);
                        }
                    }
                }
            }
            $all_childs = array();
            foreach ($parent->getChilds() as $child_id)
            {
                $child = $em->getRepository(Menu::class)->find($child_id);
                if($child != null)
                    $all_childs[$child->getName()] = $child;
            }
            foreach ($all_childs as $i)
            {
                if($i->getNumber() > $item->getNumber())
                {
                    $i->setNumber($i->getNumber() + 1);
                }
            }
            $menu = $form->getData();
            $menu->setNumber($item->getNumber() + 1);
            $menu->setLevel(1);
            $em->persist($menu);
            $em->flush();
            $arr = $parent->getChilds();
            array_push($arr, $menu->getId());
            $parent->setChilds($arr);
            $em->persist($parent);
            $em->flush();
            return $this->redirectToRoute('admin_menu');
        }
        return $this->render('admin/Menu/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/menu/insert_before_menu_child_item/{id}", name="admin_menu_child_item_insert_before")
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function child_insert_before(Request $request, int $id)
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = '';
        $em = $this->getDoctrine()->getManager();
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $item = $em->getRepository(Menu::class)->find($id);
            $parent = null;
            $all_items = $em->getRepository(Menu::class)->findBy(['Level' => 0]);
            foreach ($all_items as $i)
            {
                if($i->getChilds() != null) {
                    foreach ($i->getChilds() as $j) {
                        if ($j == $item->getId()) {
                            $parent = $em->getRepository(Menu::class)->find($i);
                        }
                    }
                }
            }
            $all_childs = array();
            foreach ($parent->getChilds() as $child_id)
            {
                $child = $em->getRepository(Menu::class)->find($child_id);
                if($child != null)
                    $all_childs[$child->getName()] = $child;
            }
            foreach ($all_childs as $i)
            {
                if($i->getNumber() <= $item->getNumber())
                {
                    $i->setNumber($i->getNumber() + 1);
                }
            }
            $menu = $form->getData();
            $menu->setNumber($item->getNumber() - 1);
            $menu->setLevel(1);
            $em->persist($menu);
            $em->flush();
            $arr = $parent->getChilds();
            array_push($arr, $menu->getId());
            $parent->setChilds($arr);
            $em->persist($parent);
            $em->flush();
            return $this->redirectToRoute('admin_menu');
        }
        return $this->render('admin/Menu/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/menu/swap_after_menu_item/{id}", name="admin_menu_item_swap_after")
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function swap_after(Request $request, int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(Menu::class)->find($id);
        $next = $em->getRepository(Menu::class)->findOneBy(['Level' => $item->getLevel(), 'Number' => $item->getNumber() + 1]);
        if($next != null)
        {
            $num = $item->getNumber();
            $item->setNumber($next->getNumber());
            $next->setNumber($num);
            $em->persist($item);
            $em->flush();
            $em->persist($next);
            $em->flush();
        }
        return $this->redirectToRoute('admin_menu');
    }

    /**
     * @Route ("/fbt-site-admin/menu/add_child/{id}", name="admin_menu_add_child")
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function add_child(Request $request, int $id)
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = '';
        $em = $this->getDoctrine()->getManager();
        $menu = new Menu();
        $parent = $em->getRepository(Menu::class)->find($id);
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        $forRender['form'] = $form->createView();
        if($form->isSubmitted())
        {
            $menu = $form->getData();
            $childs = $parent->getChilds();
            $end_num = 0;
            if($childs != null) {
                foreach ($childs as $i) {
                    if ($i != null) {
                        $j = $em->getRepository(Menu::class)->find($i);
                        if ($j != null) {
                            if ($j->getNumber() >= $end_num)
                                $end_num = $j->getNumber() + 1;
                        }
                    }
                }
            }
            $menu->setNumber($end_num);
            $menu->setLevel(1);
            $em->persist($menu);
            $em->flush();
            if($childs != null)
                array_push($childs, $menu->getId());
            else
                $childs[0] = $menu->getId();
            $parent->setChilds($childs);
            $em->persist($parent);
            $em->flush();
            return $this->redirectToRoute('admin_menu');
        }
        return $this->render('admin/Menu/form.html.twig', $forRender);
    }

    /**
     * @Route ("/fbt-site-admin/menu/remove_item/{id}", name="admin_menu_item_remove")
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function remove(Request $request, int $id)
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = '';
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(Menu::class)->find($id);
        $all_tems = $em->getRepository(Menu::class)->findAll();
        foreach ($all_tems as $i)
        {
            if($i->getChilds() != null) {
                foreach ($i->getChilds() as $key => $j) {
                    if ($j == $item->getId()) {
                        $sub = $em->getRepository(Menu::class)->find($i->getChilds()[$key]);
                        unset($i->getChilds()[$key]);
                        $em->persist($i);
                        $em->flush();
                    }
                }
            }
        }
        $em->remove($item);
        $em->flush();
        return $this->redirectToRoute('admin_menu');
    }
}