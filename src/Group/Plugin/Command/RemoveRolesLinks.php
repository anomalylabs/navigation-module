<?php namespace Anomaly\NavigationModule\Group\Plugin\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Auth\Guard;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class RemoveRolesLinks
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Group\Plugin\Command
 */
class RemoveRolesLinks implements SelfHandling
{

    /**
     * The link collection.
     *
     * @var LinkCollection
     */
    protected $links;

    /**
     * Create a new RemoveRolesLinks instance.
     *
     * @param LinkCollection $links
     */
    public function __construct(LinkCollection $links)
    {
        $this->links = $links;
    }

    /**
     * Handle the command.
     *
     * @param Guard $auth
     */
    public function handle(Guard $auth)
    {
        /* @var UserInterface|null $user */
        $user = $auth->user();

        /* @var LinkInterface $link */
        foreach ($this->links as $key => $link) {

            $roles = $link->getAllowedRoles();

            /**
             * If there are role restrictions
             * but no user is signed in then
             * we can't authorize anything!
             */
            if (!$roles->isEmpty() && !$user) {

                $this->links->forget($key);

                continue;
            }

            /**
             * If there are role restrictions
             * and the user does not belong to
             * any of them then don't show it.
             */
            if (!$roles->isEmpty() && !$user->hasAnyRole($roles)) {

                $this->links->forget($key);

                continue;
            }
        }
    }
}
