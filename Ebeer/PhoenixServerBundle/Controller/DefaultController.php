<?php

namespace Ebeer\PhoenixServerBundle\Controller;

use Phoenix\Loader\Loader;
use Phoenix\Optimizer\Optimizer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/sjs/{batch}.js")
     */
    public function jsAction($batch)
    {
        $optimizer = new Optimizer($this->get('ebeer.phoenix.loader')->getConfig());

        return new Response($optimizer->optimizeFiles(Loader::getInstance()->translateBatch($batch)));
    }

    /**
     * @Route("/tst/{files}")
     * @Template
     */
    public function tstAction($files)
    {
        return ['files' => $files];
    }
}
