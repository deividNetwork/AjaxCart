<?php
    foreach($_product->getOptions() as $option) {
        var_dump($option->getId());
    }

    // Get customer session
    $session = Mage::getSingleton('customer/session');

    // Get cart instance
    $cart = Mage::getSingleton('checkout/cart');
    $cart->init();

    // Add a product (simple); id:12,  qty: 3
    //    $cart->addProduct(2, 5);

    // Add a product with custom options
    $productInstance = $_product;

    $param = array(
        'product' => $productInstance->getId(),
        'qty' => 5,
        'options' => array(
            1 => array(
                '1',
                '2'
            )
        )
    );
    $request = new Varien_Object();
    $request->setData($param);
    $cart->addProduct($productInstance, $request);

    var_dump($request);

    // Set shipping method
    $quote = $cart->getQuote();
    $shippingAddress = $quote->getShippingAddress();
    $shippingAddress->setShippingMethod('flatrate_flatrate')->save();

    // update session
    $session->setCartWasUpdated(true);

    //save the cart
    $cart->save();

    //    try {
    //        $result = $this->getQuote()->addProduct($product, $request);
    //    } catch (Mage_Core_Exception $e) {
    //        $this->getCheckoutSession()->setUseNotice(false);
    //        $result = $e->getMessage();
    //    }
?>