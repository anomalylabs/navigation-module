<?php namespace Anomaly\NavigationModule\Link\Entry;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;

/**
 * Class EntryFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class EntryFormBuilder extends MultipleFormBuilder
{

    /**
     * Fired when form is ready to build.
     */
    public function onReady()
    {
        if ($this->getFormMode() == 'create') {
            $this->setOption('redirect', 'admin/navigation/links/{request.route.parameters.menu}');
        }
    }

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
