<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Amazonpay\Business;

use Pyz\Zed\Amazonpay\Business\Payment\Handler\Transaction\TransactionFactory;
use SprykerEco\Zed\Amazonpay\Business\AmazonpayBusinessFactory as SpykerAmazonpayBusinessFactory;

/**
 * @method \SprykerEco\Shared\Amazonpay\AmazonpayConfig getConfig()
 * @method \SprykerEco\Zed\Amazonpay\Persistence\AmazonpayQueryContainer getQueryContainer()
 */
class AmazonpayBusinessFactory extends SpykerAmazonpayBusinessFactory
{

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\TransactionFactoryInterface
     */
    public function createTransactionFactory()
    {
        return new TransactionFactory(
            $this->createAdapterFactory(),
            $this->getConfig(),
            $this->createTransactionLogger(),
            $this->getQueryContainer()
        );
    }

}
