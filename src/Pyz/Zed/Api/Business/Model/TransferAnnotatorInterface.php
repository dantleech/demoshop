<?php

namespace Pyz\Zed\Api\Business\Model;

interface TransferAnnotatorInterface
{

    /**
     * @param string $transfer
     *
     * @return array
     */
    public function annotate($transfer);

}
