<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use Generated\Shared\Transfer\OrderTransfer;

class OrderAuthFailedHardDeclineMessage extends AbstractEmailNotificationMessage
{

    /**
     * @param OrderTransfer $orderTransfer
     */
    public function __construct(OrderTransfer $orderTransfer)
    {
        parent::__construct($orderTransfer);

        $this->subject = 'Please contact us about your order';
        $this->body = <<<EOT
Valued customer,
Unfortunately Amazon Pay declined the payment for your order in our online shop Demoshop. Please contact us. 
EOT;

    }

}
