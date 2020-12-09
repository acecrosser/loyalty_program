<?php

namespace App\Controller;

use App\Entity\Checks;
use App\Entity\Cards;
use App\Entity\Fiscals;
use App\Form\ChecksType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChecksController extends AbstractController
{
    /**
     * @Route("/add/bonus", name="checks", methods={"GET", "POST"})
     */
    public function addBonus(Request $request): object
    {
        $check = new Checks();
        $cards = new Cards();
        $fiscal = new Fiscals();

        $checkCards = $this->getDoctrine()->getRepository(Cards::class);
        $checkFiscal = $this->getDoctrine()->getRepository(Fiscals::class);


        if ($request->isMethod('POST')) {
            $data = $request->getContent();
            parse_str($data, $output);
            $qrcode = $output['qrcode'];
            parse_str($qrcode, $chekData);

            if ($checkFiscal->findOneBy(array('fnumber' => $chekData['FN']))) {

                $check->setIndef($chekData['I']);
                $check->setNumber($chekData['N']);
                $check->setDatetime($chekData['T']);
                $check->setFp($chekData['FP']);
                $check->setSumma($chekData['S']);

                $em = $this->getDoctrine()->getManager();
                $em->persist($check);
                $em->flush();
            }

            return $this->redirectToRoute('checks');
        }

        return $this->render('checks/index.html.twig', [
            'controller_name' => 'ChecksController',
        ]);
    }
}
