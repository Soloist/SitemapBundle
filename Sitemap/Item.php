<?php

namespace Soloist\Bundle\SitemapBundle\Sitemap;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * This class represents a sitemap entry.
 * The root node must by represented by `Soloist\Bundle\SitemapBundle\Sitemap\Sitemap`
 */
class Item implements \IteratorAggregate, \Countable
{
    /**
     * Child items
     *
     * @var array|Item
     */
    protected $items;

    /**
     * The parent Item
     *
     * @var Item
     */
    protected $parent;

    /**
     * The item title
     *
     * @var string
     */
    protected $title;

    /**
     * The url of the item
     *
     * @var string
     */
    protected $url;

    /**
     * The route used to generate URL
     *
     * @var string
     */
    protected $route;

    /**
     * The route params
     *
     * @var array
     */
    protected $params = array();

    /**
     * @var string
     */
    protected $changeFrequency;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var float
     */
    protected $priority;

    /**
     * The router instance. Used to generate URLs with Route/Params
     *
     * @var UrlGeneratorInterface
     */
    protected $router;

    /**
     * Adds a child item.
     *
     * @param Item $item
     * @return Item
     */
    public function add(Item $item)
    {
        $this->items[] = $item;
        $item->setParent($this);

        return $this;
    }

    /**
     * Creates an item
     *
     * @return Item
     */
    public function create()
    {
        $item = new Item;
        $item->setRouter($this->router);

        return $item;
    }

    /**
     * Creates an Item and add it to the childs.
     *
     * @return Item
     */
    public function createChild()
    {
        $this->add($item = $this->create());

        return $item;
    }

    /**
     * Generate if needed the URL and return it.
     *
     * @param bool $absolute
     * @return string
     */
    public function generateUrl($absolute = false)
    {
        if (null !== $this->url) {
            return $this->url;
        }

        return $this->url = $this->router->generate($this->route, $this->params, $absolute);
    }

    /**
     * @param array $params
     * @return Item
     */
    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param string $route
     * @return Item
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $title
     * @return Item
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $url
     * @return Item
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array|Item
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * Sets the router
     *
     * @param UrlGeneratorInterface $router
     * @return Item
     */
    public function setRouter(UrlGeneratorInterface $router)
    {
        $this->router = $router;

        return $this;
    }

    /**
     * @param Item $parent
     * @return Item
     */
    public function setParent(Item $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Item
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Returns the iterator
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * Returns the number of child items
     *
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @param string $changeFrequency
     * @return Item
     */
    public function setChangeFrequency($changeFrequency)
    {
        $this->changeFrequency = $changeFrequency;

        return $this;
    }

    /**
     * @return string
     */
    public function getChangeFrequency()
    {
        return $this->changeFrequency;
    }

    /**
     * @param float $priority
     * @return Item
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return float
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param \DateTime $updatedAt
     * @return Item
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
