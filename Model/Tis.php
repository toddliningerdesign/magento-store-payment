<?php
/**
 * Copyright 2022, Todd Lininger Design, LLC. All rights reserved. * https://toddlininger.com * See LICENSE.txt for details.
 */
namespace ToddLininger\StorePayment\Model;

/**
 * Pay In Store payment method model
 */
class Tis extends \Magento\Payment\Model\Method\AbstractMethod
{
    /**
     * Payment code
     *
     * @var string
     */
    protected $_code = 'tis';

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;
}