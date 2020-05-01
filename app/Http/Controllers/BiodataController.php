<?php

namespace App\Http\Controllers;
use App\BiodataMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateBiodata;
use App\Exports\MahasiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use DataTables;
use Yajra\DataTables\Html\Builder;
class BiodataController extends Controller
{
    //

    public function index(Builder $builder){
        if (request()->ajax()) {
            return DataTables::of(BiodataMahasiswa::query())->editColumn("nim", function ($data) {
                return "<strong><i>" . $data->nim . "</i></strong>";
            })->addColumn("action", function($data) {
                return "
                <a href='" . route("biodata.show", ["id" => $data->id]) . "' class='btn btn-success'>Detail</a>
                <a href='" . route("biodata.edit", ["id" => $data->id]) . "' class='btn btn-warning'>Edit</a>
                <a href='" . route("biodata.destroy", ["id" => $data->id]) . "' class='btn btn-danger'>Delete</a>
                ";
            })->rawColumns(["nim", "action"])->addIndexColumn()->toJson();
        }

        $html = $builder->columns([
            ["data" => "DT_RowIndex", "id" => "id", "title" => "id", "defaultContent" => "", "orderable" => false],
            ["data" => "name", "name" => "name", "title" => "NAMA"],
            ["data" => "nim", "name" => "nim", "title" => "NIM"],
            ['defaultContent' => '',
             'data'           => 'action',
             'name'           => 'action',
             'title'          => 'ACTION',
             'render'         => null,
             'orderable'      => false,
             'searchable'     => false,
             'exportable'     => false,
             'printable'      => true,
            ],
        ]);
    	// $mahasiswa = BiodataMahasiswa::all();
        // dd(BiodataMahasiswa::)
    	return view("biodata.index", compact("html"));
    }
    public function create(){
        return view("biodata.create");
    }
    public function store(Request $request){
    	// dd($request->file());
        $filePath = $request->file("photo")->store("photo_mhs");
        $photo_mhs = 'products-' .date('Ymdhis').'.'.$request->photo->getClientOriginalExtension();
        $request->photo->move('photo_mhs', $photo_mhs);


        $mahasiswa = new BiodataMahasiswa;
        $mahasiswa->name = $request->name;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->address = $request->address;

        $mahasiswa->photo = $photo_mhs;
        $mahasiswa->filePath = $filePath;


        $mahasiswa->save();

        // $filePath = $request->file("photo")->store("photo_mhs");
        // return $filePath;
        return redirect()->route("biodata.index");
    }

    public function edit($id){
    	$data = BiodataMahasiswa::find($id);
        return view("biodata.edit", compact("data"));
    }

    public function update(UpdateBiodata $request, $id) {
        // $validation = Validator::make($request->all(), [
        //     "name" => "string|min:3|max:10|alpha",
        //     "nim" => "string|min:8",
        //     "alamat" => "string|min:10",
        // ]);

        // if ($validation->fails()) {
        //     return redirect()->back()->withErrors($validation)->withInput();
        // }

        BiodataMahasiswa::where("id", $id)->update($request->except("_token", "_method"));
        return redirect()->route("biodata.index");
    }

    public function destroy($id){
        $data = BiodataMahasiswa::where("id", $id)->delete();
        return redirect()->route("biodata.index");
        
    }

    public function show($id){
        // where("id", $id)->first();
        $data = BiodataMahasiswa::find($id);
        // dd($data->)
        return view("biodata.show", compact("data"));
        // return response()->json($data); dalam bentuk json
    }

    public function export_excel()
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }
}
