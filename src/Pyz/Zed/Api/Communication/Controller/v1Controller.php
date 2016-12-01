<?php

namespace Pyz\Zed\Api\Communication\Controller;

use Symfony\Component\HttpFoundation\Request;
use Spryker\Zed\Application\Communication\Controller\AbstractController;

class v1Controller extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function docAction(Request $request)
    {
        return 'docAction';
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function docTransferAction(Request $request)
    {
        return 'docTransferAction';
    }

}