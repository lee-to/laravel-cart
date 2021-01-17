<?php

namespace Leeto\Cart\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CartVar
 * @package Leeto\Cart\Models
 */
class CartVar extends Model
{
    /**
     * @var array
     */
    protected $fillable = ["cart_id", "variant_id"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variant() {
        return $this->belongsTo(config("cart.product_variant_table"));
    }
}
