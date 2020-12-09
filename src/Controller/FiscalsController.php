<?php

namespace App\Controller;

use App\Entity\Fiscals;
use App\Form\FiscalsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FiscalsController extends AbstractController
{
    /**
     * @Route("/add/fiscal", name="add_fiscals")
     */
    public function addFiscals(Request $request): object
    {
        $fiscal = new  Fiscals();
        $form = $this->createForm(FiscalsType::class, $fiscal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($fiscal);
            $em->flush();

            return $this->redirectToRoute('add_fiscals');
        }

        return $this->render('fiscals/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
