<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\AbstractNotificationMessage;
use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\OrderMessageFactory as SysOrderMessageFactory;
use Generated\Shared\Transfer\OrderTransfer;

class OrderMessageFactory extends SysOrderMessageFactory
{

    /**
     * @param OrderTransfer $orderTransfer
     *
     * @return AbstractNotificationMessage
     */
    public function createFailedAuthMessage(OrderTransfer $orderTransfer)
    {
        if ($orderTransfer->getAmazonpayPayment()
            ->getAuthorizationDetails()
            ->getAuthorizationStatus()
            ->getIsSuspended()
        ) {
            return new OrderAuthFailedSoftDeclineMessage($orderTransfer);
        } elseif (
        $orderTransfer->getAmazonpayPayment()
            ->getAuthorizationDetails()
            ->getAuthorizationStatus()
            ->getIsDeclined()
        ) {
            return new OrderAuthFailedHardDeclineMessage($orderTransfer);
        }
    }

}
