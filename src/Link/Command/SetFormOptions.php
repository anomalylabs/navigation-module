<?php namespace Anomaly\NavigationModule\Link\Command;


use Anomaly\NavigationModule\Link\LinkFormBuilder;
use Illuminate\Contracts\Bus\SelfHandling;

class SetFormOptions implements SelfHandling
{

    /**
     * @var LinkFormBuilder
     */
    private $builder;

    public function __construct(LinkFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function handle()
    {
        $this->builder->setFormOption('sections', [
            [
                [
                    'title'  => 'module::section.new_link',
                    'fields' => [

                        'title',
                    ]
                ]
            ]
        ]);
    }

}