/**
 * Copyright 2022, Todd Lininger Design, LLC. All rights reserved.
 * https://toddlininger.com * See LICENSE.txt for details.
 */
/*browser:true*/
/*global define*/
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'tis',
                component: 'ToddLininger_StorePayment/js/view/payment/method-renderer/tis-method'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);