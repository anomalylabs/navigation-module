<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;

/**
 * Class LinkRepository
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link
 */
class LinkRepository implements LinkRepositoryInterface
{

    /**
     * The link model.
     *
     * @var LinkModel
     */
    protected $model;

    /**
     * Create a new LinkRepository instance.
     *
     * @param LinkModel $model
     */
    public function __construct(LinkModel $model)
    {
        $this->model = $model;
    }
}
