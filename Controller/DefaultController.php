<?php

namespace Soloist\Bundle\SitemapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class DefaultController extends Controller
{
    public function showAction($slug)
    {
        try {
            $sitemap = $this->get('soloist_sitemap.sitemap.'.$slug);
        } catch (ServiceNotFoundException $e) {
            throw $this->createNotFoundException('The sitemap with the slug "'.$slug.'" does not exists.', $e);
        }

        return $this->render('SoloistSitemapBundle:Default:show.html.twig', array('item' => $sitemap));
    }
}
