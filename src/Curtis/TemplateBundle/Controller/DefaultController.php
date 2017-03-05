<?php

namespace Curtis\TemplateBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="home_page")
     */
    public function indexAction()
    {
        return $this->render('CurtisTemplateBundle:Default:index.html.twig');
    }
}
