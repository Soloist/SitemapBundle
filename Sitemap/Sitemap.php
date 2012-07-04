<?php

namespace Soloist\Bundle\SitemapBundle\Sitemap;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Sitemap extends Item
{
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * @var the Sitemap identifier
     */
    private $id;

    /**
     * Constructs the sitemap
     *
     * @param UrlGeneratorInterface $router
     */
    public function __construct(UrlGeneratorInterface $router, EventDispatcher $dispatcher)
    {
        $this->router     = $router;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param \Soloist\Bundle\SitemapBundle\Sitemap\the $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Soloist\Bundle\SitemapBundle\Sitemap\the
     */
    public function getId()
    {
        return $this->id;
    }
}
