<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;

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
     * Return the view link.
     *
     * @return string
     */
    public function viewLink()
    {
        return app('html')->link(
            $this->object->getUrl(),
            $this->object->getTitle(),
            [
                'target' => '_blank'
            ]
        );
    }
}
