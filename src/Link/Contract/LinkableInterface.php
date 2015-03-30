<?php namespace Anomaly\NavigationModule\Link\Contract;


interface LinkableInterface
{

    /**
     * Get the url from the linkable model.
     *
     * @return string
     */
    public function getUrl();

}