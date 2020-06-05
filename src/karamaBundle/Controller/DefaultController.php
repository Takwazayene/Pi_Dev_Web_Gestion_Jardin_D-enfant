<?php

namespace karamaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('karamaBundle:Default:index.html.twig');
    }
}
