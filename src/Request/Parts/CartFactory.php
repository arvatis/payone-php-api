<?php


namespace ArvPayoneApi\Request\Parts;


class CartFactory
{
    /**
     * @return Cart
     */
    static public function create(array $requestData)
    {
        $cart = new Cart();
        foreach ($requestData['basketItems'] as $i => $cartItemData) {
            $cartItem = new CartItem(
                $i,
                $cartItemData['itemId'],
                CartItem::TYPE_GOODS,
                $cartItemData['quantity'] ?? '',
                $cartItemData['price'],
                $cartItemData['vat'],
                $cartItemData['name'] ?? ''
            );
            $cart->add($cartItem);
        }
        $cart->add(self::calculateShipping($requestData, $cart));
        return $cart;
    }

    /**
     * @param array $requestData
     * @param $cart
     * @return CartItem
     */
    private static function calculateShipping(array $requestData, Cart $cart)
    {
        $taxRate = 0;
        $basket = $requestData['basket'];
        if ($basket['shippingAmountNet'] > 0) {
            $taxRate = (int )round(
                ($basket['shippingAmount'] / $basket['shippingAmountNet'] - 1)
                * 10000
            );
        }
        $shippingCost = new CartItem(
            count($cart->getCartItems()),
            'shipping',
            CartItem::TYPE_SHIPMENt,
            1,
            $basket['shippingAmount'],
            $taxRate,
            'shipping'
        );
        return $shippingCost;
    }
}