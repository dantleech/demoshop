<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\Amazonpay\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrder;
use SprykerEco\Shared\Amazonpay\AmazonpayConstants;
use SprykerEco\Zed\Amazonpay\Communication\Plugin\Oms\Command\AbstractAmazonpayCommandPlugin;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class UpdateAuthorizationStatusCommandPlugin extends AbstractAmazonpayCommandPlugin
{

    /**
     * @inheritdoc
     */
    public function run(array $salesOrderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        if ($this->getPaymentEntity($orderEntity)->getStatus()
            === AmazonpayConstants::OMS_STATUS_AUTH_PENDING
            && count($orderEntity->getItems()) === count($salesOrderItems)
        ) {
            $orderTransfer = $this->getOrderTransfer($orderEntity);
            $this->getFacade()->updateAuthorizationStatus($orderTransfer);
        }

        return [];
    }

}
