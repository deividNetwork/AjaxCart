<?php

    /**
     * @category DeividNetwork
     * @package DeividNetwork_AjaxCart
     * @author Deivid Network <deividnetwork@gmail.com>
     */
    class  DeividNetwork_AjaxCart_IndexController extends Mage_Core_Controller_Front_Action {
        public function indexAction() {
            echo 'Anithing here...';
        }

        public function addToCartAction() {
            $data = array(
                'sucess' => false,
                'message' => 'No Message'
            );

            try {
                // Get customer session
                $session = Mage::getSingleton('customer/session');

                // Get cart instance
                $cart = Mage::getSingleton('checkout/cart');
                $cart->init();

                // Add a product with custom options
                $productInstance = Mage::getModel('catalog/product')->load($this->getRequest()->getParam('product'));

                $param = array(
                    'product' => $productInstance->getId(),
                    'qty' => $this->getRequest()->getParam('qty'),
                    'options' => $this->getRequest()->getParam('options')
                );

                $request = new Varien_Object();
                $request->setData($param);
                $cart->addProduct($productInstance, $request);

                // Set shipping method
                $quote = $cart->getQuote();
                $shippingAddress = $quote->getShippingAddress();
                $shippingAddress->setShippingMethod('flatrate_flatrate')->save();

                // update session
                $session->setCartWasUpdated(true);

                //save the cart
                $cart->save();

                $data['sucess'] = true;
                $data['message'] = 'Produto adicionado com sucesso!';
            }
            catch (Mage_Core_Exception $e) {
                $data['sucess'] = false;
                $data['message'] = $e->getMessage();
            }

            $jsonData = json_encode($data);

            $this->getResponse()->setHeader('Content-type', 'application/json');
            $this->getResponse()->setBody($jsonData);
        }

        public function formAction() {
            $this->loadLayout();
            $this->renderLayout();

            Mage::helper('ajaxcart');
        }
    }