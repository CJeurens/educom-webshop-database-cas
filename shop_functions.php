<?php

function consolidateCartData($cart_product)
{
    $products = getCartProductData($cart_product["product_id"]);
    $product = $products[$cart_product["product_id"]];
    $product["units"] = $cart_product["units"];
    $product["subtotal"] = $product["units"]*$product["unitprice"];

    return $product;
}

function disableOrderButton()
{
    $user_cart = getUserCartData();
    $cart = $user_cart["cart"];
    if (empty($cart))
    {
        return print " disabled";
    }
}

function calculateTotalUnits()
{
    $units_total = "0";
    $user_cart = getUserCartData();
    if (isset($user_cart))
    {
        $cart = $user_cart["cart"];
        
        foreach($cart as $cart_product)
        {
            $units_total += $cart_product["units"];
        }
    }
    return $units_total;
}

?>