<?php

namespace Soloist\Bundle\SitemapBundle\Sitemap;

use Soloist\Bundle\SitemapBundle\Event\BuildSitemapEvent;
use Soloist\Bundle\SitemapBundle\SitemapEvents;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * This class represents a Sitemap.
 * It's a composite of Soloist\Bundle\SitemapBundle\Sitemap\Item.
 */
class Sitemap extends Item
{
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * @var int the Sitemap identifier
     */
    private $id;

    /**
     * Constructs the sitemap
     *
     * @param UrlGeneratorInterface $router
     * @param EventDispatcher $dispatcher
     */
    public function __construct(UrlGeneratorInterface $router, EventDispatcher $dispatcher)
    {
        $this->router     = $router;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Trigger the build event.
     * Listener should add there's stuff by calling the `add()` or `createChild()` method.
     *
     * @return Sitemap
     */
    public function build()
    {
        $this->dispatcher->dispatch(SitemapEvents::BUILD_SITEMAP, new BuildSitemapEvent($this));

        return $this;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
