<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleNavigation_1_0_0_CreateLinksStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleNavigation_1_0_0_CreateLinksStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'links'
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'group'  => [
            'required' => true
        ],
        'type'   => [
            'required' => true
        ],
        'entry'  => [
            'required' => true
        ],
        'target' => [
            'required' => true
        ],
        'class',
        'parent',
        'roles'
    ];

}
