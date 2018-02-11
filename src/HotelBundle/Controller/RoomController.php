<?php

namespace HotelBundle\Controller;

use HotelBundle\Entity\Media;
use HotelBundle\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Room controller.
 *
 * @Route("room")
 */
class RoomController extends Controller
{
    /**
     * Lists all room entities.
     *
     * @Route("/", name="room_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rooms = $em->getRepository('HotelBundle:Room')->findAll();

        return $this->render('@Hotel/room/index.html.twig', array(
            'rooms' => $rooms,
        ));
    }

    public function addImage($newId, $fileName){

        $media = new Media();

        $roomId = $newId;
        $fileywiley = $fileName;
        $media->setImageUrl($fileywiley);
        $media->setType('room');
        $media->setFeatured(0);
        $media->setRoom($roomId);

        $em = $this->getDoctrine()->getManager();
        $em->persist($media);
        $em->flush();

        return true;
    }

    /**
     * Creates a new room entity.
     *
     * @Route("/new", name="room_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $room = new Room();

        $form = $this->createForm('HotelBundle\Form\RoomType', $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $fileUploader = $this->get('HotelBundle\Service\FileUploader');

            $file = $form['media']->getData();
            $fileName = $fileUploader->upload($file[0]);


            $em = $this->getDoctrine()->getManager();
            $em->persist($room);
            $em->flush();

            $this->addImage($room->getId(), $fileName);

            return $this->redirectToRoute('room_show', array('id' => $room->getId()));
        }

        return $this->render('@Hotel/room/new.html.twig', array(
            'room' => $room,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a room entity.
     *
     * @Route("/{id}", name="room_show")
     * @Method("GET")
     */
    public function showAction(Room $room)
    {
        $deleteForm = $this->createDeleteForm($room);

        $image = $this->getDoctrine()
            ->getRepository(Room::class)
            ->getThinggie($room->getId());
        return $this->render('@Hotel/room/show.html.twig', array(
            'room' => $room,
            'image' => $image,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing room entity.
     *
     * @Route("/{id}/edit", name="room_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Room $room)
    {
        $deleteForm = $this->createDeleteForm($room);
        $editForm = $this->createForm('HotelBundle\Form\RoomType', $room);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('room_edit', array('id' => $room->getId()));
        }

        $image = $this->getDoctrine()
            ->getRepository(Room::class)
            ->getThinggie($room->getId());


        return $this->render('@Hotel/room/edit.html.twig', array(
            'room' => $room,
            'image' => $image,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a room entity.
     *
     * @Route("/{id}", name="room_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Room $room)
    {
        $form = $this->createDeleteForm($room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($room);
            $em->flush();
        }

        return $this->redirectToRoute('room_index');
    }

    /**
     * Creates a form to delete a room entity.
     *
     * @param Room $room The room entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Room $room)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('room_delete', array('id' => $room->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
