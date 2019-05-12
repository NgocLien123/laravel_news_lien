<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TestModel; 
use App\TheLoai;

Route::get('/', function () {
    return view('welcome');
});
Route::get('QueryBuilder',function(){
	$ten = DB::table('Test')->where('id',1)->value('name');
	 echo $ten;
});
Route::get('TestModel', function(){
	$kq = TestModel::find(1)->Name;
	echo $kq;
});

Route::get('test_get_loai_tin_from_the_loai/{n}', function($n){
	// in ra tên của tất cả các loại tin thuộc thể loại xã hội (id=1)
	// lấy thể loại có id =1
	$tl = TheLoai::find($n);
	echo "tên thể loại :". $tl->Ten."<br/><br/>";
	// lấy danh sách tin tức của thể loại trên
	$lt = $tl->loaitin;
	// var_dump($lt);
	// lấy từng loại tin trong danh sách trên
	foreach ($lt as $value) {
		echo $value->Ten."<br/>";	
	}
});


// test hiển thị trang admin
Route::get('test_admin',function(){
	return view('admin.theloai.danhsach');
});
 // tạo group route để truy cập trang admin
Route::group(['prefix' => 'admin'], function(){
	Route::group(['prefix' => 'theloai'], function(){
		Route::get('danhsach', 'TheLoaiController@getDanhSach');
		Route::get('sua/{id}', 'TheLoaiController@getSua');
		Route::post('sua/{id}', 'TheLoaiController@postSua');
		Route::get('them', 'TheLoaiController@getThem');
		Route::post('postthem', 'TheLoaiController@postThem');
		Route::get('xoa/{id}','TheLoaiController@getXoa');
	});

	Route::group(['prefix' => 'loaitin'], function(){
		Route::get('danhsach', 'LoaiTinController@getDanhSach');
		Route::get('sua/{id}', 'LoaiTinController@getSua');
		Route::post('sua/{id}', 'LoaiTinController@postSua');
		Route::get('them', 'LoaiTinController@getThem');
		Route::post('postthem', 'LoaiTinController@postThem');
		Route::get('xoa/{id}','LoaiTinController@getXoa');
	});
	Route::group(['prefix' => 'comment'], function(){
			
			Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa');
	});
	Route::group(['prefix'=>'slide'],function(){
			Route::get('danhsach','SlideController@getDanhsach');

			Route::get('sua/{id}','SlideController@getSua');
			Route::post('sua/{id}','SlideController@postSua');

			Route::get('them','SlideController@getThem');
			Route::post('them','SlideController@postThem');

			Route::get('xoa/{id}','SlideController@getXoa');


	});
	Route::group(['prefix'=>'user'],function(){
 		Route::get('danhsach','UserController@getDanhSach');

 		Route::get('sua/{id}','UserController@getSua');
 		Route::post('sua/{id}','UserController@postSua');

 		Route::get('them','UserController@getThem');
 		Route::post('postthem','UserController@postThem');

 		Route::get('xoa/{id}','UserController@getXoa');
 	});
 	Route::group(['prefix'=>'tintuc'],function(){
		//admin/theloai/sua...
		Route::get('danhsach','TinTucController@getDanhSach');

		Route::get('sua/{id}','TinTucController@getSua');
		Route::post('sua/{id}','TinTucController@postSua');

		Route::get('them','TinTucController@getThem');
		Route::post('postthem','TinTucController@postThem');

		Route::get('xoa/{id}','TinTucController@getXoa');
		
	});

	Route::group(['prefix' => 'ajax'],function(){
		Route::get('loaitin/{idTheLoai}','AjaxCler@getLoaiTin');
	});
	
});


	