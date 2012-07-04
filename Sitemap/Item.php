<?php

namespace Soloist\Bundle\SitemapBundle\Sitemap;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Item implements \IteratorAggregate
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
     */
    public function setParams(array $params)
    {
        $this->params = $params;
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
     */
    public function setRoute($route)
    {
        $this->route = $route;
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
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
     * Returns the iterator
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * Sets the router
     *
     * @param UrlGeneratorInterface $router
     */
    public function setRouter(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Item $parent
     */
    public function setParent(Item $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return Item
     */
    public function getParent()
    {
        return $this->parent;
    }
}
