@section('js')
<script type="text/javascript">
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showgambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#inputgambar").change(function () {
        readURL(this);
    });
</script>

@stop
@extends("layouts.app")

@section("content")
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Mahsiswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Mahasiswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
    @if($errors->any())
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

		<form action="{{ route('biodata.update', ['id'=> $data->id]) }}" method="POST" class="form-horizontal">

			@csrf

			<div class="form-group">
				<label class="control-label">Nama</label>
				<input type="text" name="name" class="form-control" value="{{ $data->name }}">
			</div>
			<div class="form-group">
				<label class="control-label">NIM</label>
				<input type="text" name="nim" class="form-control" value="{{ $data->nim }}">
			</div>
			<div class="form-group">
				<label class="control-label">Alamat</label>
				<textarea name="address" rows="10" class="form-control">{{ $data->address }}</textarea> 
			</div>
			<div class="form-group">
				<img src="http://placehold.it/100x100" id="showgambar" style="max-width:200px;max-height:200px;float:left;" />{{ $data->photo }}
			</div><br><br><br><br><br>
			<div class="form-group">
			    <label for="photo">Upload Photo</label><br>
			    <input type="file" id="inputgambar" name="photo" value="{{ $data->photo }}">
			  </div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Simpan</button>
				<a href="{{ route('biodata.index')}}" class="btn btn-danger">Batal</a>
			</div>
		</form>
	</div>
</div>
</div>
</section>
@endsection