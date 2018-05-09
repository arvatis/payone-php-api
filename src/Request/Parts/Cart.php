<?php


namespace ArvPayoneApi\Request\Parts;


class Cart implements \JsonSerializable
{
    /** @var CartItem[] */
    private $cartItems = [];

    /**
     * Getter for CartItems
     * @return CartItem[]
     */
    public function getCartItems()
    {
        return $this->cartItems;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $cartItems = $this->getCartItems();
        if (!$cartItems) {
            return [];
        }
        $itemsArray = array_map(
            function (CartItem $cartItem) {
                return $cartItem->jsonSerialize();
            },
            $cartItems
        );
        return call_user_func_array('array_merge', $itemsArray);
    }

    /**
     * @param CartItem $cartItem
     */
    public function add(CartItem $cartItem)
    {
        $this->cartItems[] = $cartItem;
    }
}