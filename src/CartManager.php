<?php

namespace Leeto\Cart;

use Leeto\Cart\Models\Cart as CartModel;

/**
 * Class CartManager
 * @package Leeto\Cart
 */
class CartManager
{
    /**
     * @return mixed
     */
    public function get() {
        return CartModel::get();
    }

    /**
     * @param $product_id
     * @param array $vars
     * @return mixed
     */
    public function add($product_id, $vars = []) {
        return CartModel::add($product_id, $vars);
    }

    /**
     * @param $cart_id
     * @param $quantity
     * @return int
     */
    public function quantity($cart_id, $quantity) {
        return CartModel::quantity($cart_id, $quantity);
    }

    /**
     * @param $cart_id
     * @return int
     */
    public function remove($cart_id) {
        return CartModel::remove($cart_id);
    }

    /**
     * @return boolean
     */
    public function flush() {
        return CartModel::flush();
    }

    /**
     * @return numeric
     */
    public function total() {
        return CartModel::total();
    }

    /**
     * @return integer
     */
    public function count() {
        return CartModel::count();
    }

    /**
     * @param null $id
     * @return array
     */
    public function userCarts($id = null) {
        $carts = [];

        $rows = CartModel::userCarts($id);

        if($rows !== false && !empty($rows)) {
            foreach ($rows as $row) {
                $carts[$row->session_id][] = $row;
            }
        }

        return $carts;
    }
}
