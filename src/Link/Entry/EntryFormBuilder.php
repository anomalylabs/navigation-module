<?php namespace Anomaly\NavigationModule\Link\Entry;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class EntryFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\NavigationModule\Link\Entry
 */
class EntryFormBuilder extends MultipleFormBuilder
{

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [
        'save' => [
            'redirect' => 'admin/navigation/links/{request.route.parameters.menu}'
        ]
    ];

    /**
     * Fired just after the type is saved.
     */
    public function onSavedType()
    {
        /* @var FormBuilder $type */
        /* @var FormBuilder $form */
        $type = $this->forms->get('type');
        $form = $this->forms->get('link');

        $entry = $type->getFormEntry();
        $link  = $form->getFormEntry();

        if (!$link->entry_type) {
            $link->entry_type = get_class($entry);
            $link->entry_id   = $entry->getId();
        }
    }

    /**
     * Get the contextual entry ID.
     *
     * @return int|mixed|null
     */
    public function getContextualId()
    {
        /* @var FormBuilder $form */
        $form = $this->forms->get('link');

        return $form->getContextualId();
    }


}
