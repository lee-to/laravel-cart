<?php

namespace Leeto\Cart\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * @package Leeto\Cart\Models
 */
class Cart extends Model
{
    /**
     * @var array
     */
    protected $fillable = ["session_id", "user_id", "product_id", "price", "quantity"];

    public static function userCarts($id = null) {
        $user_id = $id ? $id : (auth(config("cart.guard"))->check() ? auth(config("cart.guard"))->id() : null);

        if(is_null($user_id)) {
            return false;
        }

        return self::where(["user_id" => $user_id])->get();
    }

    /**
     * @return mixed
     */
    public static function get() {
        return self::where(["session_id" => session()->getId()])->get();
    }

    /**
     * @param $product_id
     * @param array $vars
     * @return mixed
     */
    public static function add($product_id, $vars = []) {
        $product = config("cart.product_model")::findOrFail($product_id);

        if($cart = self::where(["session_id" => session()->getId(), "product_id" => $product->id])->first()) {
            $cart->quantity++;
            $cart->save();
        } else {
            $cart = self::create([
                "session_id" => session()->getId(),
                "product_id" => $product->id,
                "user_id" => auth(config("cart.guard"))->check() ? auth(config("cart.guard"))->id() : null,
                "quantity" => 1,
                "price" => $product->price,
            ]);
        }

        if(!empty($vars) && isset($cart->id)) {
            $cart->vars()->sync($vars);
        }

        return $cart;
    }

    /**
     * @param $id
     * @param $quantity
     * @return int
     */
    public static function quantity($id, $quantity) {
        if($quantity <= 0) {
            return self::remove($id);
        }

        $cart = self::findOrFail($id);

        $cart->quantity = $quantity;
        $cart->save();

        return $cart;
    }

    /**
     * @param $id
     * @return int
     */
    public static function remove($id) {
        return self::destroy($id);
    }

    /**
     * @return mixed
     */
    public static function flush() {
        return self::where(["session_id" => session()->getId()])->delete();
    }

    /**
     * @return mixed
     */
    public static function total() {
        return self::where(["session_id" => session()->getId()])->get()->map(function ($item) {
            return $item->price * $item->quantity;
        })->sum();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(config("cart.user_model"));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() {
        return $this->belongsTo(config("cart.product_model"));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function vars() {
        return $this->belongsToMany(config("cart.product_variant_model"), "cart_vars", "cart_id", "variant_id");
    }
}
