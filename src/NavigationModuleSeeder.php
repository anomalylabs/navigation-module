<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Link\LinkModel;
use Illuminate\Database\Seeder;
use Obrignoni\NavigationModule\Group\GroupModel;

/**
 * Class NavigationModuleSeeder
 * @package Anomaly\NavigationModule
 */
class NavigationModuleSeeder extends Seeder
{

    public function run()
    {
        $group = 'Top';

        GroupModel::create([
            'slug' => str_slug($group),
            'title' => $group,
        ]);
    }

}