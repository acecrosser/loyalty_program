<?php

namespace App\Controller;

use App\Entity\Fiscals;
use App\Form\FiscalsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;


class FiscalsController extends AbstractController
{
    /**
     * @Route("/add/fiscal", name="addFiscals")
     */
    public function addFiscals(Request $request): object
    {
        $fiscal = new  Fiscals();
        $form = $this->createForm(FiscalsType::class, $fiscal);
        $form->handleRequest($request);
        $dataFiscal = $this->getDoctrine()->getRepository(Fiscals::class)->findAll();


        if ($form->isSubmitted() && $form->isValid()) {

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($fiscal);
                $em->flush();

                return $this->redirectToRoute('addFiscals');

            } catch (UniqueConstraintViolationException $e) {
                $err = array(
                    'error' => 'Номер такого ФН уже есть в базе',
                );
                return $this->render('fiscals/index.html.twig', [
                    'err' => $err,
                    'form' => $form->createView(),
                    'fiscals' => $dataFiscal,
                ]);
            }
        }
        $err = 0;
        return $this->render('fiscals/index.html.twig', [
            'form' => $form->createView(),
            'fiscals' => $dataFiscal,
            'err' => $err,
        ]);
    }
}
