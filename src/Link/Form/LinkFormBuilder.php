<?php namespace Anomaly\NavigationModule\Link\Form;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class LinkFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Form
 */
class LinkFormBuilder extends FormBuilder
{

    /**
     * The related link type.
     *
     * @var null|Extension
     */
    protected $type = null;

    /**
     * The related group.
     *
     * @var null|GroupInterface
     */
    protected $group = null;

    /**
     * The skipped fields.
     *
     * @var array
     */
    protected $skips = [
        'parent',
        'entry',
        'type',
        'group'
    ];

    /**
     * Fired when the builder is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getType() && !$this->getEntry()) {
            throw new \Exception('The $type parameter is required when creating a link.');
        }

        if (!$this->getGroup() && !$this->getEntry()) {
            throw new \Exception('The $group parameter is required when creating a link.');
        }
    }

    /**
     * Fired just before saving the entry.
     */
    public function onSaving()
    {
        $entry = $this->getFormEntry();

        if (!$entry->group_id && $group = $this->getGroup()) {
            $entry->group_id = $group->getId();
        }

        if (!$entry->type && $type = $this->getType()) {
            $entry->type = $type->getNamespace();
        }
    }

    /**
     * Get the type.
     *
     * @return Extension|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param Extension $type
     * @return $this
     */
    public function setType(Extension $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the group.
     *
     * @return GroupInterface|null
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set the group.
     *
     * @param $group
     * @return $this
     */
    public function setGroup(GroupInterface $group)
    {
        $this->group = $group;

        return $this;
    }
}
