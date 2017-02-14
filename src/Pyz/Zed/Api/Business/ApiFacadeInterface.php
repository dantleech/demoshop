<?php

namespace Pyz\Zed\Api\Business;

interface ApiFacadeInterface
{

    /**
     * @param string $bundle
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     */
    public function callBundleMethod($bundle, $method, array $arguments);

    /**
     * @param string $bundle
     *
     * @return array
     */
    public function getAnnotations($bundle);

    /**
     * @param string $transfer
     *
     * @return array
     */
    public function getTransferAnnotations($transfer);

}