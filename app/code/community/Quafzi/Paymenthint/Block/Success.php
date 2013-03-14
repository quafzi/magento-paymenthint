<?php
class Quafzi_Paymenthint_Block_Info extends Mage_Core_Block_Abstract
{
    protected $payment;

    public function getPayment()
    {
        if (is_null($this->payment)) {
            $orderId = Mage::getSingleton('checkout/type_onepage')->getCheckout()->getLastOrderId();
            $this->payment = Mage::getModel('sales/order')->load($orderId)->getPayment();
        }

        return $this->payment;
    }


    public function isOutputRequired()
    {
        return ('payone_advance_payment' == $this->getPayment()->getMethod());
    }

    public function getPaymentInfo()
    {
        $method = $this->getPayment()->getMethodInstance();
        $infoBlockType = $method->getInfoBlockType();
        $infoBlock = Mage::app()->getLayout()->createBlock($infoBlockType);
        $infoBlock->setInfo($method->getInfoInstance());

        return $infoBlock;
    }
}
