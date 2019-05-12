<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    protected $table = 'TheLoai';
    //? với 1 thể loại hãy lấy ra nhiều loại tin ===> liên kết
    public function loaitin(){
    	return $this->hasMany('App\LoaiTin','idTheLoai','id');
    }
}
