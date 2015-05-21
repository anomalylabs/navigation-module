<?php namespace Anomaly\NavigationModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class NavigationModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule
 */
class NavigationModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'link';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'groups' => [
            'buttons' => [
                'new_group',
                [
                    'text'        => 'New Link',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/navigation/ajax/choose_link_type'
                ]
            ]
        ]
    ];

}
