<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleNavigationCreateLinksStream
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleNavigationCreateLinksStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'     => 'links',
        'sortable' => true
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'menu'   => [
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
        'allowed_roles'
    ];

}
