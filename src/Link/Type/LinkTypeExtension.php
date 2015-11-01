<?php namespace Anomaly\NavigationModule\Link\Type;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\Type\Contract\LinkTypeInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class LinkTypeExtension
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Type
 */
class LinkTypeExtension extends Extension implements LinkTypeInterface
{

    /**
     * Return the link URL.
     *
     * @param LinkInterface $link
     * @return string
     */
    public function url(LinkInterface $link)
    {
        return null;
    }

    /**
     * Return the link title.
     *
     * @param LinkInterface $link
     * @return string
     */
    public function title(LinkInterface $link)
    {
        return null;
    }

    /**
     * Return the form builder for
     * the link type entry.
     *
     * @return FormBuilder
     */
    public function builder()
    {
        return null;
    }
}
