<?php namespace Anomaly\NavigationModule\Link\Tree;

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
     * Handle the tree segments.
     *
     * @param LinkTreeBuilder $builder
     */
    public function handle(LinkTreeBuilder $builder)
    {
        $builder->setSegments(
            [
                '<a href="' . url("/admin/navigation/links/{request.route.parameters.group}/edit/{entry.id}") . '">{entry.title}</a>'
            ]
        );
    }
}
