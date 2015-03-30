<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class AnomalyModuleNavigation_1_0_0_alpha_CreateNavigationLinksStream extends Migration
{

    /**
     * Stream
     *
     * @var array
     */
    protected $stream = [
        'slug'   => 'links',
        'locked' => true,
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
        'linkable'  => [],
        'group'     => [],
        'scope'     => [],
        'parent_id' => [],
        'left'      => [],
        'right'     => [],
        'depth'     => [],
    ];

}
