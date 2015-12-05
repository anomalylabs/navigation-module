<?php namespace Anomaly\NavigationModule\Group\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

/**
 * Class SetCurrentLink
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group\Command
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

        foreach ($this->links as $link) {

            /**
             * Get the HREF for both the current
             * and loop iteration link.
             */
            $url        = $link->getUrl();
            $currentUrl = '';

            if ($current && $current instanceof LinkInterface) {
                $currentUrl = $current->getUrl();
            }

            /**
             * If the request URL does not even
             * contain the HREF then skip it.
             */
            if (!str_contains($request->url(), $url)) {
                continue;
            }

            /**
             * Compare the length of the current HREF
             * and loop iteration HREF. The longer the
             * HREF the more detailed and exact it is and
             * the more likely it is the current HREF and
             * therefore the current link.
             */
            $urlLength        = strlen($url);
            $currentUrlLength = strlen($currentUrl);

            if ($urlLength > $currentUrlLength) {
                $current = $link;
            }
        }

        /**
         * If we have an current link determined
         * then mark it as such.
         */
        if ($current && $current instanceof LinkInterface) {
            //$current->setCurrent(true);
        }
    }
}
