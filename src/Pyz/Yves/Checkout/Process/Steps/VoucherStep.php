<?php

namespace Pyz\Yves\Checkout\Process\Steps;

use Pyz\Yves\Checkout\Process\Steps\AbstractBaseStep;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Yves\StepEngine\Dependency\Step\StepWithBreadcrumbInterface;
use Symfony\Component\HttpFoundation\Request;
use Generated\Shared\Transfer\DiscountTransfer;
use Spryker\Client\Calculation\CalculationClientInterface;

class VoucherStep extends AbstractBaseStep implements StepWithBreadcrumbInterface
{
    /**
     * @var CalculationClientInterface
     */
    private $calculationClient;

    /**
     * @param string $stepRoute
     * @param string $escapeRoute
     */
    public function __construct($stepRoute, $escapeRoute, CalculationClientInterface $calculationClient)
    {
        parent::__construct($stepRoute, $escapeRoute);
        $this->calculationClient = $calculationClient;
    }

    /**
     * {@inheritDoc}
     */
    public function requireInput(AbstractTransfer $dataTransfer)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function postCondition(AbstractTransfer $dataTransfer)
    {
        return $this->hasDiscountVouncher($dataTransfer);
    }

    private function hasDiscountVouncher($dataTransfer): bool
    {
        // at least one voucher, that'll do!
        foreach ($dataTransfer->getVoucherDiscounts() as $discount) {
            return true;
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function getBreadcrumbItemTitle()
    {
        return 'Voucher';
    }

    /**
     * {@inheritDoc}
     */
    public function isBreadcrumbItemEnabled(AbstractTransfer $dataTransfer)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isBreadcrumbItemHidden(AbstractTransfer $dataTransfer)
    {
        return false;
    }

    public function execute(Request $request, AbstractTransfer $quoteTransfer)
    {
        $discountTransfer = new DiscountTransfer();
        $discountTransfer->setVoucherCode($quoteTransfer->getVoucherCode());
        $quoteTransfer->addVoucherDiscount($discountTransfer);

        $quoteTransfer = $this->calculationClient->recalculate($quoteTransfer);

        return $quoteTransfer;
    }
}

