<?php namespace Anomaly\NavigationModule\Link\Type\Contract;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Interface LinkTypeInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Type\Contract
 */
interface LinkTypeInterface
{

    /**
     * Return the link URL.
     *
     * @param LinkInterface $link
     * @return string
     */
    public function url(LinkInterface $link);

    /**
     * Return the link title.
     *
     * @param LinkInterface $link
     * @return string
     */
    public function title(LinkInterface $link);

    /**
     * Return if the link is broken or not.
     *
     * @param LinkInterface $link
     * @return bool
     */
    public function broken(LinkInterface $link);

    /**
     * Return the form builder for
     * the link type entry.
     *
     * @return FormBuilder
     */
    public function builder();
}
