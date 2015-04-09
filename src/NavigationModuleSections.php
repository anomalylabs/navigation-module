<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\LinkType\Command\GetLinkTypeButtons;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class NavigationModuleSections
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule
 */
class NavigationModuleSections
{

    use DispatchesCommands;

    /**
     * Handle the module sections.
     *
     * @param ControlPanelBuilder $builder
     */
    public function handle(ControlPanelBuilder $builder)
    {
        $builder->setSections(
            [
                'links'  => [
                    'href'    => route('admin.navigation'),
                    'buttons' => [
                        [
                            'button'   => 'new',
                            'text'     => 'New Link',
                            'dropdown' => $this->dispatch(new GetLinkTypeButtons()),
                        ]
                    ]
                ],
                'groups' => [
                    'buttons' => [
                        [
                            'button' => 'new',
                            'text'   => 'New Group',
                            'href'   => route('admin.navigation.groups.create'),
                        ]
                    ]
                ],
            ]
        );
    }
}