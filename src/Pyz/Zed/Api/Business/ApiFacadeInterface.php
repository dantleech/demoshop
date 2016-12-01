<?php

namespace Pyz\Zed\Api\Business;

interface ApiFacadeInterface
{

    /**
     * @param string $bundle
     *
     * @return array
     */
    public function getAnnotations($bundle);

}