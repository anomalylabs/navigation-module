<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Event\LinksHaveLoaded;
use Anomaly\NavigationModule\Menu\Command\GetMenu;
use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class GetLinks
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\NavigationModule\Link\Command
 */
class GetLinks implements SelfHandling
{

    use DispatchesJobs;

    /**
     * The options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * The menu object.
     *
     * @var MenuInterface
     */
    protected $menu;

    /**
     * Create a new GetLinks instance.
     *
     * @param Dispatcher         $events
     * @param Collection         $options
     * @param MenuInterface|null $menu
     */
    public function __construct(Collection $options, MenuInterface $menu = null)
    {
        $this->options = $options;
        $this->menu    = $menu;
    }

    /**
     * Handle the command.
     *
     * @param Dispatcher $events
     * @return \Anomaly\NavigationModule\Link\LinkCollection|mixed|null
     */
    public function handle(Dispatcher $events)
    {
        if (!$this->menu) {
            $this->menu = $this->dispatch(new GetMenu($this->options->get('menu')));
        }

        if ($this->menu) {
            $links = $this->menu->getLinks();
        } else {
            $links = $this->options->get('links');
        }

        if (!$links) {
            return null;
        }

        if ($root = $this->options->get('root')) {
            if ($link = $this->dispatch(new GetParentLink($root, $links))) {
                $this->options->put('parent', $link);
            }
        }

        // Remove restricted for security purposes.
        $this->dispatch(new RemoveRestrictedLinks($links));

        // Set the relationships manually.
        $this->dispatch(new SetParentRelations($links));
        $this->dispatch(new SetChildrenRelations($links));

        // Flag appropriate links.
        $this->dispatch(new SetCurrentLink($links));
        $this->dispatch(new SetActiveLinks($links));

        /**
         * Allow other things to inject into the menu
         */
        $events->fire(new LinksHaveLoaded($this->menu, $links));

        return $links;
    }
}
