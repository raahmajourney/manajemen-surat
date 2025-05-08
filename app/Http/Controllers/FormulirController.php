<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\UnitKerja;

class FormulirController extends Controller
{
    public function index(){


    

        return view('formulir.index', [
            'title' => 'Template Formulir',
            'menuformulir' => 'active',
            'collapseFormulir' => 'show',
            'templateformulir' => 'active', // Buat ini juga agar submenu aktif
            'unitKerjas' => UnitKerja::all()
        ]);


    }
}
