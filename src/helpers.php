<?php

namespace Leeto\Cart;

if (!function_exists('cart')) {
    /**
     * Get the cart instance.
     *
     * @return \Leeto\Cart\CartManager
     */
    function cart()
    {
        return app("cart");
    }
}