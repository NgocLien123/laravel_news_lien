<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Bình luận
			<small>danh sách</small>
		</h1>
	</div>

	@if(session('thong bao'))
	<div class="alert alert-success">
		{{session('thongbao')}}
	</div>
	@endif
	<table class="table table-striped table-bordered table-hover" id="dataTables-example">
		<thead>
			<tr align="center">
				<th>ID</th>
				<th>Người dùng</th>
				<th>Nội dung</th>
				<th>Ngày đăng</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tintuc->comment as $cm)
				<tr class="odd gradeX" align="center">
					<td>{{$cm->id}}</td>
					<td>
					{{$cm->user->name}}
					</td>
					<td>{{$cm->NoiDung}}</td>
					<td>{{$cm->created_at}} </td>
					<td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}">Delete</a></td>
					
				</tr>
			@endforeach
		</tbody>
	</table>	
	
</div>