<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;



class MataPelajaranController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    if (auth()->user()->status == 'G' or auth()->user()->status == 'A') {
      return view('mapel.index');
    } else {
      return redirect()->route('home.index');
    }
  }


  public function dataMapel()
  {
    $mapel = MataPelajaran::all();
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
