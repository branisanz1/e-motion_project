<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Form\RentalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RentalController
 * @package App\Controller
 * @Route("/rental")
 */
class RentalController extends AbstractController
{
    /**
     * @Route("/add/car", name="rental")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addCarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(RentalType::class, $vehicle = new Vehicle());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($vehicle);
            $em->flush();

            return $this->redirectToRoute("home");
        }
        return $this->render("rental/register.html.twig", array(
            'form'  => $form->createView(),
        ));
    }
}