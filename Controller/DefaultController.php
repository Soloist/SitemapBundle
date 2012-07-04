<?php

namespace Soloist\Bundle\SitemapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class DefaultController extends Controller
{
    public function showAction($slug)
    {
        return $this->render(
            'SoloistSitemapBundle:Default:show.html.twig',
            array('item' => $this->getBuildedSitemap($slug))
        );
    }

    public function showXmlAction($slug)
    {
        return $this->render(
            'SoloistSitemapBundle:Default:show.xml.twig',
            array('item' => $this->getBuildedSitemap($slug))
        );
    }

    public function showXmlIndexAction($slug)
    {
        return $this->render(
            'SoloistSitemapBundle:Default:showIndex.xml.twig',
            array('index' => $this->getIndex($slug))
        );
    }

    /**
     * @param $slug
     * @return \Soloist\Bundle\SitemapBundle\Sitemap\Sitemap
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function getBuildedSitemap($slug)
    {
        try {
            return $this->get('soloist_sitemap.sitemap.'.$slug)->build();
        } catch (ServiceNotFoundException $e) {
            throw $this->createNotFoundException('The sitemap with the slug "'.$slug.'" does not exists.', $e);
        }
    }

    /**
     * @param $slug
     * @return \Soloist\Bundle\SitemapBundle\Sitemap\Index
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function getIndex($slug)
    {
        try {
            return $this->get('soloist_sitemap.index.'.$slug);
        } catch (ServiceNotFoundException $e) {
            throw $this->createNotFoundException('The sitemap with the slug "'.$slug.'" does not exists.', $e);
        }
    }
}
