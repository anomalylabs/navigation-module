<?php namespace Anomaly\NavigationModule\Command;

use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\Link\Contract\LinkTypeExtensionInterface;
use Anomaly\NavigationModule\Link\Contract\LinkTypeRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

/**
 * Class GetLinkTypeButtons
 * @package Anomaly\NavigationModule\Command
 */
class GetLinkTypeButtons implements SelfHandling
{

    /**
     * @param LinkTypeRepositoryInterface $repository
     * @return array
     */
    public function handle(LinkTypeRepositoryInterface $repository, GroupRepositoryInterface $groups, Request $request)
    {
        $buttons = [];

        /** @var LinkTypeExtensionInterface $linkType */
        foreach ($repository->all() as $linkType) {
            $buttons[] = [
                'button' => 'new',
                'icon'   => 'fa fa-link',
                'text'   => trans($linkType->getNamespace('addon.label')),
                'href'   => route('admin.navigation.links.create', [
                    'group' => $groups->active($request->segment(3))->slug,
                    'type'  => $linkType->getLinkType(),
                ]),
            ];
        }

        return $buttons;
    }


}