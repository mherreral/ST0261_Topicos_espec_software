<?php

//Authors: Manuela Herrera López

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['created_at'] - date - contains the comment creation date
     * $this->attributes['updated_at'] - date - contains the comment updated date
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['subtotal'] - float - contains the item subtotal (quantity*price)
     * $this->attributes['quantity'] - int - contains liquor quantity
     * $this->attributes['liquor_id'] - liquor - contains the related liquor id
     * $this->attributes['liquor'] - liquor - contains the related liquor
     * $this->attributes['wishlist'] - int - contains the related wishlist
     * $this->attributes['wishlist_id'] - int - contains the related wishlist id
     */
    protected $fillable = [
        'quantity',
    ];

    public static function validate($request)
    {
        $request->validate(
            [
            "quantity" => "required|numeric|gt:0",
            ]
        );
    }

    public static function getItemSubtotal($price, $quantity)
    {
        $subtotal = $price * $quantity;
        return $subtotal;
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getSubtotal()
    {
        return $this->attributes['subtotal'];
    }

    public function setSubtotal($subtotal)
    {
        $this->attributes['subtotal'] = $subtotal;
    }

    public function getQuantity()
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity($quantity)
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function liquor()
    {
        return $this->belongsTo(Liquor::class);
    }


    public function getLiquorId()
    {
        return $this->attributes['liquor_id'];
    }

    public function setLiquorId($liquorId)
    {
        $this->attributes['liquor_id'] = $liquorId;
    }

    public function setLiquor($liquor)
    {
        $this->liquor = $liquor;
    }

    public function getLiquor()
    {
        return $this->liquor;
    }

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }

    public function setWishlist($wishlist)
    {
        $this->wishlist = $wishlist;
    }

    public function getWishlist()
    {
        return $this->wishlist;
    }

    public function getWishlistId()
    {
        return $this->attributes['wishlist_id'];
    }

    public function setWishlistId($wishlistId)
    {
        $this->attributes['wishlist_id'] = $wishlistId;
    }

    public function getUpdatedDate()
    {
        return $this->attributes['updated_at'];
    }
    public function SetUpdatedDate($updated_at)
    {
        $this->attributes['updated_at'] = $updated_at;
    }
    public function getCreatedDate()
    {
        return $this->attributes['created_at'];
    }
    public function SetCreatedDate($created_at)
    {
        $this->attributes['created_at'] = $created_at;
    }
}
