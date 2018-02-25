<?php

namespace HotelBundle\Controller;

use HotelBundle\Entity\Arrangement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Arrangement controller.
 *
 * @Route("arrangement")
 */
class ArrangementController extends Controller
{
    /**
     * Lists all arrangement entities.
     *
     * @Route("/", name="arrangement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $arrangements = $em->getRepository('HotelBundle:Arrangement')->findAll();

        return $this->render('@Hotel/arrangement/index.html.twig', array(
            'arrangements' => $arrangements,
        ));
    }

    /**
     * Creates a new arrangement entity.
     *
     * @Route("/new", name="arrangement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $arrangement = new Arrangement();
        $form = $this->createForm('HotelBundle\Form\ArrangementType', $arrangement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($arrangement);
            $em->flush();

            return $this->redirectToRoute('arrangement_show', array('id' => $arrangement->getId()));
        }

        return $this->render('@Hotel/arrangement/new.html.twig', array(
            'arrangement' => $arrangement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a arrangement entity.
     *
     * @Route("/{id}", name="arrangement_show")
     * @Method("GET")
     */
    public function showAction(Arrangement $arrangement)
    {
        $deleteForm = $this->createDeleteForm($arrangement);

        return $this->render('@Hotel/arrangement/show.html.twig', array(
            'arrangement' => $arrangement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing arrangement entity.
     *
     * @Route("/{id}/edit", name="arrangement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Arrangement $arrangement)
    {
        $deleteForm = $this->createDeleteForm($arrangement);
        $editForm = $this->createForm('HotelBundle\Form\ArrangementType', $arrangement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('arrangement_edit', array('id' => $arrangement->getId()));
        }

        return $this->render('@Hotel/arrangement/edit.html.twig', array(
            'arrangement' => $arrangement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a arrangement entity.
     *
     * @Route("/{id}", name="arrangement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Arrangement $arrangement)
    {
        $form = $this->createDeleteForm($arrangement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($arrangement);
            $em->flush();
        }

        return $this->redirectToRoute('arrangement_index');
    }

    /**
     * Creates a form to delete a arrangement entity.
     *
     * @param Arrangement $arrangement The arrangement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Arrangement $arrangement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('arrangement_delete', array('id' => $arrangement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
