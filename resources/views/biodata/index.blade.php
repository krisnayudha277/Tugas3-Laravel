@extends("layouts.app")
@push("style")
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endpush
@section("content")
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Mahsiswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Kelola Mahasiswa</a></li>
              <li class="breadcrumb-item active">Daftar Mahasiswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    <section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
    <a href="{{route('biodata.create')}}">Add Data</a>
    <a href="/biodata-mahasiswa/export_excel" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
    {!!$html->table()!!}
</div>
</div>
</div>
</section>
@endsection
@push("script")
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    {!! $html->scripts() !!}
@endpush

