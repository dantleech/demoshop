<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Amazonpay\Business\Payment\Handler\Transaction;

use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\OrderNotificationFactoryInterface;
use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionCollection;
use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\TransactionFactory as SprykerTransactionFactory;
use Pyz\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\OrderNotificationFactory;

class TransactionFactory extends SprykerTransactionFactory
{

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createUpdateOrderAuthorizationStatusTransaction()
    {
        $parentHandler = parent::createUpdateOrderAuthorizationStatusTransaction();

        return new OrderTransactionCollection(
            [
                $parentHandler,
                $this->createOrderNotificationFacory()->createOrderAuthFailedTransaction(),
            ]
        );
    }

    /**
     * @return OrderNotificationFactoryInterface
     */
    protected function createOrderNotificationFacory()
    {
        return new OrderNotificationFactory();
    }

}
