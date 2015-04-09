<?php namespace Anomaly\NavigationModule\Group\Command;


use Anomaly\NavigationModule\Group\Contract\GroupRepositoryInterface;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;

class GetActiveGroup implements SelfHandling
{

    public function handle(Request $request, GroupRepositoryInterface $groups)
    {
        return $groups->active($request->segment('group'));
    }
}