<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	/**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction(){
        return $this->render('BlogBundle:Default:index.html.twig');
    }    
}
