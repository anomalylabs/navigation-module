<?php namespace Anomaly\NavigationModule\LinkType\Command;

use Anomaly\NavigationModule\Link\Contract\LinkTypeExtensionInterface;
use Anomaly\NavigationModule\Link\LinkTypeRepository;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;
use Illuminate\Contracts\Bus\SelfHandling;

class GetLinkTypes implements SelfHandling
{

    /**
     * @param LinkTypeRepository $repository
     * @return ExtensionCollection
     */
    public function handle(LinkTypeRepository $repository)
    {
        $linkTypes = $repository->all();
        /** @var LinkTypeExtensionInterface $type */
        foreach ($linkTypes as $type) {
//            $type = $type->getPresenter();

            $slug = $type->getSlug();
            $type->title = trans("anomaly.extension.{$slug}::addon.option.name");
            $type->uri = $slug;
        }
        return $linkTypes;
    }

}