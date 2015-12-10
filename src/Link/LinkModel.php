<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Type\Contract\LinkTypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Model\Navigation\NavigationLinksEntryModel;

/**
 * Class LinkModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link
 */
class LinkModel extends NavigationLinksEntryModel implements LinkInterface
{

    /**
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * The current flag.
     *
     * @var bool
     */
    protected $current = false;

    /**
     * Eager load these relationships.
     *
     * @var array
     */
    protected $with = [
        'parent',
        'allowedRoles'
    ];

    /**
     * Get the URL.
     *
     * @return string
     */
    public function getUrl()
    {
        $type = $this->getType();

        if (!$type) {
            return null;
        }

        return $type->url($this);
    }

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle()
    {
        $type = $this->getType();

        if (!$type) {
            return null;
        }

        return $type->title($this);
    }

    /**
     * Get the type.
     *
     * @return LinkTypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the related entry.
     *
     * @return EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Get the related allowed roles.
     *
     * @return EntryCollection
     */
    public function getAllowedRoles()
    {
        return $this->allowed_roles;
    }

    /**
     * Get the related parent.
     *
     * @return null|LinkInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get the parent ID.
     *
     * @return null|int
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Get the related child links.
     *
     * @return LinkCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Return the child links relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('Anomaly\NavigationModule\Link\LinkModel', 'parent_id', 'id');
    }

    /**
     * Return the model as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        $array['url']   = $this->getUrl();
        $array['title'] = $this->getTitle();

        return $array;
    }
}
