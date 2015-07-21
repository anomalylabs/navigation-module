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
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'name',
        'slug'
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
