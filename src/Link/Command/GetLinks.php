<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Event\LinksHaveLoaded;
use Anomaly\NavigationModule\Menu\Command\GetMenu;
use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Support\Collection;

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
     * @return \Anomaly\NavigationModule\Link\LinkCollection|mixed|null
     */
    public function handle()
    {
        if (!$this->menu) {
            $this->menu = dispatch_now(new GetMenu($this->options->get('menu')));
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
            if ($link = dispatch_now(new GetParentLink($root, $links))) {
                $this->options->put('parent', $link);
            }
        }

        // Remove restricted for security purposes.
        dispatch_now(new RemoveRestrictedLinks($links));

        // Set the relationships manually.
        dispatch_now(new SetParentRelations($links));
        dispatch_now(new SetChildrenRelations($links));

        // Flag appropriate links.
        dispatch_now(new SetCurrentLink($links));
        dispatch_now(new SetActiveLinks($links));

        /*
         * Allow other things to inject into the menu
         */
        event(new LinksHaveLoaded($this->menu, $links));

        return $links;
    }
}
