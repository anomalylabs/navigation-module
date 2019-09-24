<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Menu\Command\GetMenu;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RenderNavigation
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RenderNavigation
{



    /**
     * The rendering options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * Create a new RenderNavigation instance.
     *
     * @param Collection $options
     */
    public function __construct(Collection $options)
    {
        $this->options = $options;
    }

    /**
     * Handle the command.
     *
     * @param  Factory $view
     * @return null|string
     */
    public function handle(Factory $view)
    {
        dispatch_now(new HandlePresets($this->options));

        $menu  = dispatch_now(new GetMenu($this->options->get('menu')));
        $links = dispatch_now(new GetLinks($this->options, $menu));

        return $view->make(
            $this->options->get('view', 'anomaly.module.navigation::links'),
            [
                'menu'    => $menu,
                'links'   => $links,
                'options' => $this->options,
            ]
        )->render();
    }
}
