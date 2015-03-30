<?php namespace Anomaly\NavigationModule\Group\Contract;
use Anomaly\NavigationModule\Group\GroupModel;
use Illuminate\Support\Collection;

/**
 * Interface GroupRepositoryInterface
 * @package Anomaly\NavigationModule\Group\Contract
 */
interface GroupRepositoryInterface
{

    /**
     * @return Collection|array
     */
    public function all();

    /**
     * @param $slug
     * @return GroupModel
     */
    public function active($slug);

    /**
     * @param $slug
     * @return GroupModel
     */
    public function findBySlug($slug);

}