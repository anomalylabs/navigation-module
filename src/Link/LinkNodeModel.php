<?php namespace Anomaly\NavigationModule\Link;

use Kalnoy\Nestedset\Node;

class LinkNodeModel extends Node
{

    /**
     * @var string
     */
    protected $table = 'navigation_links';

    /**
     * The name of "lft" column.
     *
     * @var string
     */
    const LFT = 'left';

    /**
     * The name of "rgt" column.
     *
     * @var string
     */
    const RGT = 'right';

    /**
     * The name of "parent id" column.
     *
     * @var string
     */
    const PARENT_ID = 'parent_id';

    /**
     * Insert direction.
     *
     * @var string
     */
    const BEFORE = 'before';

    /**
     * Insert direction.
     *
     * @var string
     */
    const AFTER = 'after';
}