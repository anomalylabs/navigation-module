<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

class LinkableFieldType extends FieldType
{

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.navigation_linkable::input';

}