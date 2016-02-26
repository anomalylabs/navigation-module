<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Seeder\LinkSeeder;
use Anomaly\NavigationModule\Seeder\MenuSeeder;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class NavigationModuleSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\NavigationModule
 */
class NavigationModuleSeeder extends Seeder
{

    /**
     * Run the seeder.
     */
    public function run()
    {
        $this->call(MenuSeeder::class);
        $this->call(LinkSeeder::class);
    }
}
