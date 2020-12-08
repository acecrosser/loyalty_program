<?php

namespace App\Controller;

use App\Entity\Cards;
use App\Form\CardsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostCardController extends AbstractController
{
    /**
     * @Route("/add/card", name="add_card")
     */
    public function addCard(Request $request): object
    {
        $card = new Cards();
        $form = $this->createForm(CardsType::class, $card);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id_card = uniqid('', true);
            $balance = 0;
            $card->setIdCard($id_card);
            $card->setCreated(new \DateTime());
            $card->setBalance($balance);

            $em = $this->getDoctrine()->getManager();
            $em->persist($card);
            $em->flush();

            return $this->redirectToRoute('add_card');
        }

        return $this->render('post_card/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
