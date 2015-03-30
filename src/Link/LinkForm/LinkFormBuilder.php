<?php namespace Anomaly\NavigationModule\Link\LinkForm;

use Anomaly\NavigationModule\Link\Contract\LinkTypeExtensionInterface;
use Anomaly\Streams\Platform\Ui\Form\Form;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Foundation\Bus\DispatchesCommands;

/**
 * Class LinkFormBuilder
 * @package Anomaly\NavigationModule\Link
 */
class LinkFormBuilder extends FormBuilder
{
    use DispatchesCommands;

    /**
     * @var LinkTypeExtensionInterface
     */
    protected $extension;

    /**
     * @var string
     */
    protected $group;

    /**
     * @var string
     */
    protected $scope = 'default';

    /**
     * @var string
     */
    protected $model = 'Anomaly\NavigationModule\Link\LinkModel';

    /**
     * @return LinkTypeExtensionInterface
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param LinkTypeExtensionInterface $extension
     * @return $this
     */
    public function setExtension(LinkTypeExtensionInterface $extension)
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param string $group
     * @return $this
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

}