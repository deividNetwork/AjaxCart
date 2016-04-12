<?php

    /**
     * @category DeividNetwork
     * @package DeividNetwork_AjaxCart
     * @author Deivid Network <deividnetwork@gmail.com>
     */
    class DeividNetwork_AjaxCart_Block_Cart extends Mage_Core_Block_Template {
        public function getUrlAjaxCart() {
            return Mage::getUrl('ajaxcart/index/addtocart');
        }
    }
