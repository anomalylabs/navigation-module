<?php namespace Anomaly\NavigationModule\Group\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class GroupTableBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group\Table
 */
class GroupTableBuilder extends TableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        [
            'sortable'    => true,
            'sort_column' => 'name',
            'heading'     => 'entry.name',
            'wrapper'     => '<strong>{entry.name}</strong><br>{entry.description}'
        ],
        'slug'
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
            'text' => 'Links',
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
