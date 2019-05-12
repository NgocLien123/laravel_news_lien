<?php

namespace App\Http\Controllers;
use App\LoaiTin;
use App\Theloai;
use Illuminate\Http\Request;

class LoaiTinController extends Controller
{
   public function getDanhSach(){
   	// hàm chạy ===> lấy tất cả danh sách Thể Loại đưa qua cho View admin.loaitin.danhsach
   		$data = LoaiTin::all(); // lấy taonf bộ danh sách từ model
   		return view('admin.loaitin.danhsach',['dsLoaiTin' =>$data]);
   }
   public function getThem(){
   		$dsTheLoai = Theloai::all();
   		return view('admin.loaitin.them',['dsTheLoai' => $dsTheLoai]);

   }
   public function postthem(Request $req){
   	 // xử lí kiểm tra tính hợp lệ ===> dùng validation
   	$this->validate($req,
   		[
   			'Ten' => 'required|min:3|max:50|unique:LoaiTin,Ten',
   			'TheLoai'=> 'required'
   		],
   		[
   			'Ten.required' => 'Tên này không được để trống',
   			'Ten.min'	   => 'Độ dài phải lớn hơn 3',
   			'Ten.max'      => 'độ dài phải nhở hơn 50',
            'Ten.unique' =>'Loại tin này đã tồn tại!',
            'TheLoai.required'=> ' Thể loại không được để trống'
   		]);

   	// tạo model loại tin
   		$loaitin = new loaiTin();
   		$loaitin->Ten = $req->Ten;
   		$loaitin->TenKhongDau = changeTitle($req->Ten);
   		$loaitin->idTheLoai =  $req->Theloai;
   		// $loaitin->created_at = new DateTime();
   	// lưu vào trong CSDL
   		$loaitin->save();

   		// sau khi thêm dữ liệu mới vào chuyển hướng tới view thêm
   	 return	redirect('admin/loaitin/them')->with('thongbao','Đã thêm thành công');

   }

   public function getSua($id){
      // yêu cầu Model lấy thể loại ra
      $loaitin = LoaiTin::find($id);
      $dsTheLoai = Theloai::all();
      return view('admin.loaitin.sua',['loaitin' => $loaitin,'dsTheLoai' => $dsTheLoai]);
   }
   public function postSua(Request $req,$id){
       $loaitin = LoaiTin::find($id);
       //validate dữ liệu trong Request
       $this->validate($req,
         [
            'Ten' => 'required|min:3|max:50'
         ],
         [
            'required' => 'Trường này không được để trống',
            'min'    => 'Độ dài phải lớn hơn 3',
            'max'      => 'độ dài phải nhở hơn 50',
            'unique' =>'Loại tin này đã tồn tại!'
         ]);
       $loaitin->Ten = $req->Ten;
       $loaitin->TenKhongDau = changeTitle($req->Ten,'-',MB_CASE_TITLE);
       $loaitin->idTheLoai = $req->TheLoai;
       $loaitin->save();
       return redirect('admin/loaitin/sua/'.$id)->with('thongbao', 'đã sửa thể loại thành công');
   }

   public function getXoa($id){
      $loaitin = LoaiTin::find($id);
      $ten = $loaitin->Ten;
      $loaitin->delete();
      return redirect('admin/loaitin/danhsach')->with('thongbao','bạn đã xóa thành công thể loại '.$ten);
   }

}
