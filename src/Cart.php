<?php

namespace Leeto\Cart;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Leeto\Cart\CartManager
 */
class Cart extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'cart';
    }
}
