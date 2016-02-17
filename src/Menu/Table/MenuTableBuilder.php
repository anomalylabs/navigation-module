<?php namespace Anomaly\NavigationModule\Menu\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class MenuTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Menu\Table
 */
class MenuTableBuilder extends TableBuilder
{

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'search' => [
            'columns' => [
                'name',
                'slug',
                'description'
            ]
        ]
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'name',
        'slug',
        'description'
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        [
            'type' => 'info',
            'icon' => 'link',
            'text' => 'module::button.links',
            'href' => 'admin/navigation/links/{entry.slug}'
        ],
        'edit'
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'delete'
    ];

}
