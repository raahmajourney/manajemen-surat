<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnitKerja;

class UserController extends Controller
{   
    public function user()
    {

        $data = array(
            "title" => "Pengguna",
            "menuunitkerja" => "active",

        );

        return view('pengguna.index', $data);
    }

    public function index()
    {
        $users = User::with('roles')->paginate(10);
        $unitKerjas = UnitKerja::all(); // ✅ Tambahkan ini

        return view('user.index', compact('users', 'unitKerjas')); // ✅ Sertakan ke view
    }


public function create()
{
    $unitKerjas = UnitKerja::all();
    return view('user.create', compact('unitKerjas'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'unit_kerja_id' => 'required|exists:unit_kerja,id',
        'role' => 'required|in:admin,dosen,staf',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'unit_kerja_id' => $request->unit_kerja_id,
    ]);

    $user->assignRole($request->role);

    return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
}
    
}
