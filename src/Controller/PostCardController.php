<?php

namespace App\Controller;

use App\Entity\Cards;
use App\Form\CardsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class PostCardController extends AbstractController
{
    /**
     * @Route("/add/card", name="addCard")
     */
    public function addCard(Request $request): object
    {
        $card = new Cards();
        $form = $this->createForm(CardsType::class, $card);
        $form->handleRequest($request);
        $cards = $this->getDoctrine()->getRepository(Cards::class)->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $id_card = uniqid('', true);
                $balance = 0;
                $card->setIdcard($id_card);
                $card->setCreated(new \DateTime());
                $card->setBalance($balance);

                $em = $this->getDoctrine()->getManager();
                $em->persist($card);
                $em->flush();

                return $this->redirectToRoute('addCard');

            } catch (UniqueConstraintViolationException $e) {
                $err = array(
                    'error' => 'Такой клиент уже есть в базе',
                );
                return $this->render('post_card/index.html.twig', [
                    'err' => $err,
                    'form' => $form->createView(),
                    'cards' => $cards,
                ]);
            }
        }

        $err = 0;
        return $this->render('post_card/index.html.twig', [
            'form' => $form->createView(),
            'cards' => $cards,
            'err' => $err,

        ]);
    }
}
