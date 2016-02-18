<?php namespace Anomaly\NavigationModule\Link\Entry;

/**
 * Class EntryFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\NavigationModule\Link\Entry
 */
class EntryFormSections
{

    /**
     * Handle the sections.
     *
     * @param EntryFormBuilder $builder
     */
    public function handle(EntryFormBuilder $builder)
    {
        $type = $builder->getChildFormStream('type');
        $link = $builder->getChildFormStream('link');

        $builder->setSections(
            [
                'type' => [
                    'fields' => function () use ($type) {
                        return array_map(
                            function ($slug) {
                                return 'type_' . $slug;
                            },
                            $type->getAssignmentFieldSlugs()
                        );
                    }
                ],
                'link' => [
                    'fields' => function () use ($link) {
                        return array_map(
                            function ($slug) {
                                return 'link_' . $slug;
                            },
                            $link->getAssignmentFieldSlugs()
                        );
                    }
                ]
            ]
        );
    }
}
