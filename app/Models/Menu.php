<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = "menus";
    protected $fillable = ['name','price','image','entrante_id','primerplato_id','segundoplato_id','postre_id','bebida_id'];
    public function entrante(){
        return $this->belongsTo(Product::class,'entrante_id','id');
    }
    public function primerplato(){
        return $this->belongsTo(Product::class,'primerplato_id','id');
    }
    public function segundoplato(){
        return $this->belongsTo(Product::class,'segundoplato_id','id');
    }
    public function postre(){
        return $this->belongsTo(Product::class,'postre_id','id');
    }
    public function bebida(){
        return $this->belongsTo(Product::class,'bebida_id','id');
    }
}