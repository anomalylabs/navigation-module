<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\LinkType\Command\GetLinkTypeButtons;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class NavigationModuleSectionsHandler
 * @package Anomaly\NavigationModule
 */
class NavigationModuleSectionsHandler
{
    use DispatchesCommands;

    public function handle(ControlPanelBuilder $builder)
    {
        $buttons = [];

        $linkTypeButtons = $this->dispatch(new GetLinkTypeButtons());

        if ($linkTypeButtons) {
            $buttons[] = [
                'button'   => 'new',
                'text'     => 'New Link',
                'dropdown' => $linkTypeButtons,
            ];
        }

/*        $buttons[] = [
            'button' => 'new',
            'text'   => 'New Group',
            'href'   => route('admin.navigation.groups.create'),
        ];*/

        $builder->setSections([
            'links'  => [
                'href'    => route('admin.navigation'),
                'buttons' => $buttons
            ],
            'groups' => [
                'buttons' => $buttons
            ],
        ]);
    }

}