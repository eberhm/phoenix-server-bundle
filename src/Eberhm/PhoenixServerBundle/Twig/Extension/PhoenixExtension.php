<?php

namespace Eberhm\PhoenixServerBundle\Twig\Extension;

use Phoenix\Asset\UrlDecorator\Base;
use Phoenix\Asset\UrlDecorator\Cdn;
use Phoenix\Loader\Loader;
use Phoenix\SnippetRenderer\RequireSnippet;
use Phoenix\SnippetRenderer\ScriptTag;

class PhoenixExtension extends \Twig_Extension
{
    /** @var  \Phoenix\Loader\Loader */
    private $loader;

    function __construct($loader)
    {
        $this->loader = $loader;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'requirejs' => new \Twig_Function_Method($this, 'addFile'),
            'initJs'    => new \Twig_Function_Method($this, 'initJs')
        );
    }

    public function addFile($file)
    {
        $this->loader->load($file);
    }

    public function initJs()
    {
        $renderer = new ScriptTag();
        $urlDecorator = new Cdn(new Base());
        $urlDecorator->setBaseUrl('localhost:8080/');
        $renderer->setUrlDecorator($urlDecorator);


        return $renderer->render($this->loader->buildContainer());
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'phoenix';
    }
}
