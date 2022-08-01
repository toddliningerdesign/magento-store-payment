<?php
/**
 * Copyright 2022, Todd Lininger Design, LLC. All rights reserved. * https://toddlininger.com * See LICENSE.txt for details.
 */
namespace ToddLininger\StorePayment\Observer;

use Magento\Framework\Event\ObserverInterface;

class AfterSaveOrderObserver implements ObserverInterface
{
    /**
     * Sets current instructions for bank transfer account
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getOrder();
        $paymentMethod = $order->getPayment()->getMethod();
        $grandTotal = $order->getGrandTotal();
        if ($paymentMethod == 'tis' || $grandTotal == 0) {
            if ($order->canInvoice()) {
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $invoice = $objectManager->create('Magento\Sales\Model\Service\InvoiceService')->prepareInvoice($order);
                $invoice->register();
                $invoice->save();
                $order->addStatusHistoryComment(
                    __('Notified customer about invoice #%1.', $invoice->getId())
                )
                ->setIsCustomerNotified(true)
                ->save();
            }
            if ($order->getIsVirtual()) {
                $order->setState(\Magento\Sales\Model\Order::STATE_COMPLETE, true);
                $order->setStatus('complete');
                $order->save();
            } else {
                $order->setState(\Magento\Sales\Model\Order::STATE_PROCESSING, true);
                $order->setStatus('processing');
                $order->save();
            }
        }
    }
}
