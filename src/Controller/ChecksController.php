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
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class ChecksController extends AbstractController
{
    /**
     * @Route("/add/bonus", name="checks", methods={"GET", "POST"})
     */
    public function addBonus(Request $request): object
    {
        $check = new Checks();

        $checkCards = $this->getDoctrine()->getRepository(Cards::class);
        $checkFiscal = $this->getDoctrine()->getRepository(Fiscals::class);

        if ($request->isMethod('POST')) {
            $data = $request->getContent();
            parse_str($data, $output);
            $identifier = $output['indef'];
            $qrcode = $output['qrcode'];
            parse_str($qrcode, $chekData);

            if ($checkFiscal->findOneBy(array('fnumber' => $chekData['FN'])) and
                ($checkCards->findOneBy(array('number' => $identifier)) or
                    ($checkCards->findOneBy(array('idcard' => $identifier))))) {

                $em = $this->getDoctrine()->getManager();
                $cardNumber = $em->getRepository(Cards::class)->findOneBy(array('number' => $identifier));
                $cardIdNumber = $em->getRepository(Cards::class)->findOneBy(array('idcard' => $identifier));

                try {
                    $check->setIndef($chekData['I']);
                    $check->setNumber($chekData['N']);
                    $check->setDatetime($chekData['T']);
                    $check->setFp($chekData['FP']);
                    $check->setSumma($chekData['S']);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($check);
                    $em->flush();

                } catch (UniqueConstraintViolationException $e) {
                    $err = array(
                        'error' => 'Такой чек уже есть в базе или вы отправили пустую форму',
                    );
                    return $this->render('checks/index.html.twig', [
                        'err' => $err,
                    ]);
                }

                if ($cardNumber) {
                    $balance = $cardNumber->getBalance();
                    $cardNumber->setBalance($balance + $chekData['S']);
                    $em->flush();
                } elseif ($cardIdNumber) {
                    $balance = $cardIdNumber->getBalance();
                    $cardIdNumber->setBalance($balance + $chekData['S']);
                    $em->flush();
                }
                $err = array(
                    'error' => 'Балы начислены',
                );
                return $this->render('checks/index.html.twig', [
                    'err' => $err,
                ]);
            }

            $err = array(
                'error' => 'Ошибка, такого номера ФН или карты лояльности - нет в базе',
            );
            return $this->render('checks/index.html.twig', [
                'err' => $err,
            ]);

        }

        $err = 0;
        return $this->render('checks/index.html.twig', [
            'err' => $err,
        ]);
    }
}

