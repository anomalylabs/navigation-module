<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Model\EloquentNodeModel;

class AnomalyModuleNavigation_1_0_0_alpha_CreateNavigationLinksStream extends Migration
{

    /**
     * Stream
     *
     * @var array
     */
    protected $stream = [
        'namespace' => 'navigation',
        'slug'      => 'links',
        'locked'    => true,
    ];

    /**
     * Field assignments
     *
     * @var array
     */
    protected $assignments = [
        'title'     => [
            'required' => true
        ],
        'slug'      => [
            'unique' => true
        ],
        'linkable'  => [],
        'group'     => [],
        'parent'    => [],
        'type'      => [],
        'hidden'    => [],
        'max_depth' => [],
    ];

}
