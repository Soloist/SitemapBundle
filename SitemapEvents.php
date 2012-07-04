<?php

namespace Soloist\Bundle\SitemapBundle;

class SitemapEvents
{
    /**
     * The `soloist_sitemap.build` event is thrown each time a sitemap is generated.
     *
     * The Listener is called with `Soloist\Bundle\SitemapBundle\Event\BuildSitemapEvent`
     *
     * @var string
     */
    const BUILD_SITEMAP = 'soloist_sitemap.build';
}
