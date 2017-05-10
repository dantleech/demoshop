<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\OrderAuthFailedNotifyTransaction;
use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\OrderMessageFactoryInterface;
use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\OrderNotificationFactory as SprykerOrderNotificationFactory;
use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\OrderNotificationSenderInterface;

class OrderNotificationFactory extends SprykerOrderNotificationFactory
{

    /**
     * @return \SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\OrderTransactionInterface
     */
    public function createOrderAuthFailedTransaction()
    {
        return new OrderAuthFailedNotifyTransaction(
            $this->createFailedAuthNotificationSender(),
            $this->createOrderMessageFactory()
        );
    }

    /**
     * @return OrderNotificationSenderInterface
     */
    protected function createFailedAuthNotificationSender()
    {
        return new OrderFailedAuthNotificationSender();
    }

    /**
     * @return OrderMessageFactoryInterface
     */
    protected function createOrderMessageFactory()
    {
        return new OrderMessageFactory();
    }

}
