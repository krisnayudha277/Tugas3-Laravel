@extends("layouts.app")
@section("content")
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Detail Mahsiswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Detail Mahasiswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
		<ul>
			<li>Id Mahasiswa : {{  $data->id }}</li>
			<li>Nama : {{  $data->name }}</li>
			<li>NIM : {{  $data->nim }}</li>
			<li>ALamat : {{  $data->address }}</li>
			<li>File Path : {{ $data->filePath}}</li>
			 <li><img src="{{ asset('photo_mhs/'.$data->photo) }}" id="showgambar" style="max-width:200px;max-height:200px;" /> </li>
		</ul>

		<button type="button" class="btn btn-success"><a href="{{ route('biodata.index') }}">Kembali</a></button>
	</div>
</div>
</div>
</section>
@endsection