<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/index", name="index")
     * @Template()
     */
    public function indexAction(){
        return $this->render('default/index.html.twig');
    }
}
