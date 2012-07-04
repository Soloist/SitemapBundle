<?php

namespace Soloist\Bundle\SitemapBundle\Event;

use Soloist\Bundle\SitemapBundle\Sitemap\Sitemap;
use Symfony\Component\EventDispatcher\Event;

/**
 * This class represent the `soloist_sitemap.build` event.
 */
class BuildSitemapEvent extends Event
{
    /**
     * @var Sitemap
     */
    private $sitemap;

    /**
     * @param \Soloist\Bundle\SitemapBundle\Sitemap\Sitemap $sitemap
     */
    public function __construct(Sitemap $sitemap)
    {
        $this->sitemap = $sitemap;
    }

    /**
     * @return Sitemap
     */
    public function getSitemap()
    {
        return $this->sitemap;
    }
}
