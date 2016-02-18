<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

/**
 * Class SetCurrentLink
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\NavigationModule\Link\Command
 */
class SetCurrentLink implements SelfHandling
{

    /**
     * The link collection.
     *
     * @var LinkCollection
     */
    protected $links;

    /**
     * Create a new SetCurrentLink instance.
     *
     * @param LinkCollection $links
     */
    public function __construct(LinkCollection $links)
    {
        $this->links = $links;
    }

    /**
     * Handle the command.
     *
     * @param Request $request
     */
    public function handle(Request $request)
    {
        $current = null;

        /**
         * If the route does not exist,
         * i.e. a 404 or 500 handling page.
         * Then we don't have anything to do.
         */
        if (!$route = $request->route()) {
            return;
        };

        $compiled     = $route->getCompiled();
        $staticPrefix = $compiled->getStaticPrefix();

        $exact   = $request->fullUrl();
        $partial = $request->getUriForPath($staticPrefix);

        /* @var LinkInterface $link */
        foreach ($this->links as $link) {

            if ($link->getUrl() == $exact) {
                $current = $link;
            } elseif ($link->getUrl() == $partial) {
                $current = $link;
            }
        }

        /**
         * If we have an current link determined
         * then mark it as such.
         *
         * @var LinkInterface $current
         */
        if ($current) {
            $current->setCurrent(true);
        }
    }
}
