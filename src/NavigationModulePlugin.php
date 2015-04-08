<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Link\Command\GetRootLinks;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class NavigationModulePlugin
 * @package Anomaly\NavigationModule
 */
class NavigationModulePlugin extends Plugin
{
    use DispatchesCommands;

    /**
     * Get plugin functions.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('navigation_links', [$this, 'links']),
            new \Twig_SimpleFunction('navigation_children', [$this, 'children']),
        ];
    }

    /**
     * @param $groupSlug
     * @param int $maxDepth
     * @param bool $showHidden
     * @return mixed
     */
    public function links($groupSlug, $maxDepth = 0, $showHidden = false)
    {
        return $this->dispatch(new GetRootLinks($groupSlug, $maxDepth, $showHidden))->decorated();
    }

    /**
     * @param $linkSlug
     * @param int $maxDepth
     */
    public function children($linkSlug, $maxDepth = 0)
    {
        //return $this->
    }

}