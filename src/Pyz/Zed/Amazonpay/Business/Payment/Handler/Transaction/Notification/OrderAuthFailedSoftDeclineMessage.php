<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use Generated\Shared\Transfer\OrderTransfer;

class OrderAuthFailedSoftDeclineMessage extends AbstractEmailNotificationMessage
{

    /**
     * @param OrderTransfer $orderTransfer
     */
    public function __construct(OrderTransfer $orderTransfer)
    {
        parent::__construct($orderTransfer);

        $this->subject = 'Please update your payment information';
        $this->body = <<<EOT
Valued customer,
Thank you very much for your order at SHOPNAME.
Amazon Pay was not able to process your payment.
Please go to https://payments.amazon.*/jr/your-account/orders?language=en_GB
and update the payment information for your order. Afterwards we will
automatically request payment again from Amazon Pay and you will receive a
confirmation email.
EOT;
    }

}
