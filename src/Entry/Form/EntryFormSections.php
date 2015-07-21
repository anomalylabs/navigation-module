<?php namespace Anomaly\NavigationModule\Entry\Form;

/**
 * Class EntryFormSections
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Entry\Form
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
                        return $type->getAssignmentFieldSlugs();
                    }
                ],
                'link' => [
                    'fields' => function () use ($link) {
                        return $link->getAssignmentFieldSlugs();
                    }
                ]
            ]
        );
    }
}
