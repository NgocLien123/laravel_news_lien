@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại Tin -
                    <small>thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors)>0)
                    <div class = "alert alert-danger">
                    @foreach($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
                @endif

                @if(session('thongbao'))
                    <div class = "alert alert-success">
                        {{session('thongbao')}}
                        
                    </div>
                        
                @endif


                <form action="admin/loaitin/postthem" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <div class="form-group">
                            <label>Chọn thể loại</label>
                            <select class="form-control" name="TheLoai">
                                @foreach($dsTheLoai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label>Tên loại tin</label>
                        <input class="form-control" name="Ten" placeholder="Hãy nhập tên loại tin" />
                    </div>
                    
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection