<?php

    /**
     * @category DeividNetwork
     * @package DeividNetwork_AjaxCart
     * @author Deivid Network <deividnetwork@gmail.com>
     */
    class DeividNetwork_AjaxCart_Helper_Data extends Mage_Core_Helper_Abstract {
        private $product;
        private $options;

        /**
         * @param  int $id
         * @return DeividNetwork_AjaxCart_Helper_Data
         */
        public function init($id) {
            $this->setProduct($id)->setOptions();

            return $this;
        }

        /**
         * @param  int $id
         * @return DeividNetwork_AjaxCart_Helper_Data
         */
        public function setProduct($id) {
            $this->product = Mage::getModel('catalog/product')->load($id);

            return $this;
        }

        /**
         * @return Mage_Catalog_Model_Product
         */
        public function getProduct() {
            return $this->product;
        }

        /**
         * @return DeividNetwork_AjaxCart_Helper_Data
         */
        public function setOptions() {
            $this->options = $this->getProduct()->getOptions();

            return $this;
        }

        /*
         * @return Mage_Catalog_Model_Product_Option
         */
        public function getOptions() {
            return $this->options;
        }

        public function getOptionByName($nameOption) {
            $reply = false;

            foreach($this->getOptions() as $option) {
                if (strtolower($nameOption) == strtolower($option->getTitle())) {
                    $reply = $option;
                }
            }

            return $reply;
        }
    }