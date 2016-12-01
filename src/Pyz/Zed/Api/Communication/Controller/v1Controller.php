<?php

namespace Pyz\Zed\Api\Communication\Controller;

use Symfony\Component\HttpFoundation\Request;
use Spryker\Zed\Application\Communication\Controller\AbstractController;
use Spryker\Shared\Transfer\AbstractTransfer;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method \Pyz\Zed\Api\Business\ApiFacadeInterface getFacade()
 */
class v1Controller extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function docAction(Request $request)
    {
        return [
            'annotations' => $this->getFacade()->getAnnotations($request->get('bundle'))
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function docTransferAction(Request $request)
    {
        return [
            'transfer_annotation' => $this->getFacade()->getTransferAnnotations($request->get('transfer'))
        ];
    }

}