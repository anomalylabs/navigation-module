<?php namespace Anomaly\NavigationModule\Menu\Command;

use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\Streams\Platform\Support\Presenter;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class GetMenu
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Menu\Command
 */
class GetMenu implements SelfHandling
{

    /**
     * The menu identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetMenu instance.
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
     * @param MenuRepositoryInterface $menus
     * @return MenuInterface|null
     */
    public function handle(MenuRepositoryInterface $menus)
    {
        if (is_numeric($this->identifier)) {
            return $menus->find($this->identifier);
        }

        if (is_string($this->identifier)) {
            return $menus->findBySlug($this->identifier);
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
