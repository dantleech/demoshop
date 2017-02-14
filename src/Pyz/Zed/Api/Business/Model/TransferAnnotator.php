<?php

namespace Pyz\Zed\Api\Business\Model;

use ReflectionClass;

class TransferAnnotator implements TransferAnnotatorInterface
{

    /**
     * @param string $transfer
     *
     * @return array
     */
    public function annotate($transfer)
    {
        $reflection = new ReflectionClass($transfer);
        $metadata = $reflection->getDefaultProperties()['transferMetadata'];

        $result = [];
        foreach ($metadata as $attribute => $properties) {
            $result[$attribute] = print_r($properties, true);
        }

        return $result;
    }

}
