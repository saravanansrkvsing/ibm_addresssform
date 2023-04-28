<?php
/**
 * Copyright © IBM, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ibm\AddressForm\Model\Plugin\Checkout;

use Magento\Quote\Model\QuoteRepository;

/**
 * Update quote shipping address extension attributes before saving shipping and billing address
 */
class ShippingInformationManagement
{
    /**
     * @var QuoteRepository
     */
    protected $quoteRepository;
    /**
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }
    /**
     * Update Quote shipping address district form extension attribute before save the address information.
     *
     * @param ShippingInformationManagement $subject
     * @param string $cartId
     * @param ShippingInformationInterface $addressInformation
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ): void {
		if ($extensionAttributes = $addressInformation->getExtensionAttributes()) {
            $address = $addressInformation->getShippingAddress();
            $address->setDistrict($extensionAttributes->getDistrict());
        } 
              
    }
}