<?php namespace Anomaly\NavigationModule\Group\Command;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\Streams\Platform\View\ViewTemplate;
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
     * The group interface.
     *
     * @var GroupInterface
     */
    protected $group;

    /**
     * Create a new SetCurrentLink instance.
     *
     * @param GroupInterface $group
     */
    public function __construct(GroupInterface $group)
    {
        $this->group = $group;
    }

    /**
     * Handle the command.
     *
     * @param Request                 $request
     * @param ViewTemplate            $template
     * @param LinkRepositoryInterface $links
     */
    public function handle(Request $request, ViewTemplate $template, LinkRepositoryInterface $links)
    {
        $current = null;

        /* @var LinkInterface $link */
        foreach ($links->findAllByGroup($this->group) as $link) {

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
            $template->set('link', $current);
        }
    }
}
