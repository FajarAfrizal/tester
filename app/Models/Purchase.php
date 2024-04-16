<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases';
    protected $guarded =['id'];

    public function products(){
        return $this->belongsToMany(Product::class, 'purchase_products')->withPivot('*');
    }
    public function customers(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
