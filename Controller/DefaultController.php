<?php

namespace Soloist\Bundle\SitemapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SoloistSitemapBundle:Default:index.html.twig', array('name' => $name));
    }
}
