<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Support\Decorator;

/**
 * Class LinkPresenter
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link
 */
class LinkPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     * This is for IDE hinting.
     *
     * @var LinkInterface
     */
    protected $object;

    /**
     * Return the edit link.
     *
     * @return string
     */
    public function editLink()
    {
        return app('html')->link(
            implode(
                '/',
                array_filter(
                    [
                        'admin',
                        $this->object->getStreamNamespace(),
                        $this->object->getStreamSlug(),
                        $this->object->getGroupSlug(),
                        'edit',
                        $this->object->getId()
                    ]
                )
            ),
            $this->object->getTitle()
        );
    }

    /**
     * Return the related children.
     *
     * @return LinkCollection
     */
    public function children()
    {
        return (new Decorator())->decorate($this->object->getChildren());
    }
}
