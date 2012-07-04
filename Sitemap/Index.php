<?php

namespace Soloist\Bundle\SitemapBundle\Sitemap;

class Index implements \IteratorAggregate, \Countable
{
    /**
     * @var array|Sitemap
     */
    protected $sitemaps;

    /**
     * @var string
     */
    protected $id;

    /**
     * @param Sitemap $sitemap
     * @return Index
     */
    public function add(Sitemap $sitemap)
    {
        $this->sitemaps[] = $sitemap;

        return $this;
    }

    /**
     * @param string $id
     * @return Index
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array|\Soloist\Bundle\SitemapBundle\Sitemap\Sitemap
     */
    public function getSitemaps()
    {
        return $this->sitemaps;
    }

    /**
     * Return an iterator over sitemaps
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->sitemaps);
    }

    /**
     * Returns the number of Sitemaps
     * @return int
     */
    public function count()
    {
        return count($this->sitemaps);
    }

}
