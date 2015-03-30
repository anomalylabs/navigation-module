<?php namespace Anomaly\NavigationModule\Link\LinkForm\Accessor;


use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

class GroupAccessor
{
    public function __construct($fieldType)
    {
        dd($fieldType);
    }


    public function get(EntryInterface $entry, $fieldSlug)
    {
        dd($entry);
    }

}