<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class GetParentLink
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Command
 */
class GetParentLink implements SelfHandling
{

    /**
     * The starting path.
     *
     * @var string
     */
    private $path;

    /**
     * The link collection.
     *
     * @var LinkCollection
     */
    protected $links;

    /**
     * Create a new GetParentLink instance.
     *
     * @param string         $string
     * @param LinkCollection $links
     */
    public function __construct($path, LinkCollection $links)
    {
        $this->path  = $path;
        $this->links = $links;
    }

    /**
     * Handle the command.
     *
     * @param UrlGenerator $url
     * @return LinkInterface|null
     */
    public function handle(UrlGenerator $url)
    {
        /* @var LinkInterface $link */
        foreach ($this->links as $link) {
            if ($url->to($this->path) == $link->getUrl()) {
                return $link;
            }
        }

        return null;
    }
}
