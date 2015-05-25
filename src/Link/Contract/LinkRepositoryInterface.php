<?php namespace Anomaly\NavigationModule\Link\Contract;

/**
 * Interface LinkRepositoryInterface
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Contract
 */
interface LinkRepositoryInterface
{

    /**
     * Find a link by it's ID.
     *
     * @param $id
     * @return null|LinkInterface
     */
    public function find($id);

    /**
     * Delete a link.
     *
     * @param LinkInterface $link
     * @return bool
     */
    public function delete(LinkInterface $link);
}
