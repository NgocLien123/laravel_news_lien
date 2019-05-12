<?php

namespace App\Http\Controllers;
use App\TheLoai;
use Illuminate\Http\Request;

class TheLoaiController extends Controller
{
   public function getDanhSach(){
   	// hàm chạy ===> lấy tất cả danh sách Thể Loại đưa qua cho View admin.theloai.danhsach
   		$data = TheLoai::all(); // lấy taonf bộ danh sách từ model
   		return view('admin.theloai.danhsach',['dsTheLoai' =>$data]);
   }
   public function getThem(){
   		return view('admin.theloai.them');

   }
   public function postthem(Request $req){
   	 // xử lí kiểm tra tính hợp lệ ===> dùng validation
   	$this->validate($req,
   		[
   			'Ten' => 'required|min:3|max:50|unique:TheLoai'
   		],
   		[
   			'required' => 'Trường này không được để trống',
   			'min'	   => 'Độ dài phải lớn hơn 3',
   			'max'      => 'độ dài phải nhở hơn 50',
            'unique' =>'Thể loại này đã tồn tại!'
   		]);

   	// tạo model thể loại
   		$theloai = new Theloai();
   		$theloai->Ten = $req->Ten;
   		$theloai->TenKhongDau = changeTitle($req->Ten);
   		// $theloai->created_at = new DateTime();
   	// lưu vào trong CSDL
   		$theloai->save();

   		// sau khi thêm dữ liệu mới vào chuyển hướng tới view thêm
   	 return	redirect('admin/theloai/them')->with('thongbao','Đã thêm thành công');

   }

   public function getSua($id){
      // yêu cầu Model lấy thể loại ra
      $theloai = TheLoai::find($id);
      return view('admin.theloai.sua',['theloai' => $theloai]);
   }
   public function postSua(Request $req,$id){
       $theloai = TheLoai::find($id);
       //validate dữ liệu trong Request
       $this->validate($req,
         [
            'Ten' => 'required|min:3|max:50|unique:TheLoai'
         ],
         [
            'required' => 'Trường này không được để trống',
            'min'    => 'Độ dài phải lớn hơn 3',
            'max'      => 'độ dài phải nhở hơn 50',
            'unique' =>'Thể loại này đã tồn tại!'
         ]);
       $theloai->Ten = $req->Ten;
       $theloai->TenKhongDau = changeTitle($req->Ten,'-',MB_CASE_TITLE);
       $theloai->save();
       return redirect('admin/theloai/sua/'.$id)->with('thongbao', 'đã sửa thể loại thành công');
   }

   public function getXoa($id){
      $theloai = TheLoai::find($id);
      $ten = $theloai->Ten;
      $theloai->delete();
      return redirect('admin/theloai/danhsach')->with('thongbao','bạn đã xóa thành công thể loại '.$ten);
   }

}
