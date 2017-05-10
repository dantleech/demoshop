<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification;

use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\AbstractNotificationMessage;
use SprykerEco\Zed\Amazonpay\Business\Payment\Handler\Transaction\Notification\OrderFailedAuthNotificationSender as SysOrderFailedAuthNotificationSender;

class OrderFailedAuthNotificationSender extends SysOrderFailedAuthNotificationSender
{

    /**
     * @param AbstractNotificationMessage $notificationMessage
     */
    public function notify(AbstractNotificationMessage $notificationMessage)
    {
        $mail =
            'To: ' . $notificationMessage->getEmail() . PHP_EOL .
            'Subject: ' . $notificationMessage->getEmail() . PHP_EOL .
            'Body: ' . $notificationMessage->getBody() . PHP_EOL . PHP_EOL;

        file_put_contents(
            '/tmp/amazonpaymail.txt',
            $mail,
            FILE_APPEND
        );

        mail(
            $notificationMessage->getEmail(),
            $notificationMessage->getEmail(),
            $notificationMessage->getBody()
        );
    }
}
