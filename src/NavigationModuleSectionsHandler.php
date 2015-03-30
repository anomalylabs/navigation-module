<?php namespace Anomaly\NavigationModule;


use Anomaly\NavigationModule\Command\GetLinkTypeButtons;
use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NavigationModuleSectionsHandler
{
    use DispatchesCommands;

    public function handle(ControlPanelBuilder $builder)
    {

        $buttons = [];

        $linkTypeButtons = $this->dispatch(new GetLinkTypeButtons());

        if ($linkTypeButtons) {
            $buttons[] = [
                'button'   => 'new',
                'text'     => 'New Link',
                'dropdown' => $linkTypeButtons,
            ];
        }

        $buttons[] = [
            'button' => 'new',
            'text'   => 'New Group',
            'href'   => route('admin.navigation.groups.create'),
        ];

        $builder->setSections([
            'links' => [
                'buttons' => $buttons
            ],
            'groups' => [
                'buttons' => $buttons
            ],
        ]);
    }

}