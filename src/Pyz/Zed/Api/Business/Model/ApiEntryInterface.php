<?php

namespace Pyz\Zed\Api\Business\Model;

interface ApiEntryInterface
{

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function forwardCall($name, array $arguments);

    /**
     * @return array
     */
    public function getAnnotations();

}