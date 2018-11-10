<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
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
     * @var LinkInterface
     */
    protected $link;

    /**
     * Create a new PurgeCache instance.
     *
     * @param LinkInterface $link
     */
    public function __construct(LinkInterface $link)
    {
        $this->link = $link;
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
