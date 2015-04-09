<?php namespace Anomaly\NavigationModule\LinkType\Command;

use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\NavigationModule\LinkType\Contract\LinkTypeExtensionInterface;
use Anomaly\NavigationModule\LinkType\Contract\LinkTypeRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

/**
 * Class GetLinkTypeButtons
 *
 * @package Anomaly\NavigationModule\Command
 */
class GetLinkTypeButtons implements SelfHandling
{

    /**
     * @param LinkTypeRepositoryInterface $repository
     * @param GroupRepositoryInterface    $groups
     * @param Request                     $request
     * @return array
     */
    public function handle(LinkTypeRepositoryInterface $repository, GroupRepositoryInterface $groups, Request $request)
    {
        $buttons = [];

        $activeGroup = $groups->active($request->segment('group'));

        if ($activeGroup) {
            /** @var LinkTypeExtensionInterface $linkType */
            foreach ($repository->all() as $linkType) {
                $buttons[] = [
                    'type' => 'new',
                    'icon' => 'fa fa-link',
                    'text' => trans($linkType->getNamespace('addon.label')),
                    'href' => route(
                        'admin.navigation.links.create',
                        [
                            'group' => $activeGroup->slug,
                            'type'  => $linkType->getLinkType(),
                        ]
                    ),
                ];
            }
        }

        return $buttons;
    }
}