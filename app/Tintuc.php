<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Loaitin;

class Tintuc extends Model
{
    protected $table = 'Tintuc';

    public function loaitin()
    {
    	return $this->belongsTo('App\Loaitin','idLoaiTin','id');

    }
}
