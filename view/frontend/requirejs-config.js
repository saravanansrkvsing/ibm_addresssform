var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information': {
                'Ibm_AddressForm/js/action/set-shipping-information-mixin': true
            },
            'Magento_Checkout/js/model/shipping-save-processor/payload-extender': {
                'Ibm_AddressForm/js/model/shipping-save-processor/payload-extender-mixin': true
            }
        }
    }
};