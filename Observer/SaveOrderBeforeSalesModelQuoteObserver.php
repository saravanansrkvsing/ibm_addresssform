<?php
/**
 * Copyright © IBM, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Ibm\AddressForm\Observer;

use Magento\Framework\DataObject\Copy as ObjectCopyService;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;

class SaveOrderBeforeSalesModelQuoteObserver implements ObserverInterface
{
    /**
     * @var ObjectCopyService
     */
    private ObjectCopyService $objectCopyService;
    
    /**
     * @param ObjectCopyService $objectCopyService
     */
    public function __construct(
        ObjectCopyService        $objectCopyService
    ) {
        $this->objectCopyService = $objectCopyService;
    }

    /**
     * Upgrade sale order address district value before save the order
     *
     * @param Observer $observer
     * @return void
     */

    public function execute(\Magento\Framework\Event\Observer $observer): void
    {
        /* @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getData('order');
        /* @var \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getData('quote');

        $shippingAddressData = $quote->getShippingAddress()->getData();
        if (isset($shippingAddressData['district'])) {
            $order->getShippingAddress()->setDistrict($shippingAddressData['district']);
        }
        /*
        $this->objectCopyService->copyFieldsetToTarget(
            'sales_convert_quote_address',
            'to_order_address',
            $quote->getShippingAddress(),
            $order->getShippingAddress()
        );
        */     
    }
}
