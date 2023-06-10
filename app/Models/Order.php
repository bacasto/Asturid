<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = ['user_id','total','state_id'];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function state(){
        return $this->belongsTo(OrderState::class,'state_id','id');
    }

}