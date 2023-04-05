<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Event\LinksHaveLoaded;
use Anomaly\NavigationModule\Menu\Command\GetMenu;
use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Class GetLinks
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetLinks
{
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
     * @param Collection $options
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
     * @param  Dispatcher $events
     * @return \Anomaly\NavigationModule\Link\LinkCollection|mixed|null
     */
    public function handle(Dispatcher $events)
    {
        if (!$this->menu) {
            $this->menu = dispatch_sync(new GetMenu($this->options->get('menu')));
        }

        if ($this->menu) {
            $links = $this->menu->getLinks();
        } else {
            $links = $this->options->get('links');
        }

        if (!$links) {
            return null;
        }

        $links = $links->enabled();

        if ($root = $this->options->get('root')) {
            if ($link = dispatch_sync(new GetParentLink($root, $links))) {
                $this->options->put('parent', $link);
            }
        }

        // Remove restricted for security purposes.
        dispatch_sync(new RemoveRestrictedLinks($links));

        // Set the relationships manually.
        dispatch_sync(new SetParentRelations($links));
        dispatch_sync(new SetChildrenRelations($links));

        // Flag appropriate links.
        dispatch_sync(new SetCurrentLink($links));
        dispatch_sync(new SetActiveLinks($links));

        /*
         * Allow other things to inject into the menu
         */
        event(new LinksHaveLoaded($this->menu, $links));

        return $links;
    }
}
