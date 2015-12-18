<?php namespace Anomaly\NavigationModule\Group\Command;

use Anomaly\NavigationModule\Group\Contract\GroupInterface;
use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\Streams\Platform\Support\Presenter;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class GetGroup
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group\Command
 */
class GetGroup implements SelfHandling
{

    /**
     * The group identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetGroup instance.
     *
     * @param mixed $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param GroupRepositoryInterface $groups
     * @return GroupInterface|null
     */
    public function handle(GroupRepositoryInterface $groups)
    {
        if (is_numeric($this->identifier)) {
            return $groups->find($this->identifier);
        }

        if (is_string($this->identifier)) {
            return $groups->findBySlug($this->identifier);
        }

        if ($this->identifier instanceof Presenter) {
            return $this->identifier->getObject();
        }

        if (is_object($this->identifier)) {
            return $this->identifier;
        }

        return null;
    }
}
