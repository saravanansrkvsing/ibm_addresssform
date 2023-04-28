<?php
/**
 * Copyright © IBM, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Ibm\AddressForm\Block\Plugin\Checkout;

class LayoutProcessor
{
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        $customAttributeCode = 'district';
    $customField = [
        'component' => 'Magento_Ui/js/form/element/abstract',
        'config' => [
            // customScope is used to group elements within a single form (e.g. they can be validated separately)
            'customScope' => 'shippingAddress.custom_attributes',
            'customEntry' => null,
            'template' => 'ui/form/field',
            'elementTmpl' => 'ui/form/element/input',
            
        ],
        'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
        'label' => 'District',
        'provider' => 'checkoutProvider',
        'sortOrder' => 100,
        'validation' => [
        'required-entry' => true
        ],
        'options' => [],
        'filterBy' => null,
        'customEntry' => null,
        'visible' => true,
        'value' => '' // value field is used to set a default value of the attribute
    ];

$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;

        return $jsLayout;
    }
}