<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Type\Contract\LinkTypeInterface;
use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Model\Navigation\NavigationLinksEntryModel;

/**
 * Class LinkModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LinkModel extends NavigationLinksEntryModel implements LinkInterface
{

    /**
     * The cascaded relations.
     *
     * @var array
     */
    protected $cascades = [
        'children',
        'entry',
    ];

    /**
     * Touch relations.
     *
     * @var array
     */
    protected $touches = [
        'menu',
    ];

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
        'entry',
        'allowedRoles',
    ];

    /**
     * The URL schemes links may use.
     *
     * @var array
     */
    protected $schemes = [
        'http',
        'https',
        'mailto',
        'tel',
        'sms',
    ];

    /**
     * Return the host.
     *
     * @return string
     */
    public function host()
    {
        return array_get(parse_url((string)$this->getUrl()), 'host');
    }

    /**
     * Return the URI path.
     *
     * @return string
     */
    public function path()
    {
        $pattern = '/^\/(' . implode('|', array_keys(config('streams::locales.supported'))) . ')(\/|$)/';

        return preg_replace($pattern, '/', (string)array_get(parse_url((string)$this->getUrl()), 'path'));
    }

    /**
     * Get the URL.
     *
     * @return null|string
     */
    public function getUrl()
    {
        $type = $this->getType();

        if (!$type) {
            return null;
        }

        $url = $type->url($this);

        if (!is_string($url) || $url === '') {
            return null;
        }

        // Browsers ignore whitespace and control characters
        // when reading a scheme, so strip them before looking.
        $scheme = preg_replace('/[\s\x00-\x1F\x7F]+/', '', $url);

        if (preg_match('/^([a-z][a-z0-9+.\-]*):/i', $scheme, $matches)) {
            return in_array(strtolower($matches[1]), $this->schemes) ? $url : null;
        }

        return $url;
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
     * Get the broken flag.
     *
     * @return bool
     */
    public function isBroken()
    {
        $type = $this->getType();

        if (!$type) {
            return null;
        }

        return $type->broken($this);
    }

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        $type = $this->getType();

        if (!$type) {
            return null;
        }

        return $type->enabled($this);
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
     * Get the HTML class.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
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
     * Get the link target.
     *
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
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
     * Set the parent ID.
     *
     * @param $id
     * @return $this
     */
    public function setParentId($id)
    {
        $this->parent_id = $id;

        return $this;
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
     * Get the menu.
     *
     * @return MenuInterface
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Get the menu slug.
     *
     * @return string
     */
    public function getMenuSlug()
    {
        $menu = $this->getMenu();

        return $menu->getSlug();
    }

    /**
     * Set the active flag.
     *
     * @param $true
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Return the active flag.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set the current flag.
     *
     * @param $true
     * @return $this
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Return the current flag.
     *
     * @return bool
     */
    public function isCurrent()
    {
        return $this->current;
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
