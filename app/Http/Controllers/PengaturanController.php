<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PengaturanController extends Controller
{
     public function index()
    {
        return view('pengaturan.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());

        $user->name = $request->name;

        // Ganti password jika diisi
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('pengaturan')->with('success', 'Profil berhasil diperbarui.');
    }

}
