<?php namespace Anomaly\NavigationModule\Group;


use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class GroupFormBuilder extends FormBuilder
{

    /**
     * @var string
     */
    protected $model = 'Anomaly\NavigationModule\Group\GroupModel';

    /**
     * @var string
     */
    protected $title = 'anomaly.module.navigation::addon.new_groups';

    /**
     * @var array
     */
    protected $fields = [
        'title',
        'slug' => [
            'config' => [
                'watch' => 'title'
            ]
        ],
    ];

}