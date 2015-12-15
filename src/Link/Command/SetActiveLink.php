<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

/**
 * Class SetActiveLink
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Command
 */
class SetActiveLink implements SelfHandling
{

    /**
     * The link collection.
     *
     * @var LinkCollection
     */
    protected $links;

    /**
     * Create a new SetActiveLink instance.
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
        $active = null;

        $route        = $request->route();
        $compiled     = $route->getCompiled();
        $staticPrefix = $compiled->getStaticPrefix();

        $match = $request->getUriForPath($staticPrefix);

        /* @var LinkInterface $link */
        foreach ($this->links as $link) {
            if ($link->getUrl() == $match) {
                $active = $link;
            }
        }

        /**
         * If we have an current link determined
         * then mark it as such.
         *
         * @var LinkInterface $active
         */
        if ($active) {
            $active->setActive(true);
        }
    }
}
