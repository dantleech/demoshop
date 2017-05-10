<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\AbstractNotificationMessage;
use Generated\Shared\Transfer\OrderTransfer;

class AbstractEmailNotificationMessage extends AbstractNotificationMessage
{

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $body;

    /**
     * @param OrderTransfer $orderTransfer
     */
    public function __construct(OrderTransfer $orderTransfer)
    {
        $this->email = $orderTransfer->getEmail();
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

}
