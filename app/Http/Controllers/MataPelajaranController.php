<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
class MataPelajaranController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    if (Auth::user()->status == 'G' or Auth::user()->status == 'A') {
      return view('mapel.index', compact('user', 'gurus'));
    } else {
      return redirect()->route('home.index');
    }
  }
  public function dataMapel()
  {
    $mapel = MataPelajaran::all()->get();
    if (Auth::user()->status == 'G') {
      return Datatables::of($mapel)
        ->addColumn('empty_str', function ($mapel) {
          return '';
        })
        ->addColumn('action', function ($mapel) {
          return '<div style="text-align:center"><a href="kelas/detail/' . $mapel->id . '" class="btn btn-xs btn-success">Detail</a></div>';
        })
        ->rawColumns(['action'])
        ->make(true);
    } else {
      return Datatables::of($mapel)
        ->addColumn('empty_str', function ($mapel) {
          return '';
        })
        ->addColumn('action', function ($mapel) {
          return '<div style="text-align:center">
                            <a href="mapel/ubah/' . $mapel->id . '" class="btn btn-xs btn-primary">Ubah</a>
                            <button type="button" class="btn btn-xs btn-danger del-kelas" id=' . $mapel->id . '>Hapus</button>
                            <a href="mapel/detail/' . $mapel->id . '" class="btn btn-xs btn-success">Detail</a>
                          </div>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }
}
