<?php namespace Anomaly\NavigationModule\Link\Tree;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;

/**
 * Class LinkTreeSegments
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Tree
 */
class LinkTreeSegments
{

    /**
     * Handle the segments.
     *
     * @param LinkTreeBuilder $builder
     */
    public function handle(LinkTreeBuilder $builder)
    {
        $builder->setSegments(
            [
                'entry.edit_link',
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-danger',
                    'value'       => '<i class="fa fa-chain-broken"></i>',
                    'attributes'  => [
                        'title' => 'module::message.broken'
                    ],
                    'enabled'     => function (LinkInterface $entry) {

                        $type = $entry->getType();

                        return !$type->exists($entry);
                    }
                ]
            ]
        );
    }
}
