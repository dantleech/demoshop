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

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return mixed
     */
    public function executeAction(Request $request)
    {
        return new JsonResponse($this->resultToArray(
            $this->getFacade()->callBundleMethod(
                $request->get('bundle'),
                $request->get('method'),
                $request->get('arguments', [])
            )
        ));
    }

    /**
     * @param mixed $mixed
     *
     * @return string
     */
    protected function resultToArray($mixed)
    {
        if (is_scalar($mixed)) {
            return $mixed;
        }

        if ($mixed instanceof AbstractTransfer) {
            return $mixed->toArray(true);
        }

        if (is_array($mixed)) {
            $result = [];

            foreach ($mixed as $key => $value) {
                $result[$key] = $this->resultToArray($value);
            }

            return $result;
        }

        if ($mixed === null) {
            return null;
        }

        throw new \InvalidArgumentException();
    }

}