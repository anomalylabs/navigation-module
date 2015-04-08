<?php namespace Anomaly\NavigationModule\Group\Table;


use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class GroupTableBuilder extends TableBuilder
{

    protected $model = 'Anomaly\NavigationModule\Group\GroupModel';

    protected $columns = [
        'title',
        'slug',
    ];

    protected $buttons = [
        'edit',
    ];

}