<?php namespace Anomaly\NavigationModule\Menu\Command;

use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Http\HttpCache;

/**
 * Class PurgeCache
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PurgeCache
{

    /**
     * The link instance.
     *
     * @var MenuInterface
     */
    protected $menu;

    /**
     * Create a new PurgeCache instance.
     *
     * @param MenuInterface $menu
     */
    public function __construct(MenuInterface $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Purge the cash.
     *
     * @param HttpCache $cache
     */
    public function handle(HttpCache $cache)
    {
        $cache->clear();
    }

}
