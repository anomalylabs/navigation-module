<?php namespace Anomaly\NavigationModule\Link\LinkForm;

use Anomaly\NavigationModule\LinkType\Contract\LinkTypeExtensionInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class LinkFormBuilder
 * @package Anomaly\NavigationModule\Link
 */
class LinkFormBuilder extends FormBuilder
{

    /**
     * @var string
     */
    protected $model = 'Anomaly\NavigationModule\Link\LinkModel';

}