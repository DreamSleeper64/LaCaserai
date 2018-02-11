<?php

namespace HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default_index")
     */
    public function indexAction()
    {
        return $this->render('@Hotel/Default/index.html.twig');
    }
}
