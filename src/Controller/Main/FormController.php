<?php

namespace App\Controller\Main;

use App\Entity\Region;
use App\Entity\Applications;
use App\Entity\SupportApplication;
use App\Entity\Vacancy;
use App\Entity\Vacancy1;
//use App\Entity\Email;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class FormController extends BaseController
{
    /**
     * @Route("/send_form", name="send_form")
     * @param Request $request
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $forRender = parent::renderDefault($request);
        $name = $request->request->get('name');
        $phone = $request->request->get('phone');
        $type = $request->request->get('type');
        //if((strlen($name) > 1) && (strlen($phone > 1)) && (strlen($type) > 1)) {
            $item = new Applications();
            $item->setName($request->request->get('name'));
            $item->setPhone($request->request->get('phone'));
            $item->setType($request->request->get('type'));
            $item->setRegion($forRender['region']);
            $item->setIP($request->server->get('REMOTE_ADDR'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            $adresses = $em->getRepository(\App\Entity\Email::class)->findAll();
            foreach($adresses as $adress)
            {
                $email = (new Email())
                        ->from('no-reply@myfbt.ru')
                        ->to($adress->getAdress())
                        ->subject('Заявка с сайта no-reply@myfbt.ru!')
                        ->text('Заявка с сайта no-reply@myfbt.ru')
                        ->html(
                            'ФИО: '.$item->getName().'<br>'.
                            'Телефон: '.$item->getPhone().'<br>'.
                            'Тип: '.$item->getType().'<br>'.
                            'Регион: '.$item->getRegion().'<br>'.
                            'Дата и время: '.date_create(date('Y-m-d H:i:s'))->format('H:i:s d.m.Y').'<br>'.
                            'IP: '.$request->server->get('REMOTE_ADDR')
                            );
                        $mailer->send($email);
            }
            return new Response('Success', 200);
        //}
        return new Response('Fail', 200);
    }

    /**
     * @Route("/send_form/vacancy", name="send_form_vacancy")
     * @param Request $request
     */
    public function vacancy(Request $request, MailerInterface $mailer)
    {
        $forRender = parent::renderDefault($request);
        $name = $request->request->get('name');
        $phone = $request->request->get('phone');
        $vacancy = $request->request->get('vacancy');
        $resume = $request->request->get('resume');
        if((strlen($name > 1)) && (strlen($phone > 1)) && (strlen($vacancy > 1)) && (strlen($resume > 1)))
        {
            $item = new Vacancy1();
            $item->setName($request->request->get('name'));
            $item->setPhone($request->request->get('phone'));
            $item->setVacancy($request->request->get('vacancy'));
            $item->setResume($request->request->get('resume'));
            $item->setRegion($forRender['region']);
            $item->setIP($request->server->get('REMOTE_ADDR'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            $adresses = $em->getRepository(\App\Entity\Email::class)->findAll();
            foreach($adresses as $adress)
            {
                $email = (new Email())
                        ->from('no-reply@myfbt.ru')
                        ->to($adress->getAdress())
                        ->subject('Заявка с сайта no-reply@myfbt.ru!')
                        ->text('Заявка с сайта no-reply@myfbt.ru')
                        ->html(
                            'ФИО: '.$item->getName().'<br>'.
                            'Телефон: '.$item->getPhone().'<br>'.
                            'Вакансия: '.$item->getVacancy().'<br>'.
                            'Резюме: '.$item->getResume().'<br>'.
                            'Регион: '.$item->getRegion().'<br>'.
                            'Дата и время: '.date_create(date('Y-m-d H:i:s'))->format('H:i:s d.m.Y').'<br>'.
                            'IP: '.$request->server->get('REMOTE_ADDR')
                            );
                        $mailer->send($email);
            }
            return new Response('Success', 200);
        }
        return new Response('Fail', 200);
    }

    /**
     * @Route("/send_form/support_application", name="send_form_support_application")
     * @param Request $request
     */
    public function support_application(Request $request, MailerInterface $mailer)
    {
        $forRender = parent::renderDefault($request);
        $item = new SupportApplication();
        $name = $request->request->get('name');
        $phone = $request->request->get('phone');
        $problem = $request->request->get('problem');
        if((strlen($name > 1)) && (strlen($phone > 1)) && (strlen($problem > 1)))
        {
            $item->setName($request->request->get('name'));
            $item->setPhone($request->request->get('phone'));
            $item->setproblem($request->request->get('problem'));
            $item->setRegion($forRender['region']);
            $item->setIP($request->server->get('REMOTE_ADDR'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            $adresses = $em->getRepository(\App\Entity\Email::class)->findAll();
            foreach($adresses as $adress)
            {
                $email = (new Email())
                        ->from('no-reply@myfbt.ru')
                        ->to($adress->getAdress())
                        ->subject('Заявка с сайта no-reply@myfbt.ru!')
                        ->text('Заявка с сайта no-reply@myfbt.ru')
                        ->html(
                            'ФИО: '.$item->getName().'<br>'.
                            'Телефон: '.$item->getPhone().'<br>'.
                            'Проблема: '.$item->getProblem().'<br>'.
                            'Регион: '.$item->getRegion().'<br>'.
                            'Дата и время: '.date_create(date('Y-m-d H:i:s'))->format('H:i:s d.m.Y').'<br>'.
                            'IP: '.$request->server->get('REMOTE_ADDR')
                            );
                        $mailer->send($email);
            }
            return new Response('Success', 200);
        }
        return new Response('Fail', 200);
    }
}