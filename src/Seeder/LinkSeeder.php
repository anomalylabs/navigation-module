<?php namespace Anomaly\NavigationModule\Seeder;

use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\UrlLinkTypeExtension\UrlLinkTypeModel;

/**
 * Class LinkSeeder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\NavigationModule\Seeder
 */
class LinkSeeder extends Seeder
{

    /**
     * The link repository.
     *
     * @var LinkRepositoryInterface
     */
    protected $links;

    /**
     * Create a new LinkSeeder instance.
     *
     * @param $links
     */
    public function __construct(LinkRepositoryInterface $links)
    {
        $this->links = $links;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        $repository = new EntryRepository();

        $repository->setModel(new UrlLinkTypeModel());

        $repository->truncate();

        $pyrocms = $repository->create(
            [
                'en'  => [
                    'title' => 'PyroCMS.com'
                ],
                'url' => 'http://pyrocms.com/'
            ]
        );

        $documentation = $repository->create(
            [
                'en'  => [
                    'title' => 'Documentation'
                ],
                'url' => 'http://pyrocms.com/documentation'
            ]
        );

        $this->links->truncate();

        $this->links->create(
            [
                'menu'   => 1,
                'target' => '_blank',
                'entry'  => $pyrocms,
                'type'   => 'anomaly.extension.url_link_type'
            ]
        );

        $this->links->create(
            [
                'menu'   => 1,
                'target' => '_blank',
                'entry'  => $documentation,
                'type'   => 'anomaly.extension.url_link_type'
            ]
        );
    }
}
