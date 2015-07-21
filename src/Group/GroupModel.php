<?php namespace Anomaly\NavigationModule\Group;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\Streams\Platform\Model\Navigation\NavigationGroupsEntryModel;

/**
 * Class GroupModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group
 */
class GroupModel extends NavigationGroupsEntryModel implements GroupInterface
{

    /**
     * The cache minutes.
     *
     * @var int
     */
    protected $cacheMinutes = 99999;

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        self::observe(app(substr(__CLASS__, 0, -5) . 'Observer'));

        parent::boot();
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the class.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Get the related links.
     *
     * @return LinkCollection
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Return the links relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function links()
    {
        return $this->hasMany('Anomaly\NavigationModule\Link\LinkModel', 'group_id');
    }
}
