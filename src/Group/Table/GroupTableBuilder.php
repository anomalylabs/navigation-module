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
        'entry.view_link',
        'slug'
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
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
