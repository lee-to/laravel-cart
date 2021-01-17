# laravel-cart

## Install
- composer require lee-to/laravel-cart

- php artisan vendor:publish --provider="Leeto\Cart\Providers\CartServiceProvider"

- set models and tables in config cart.php

### Usage

##### Get cart items

```php
Cart::get();
```

##### Get all user carts

```php
Cart::userCarts(optional USER_ID);
```

##### Add to cart

```php
Cart::add(PRODUCT_ID, optional [VARIANT_ID_1, VARIANT_ID_2]);
```

##### Change quantity

```php
Cart::quantity(CART_ITEM_ID, NEW_COUNT);
```
##### Total cart price

```php
Cart::total();
```

##### Remove

```php
Cart::remove(CART_ITEM_ID);
```

##### Clear all

```php
Cart::flush();
```
