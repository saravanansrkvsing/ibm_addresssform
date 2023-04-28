define([
    'jquery',
    'mage/utils/wrapper'
], function (
    jQuery,
    wrapper
) {
    'use strict';

    return function (processor) {
        return wrapper.wrap(processor, function (proceed, payload) {
            payload = proceed(payload);

            var shippingAddress =  payload.addressInformation.shipping_address;
            var addressDistrict = jQuery('[name="custom_attributes[district]"]').val();

            if(addressDistrict == "" || addressDistrict == null){
                if(shippingAddress.customAttributes == "undefined" || shippingAddress.customAttributes == null){
                    addressDistrict = null;
                } else {
                    if(shippingAddress.customAttributes.district == "undefined" || shippingAddress.customAttributes.district == null) {
                        addressDistrict = null;
                    } else {
                        addressDistrict = shippingAddress.customAttributes.district.value;
                    }
                }
            }

           // console.log(payload.addressInformation);

            var goneExtentionAttributes = {
                'district': addressDistrict
            };
    
            payload.addressInformation.extension_attributes = _.extend(
                payload.addressInformation.extension_attributes,
                goneExtentionAttributes
            );
            
           // console.log(payload.addressInformation.extension_attributes);    
            return payload;
        });
    };
});