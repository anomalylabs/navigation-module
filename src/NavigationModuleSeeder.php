<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Group\GroupModel;
use Illuminate\Database\Seeder;

/**
 * Class NavigationModuleSeeder
 * @package Anomaly\NavigationModule
 */
class NavigationModuleSeeder extends Seeder
{

    public function run()
    {
        $groups = ['Header', 'Footer'];

        foreach ($groups as $group) {
            GroupModel::create([
                'slug'  => str_slug($group),
                'title' => $group,
            ]);
        }
    }

}