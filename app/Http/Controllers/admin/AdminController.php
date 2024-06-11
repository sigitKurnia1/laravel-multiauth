<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    public function create_form() {
        return view('admin.create');
    }

    public function update_form($id) {
        $user = User::findOrFail($id);

        return view('admin.update', compact('user'));
    }

    public function post_create(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'username' => 'required',
            'password' => 'required|min:8|max:15',
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);

        $user->save();

        if($user) {
            toast('User baru berhasil ditambah!', 'success');
            return redirect('/admin-dashboard');
        } else {
            toast('Gagal buat user baru, coba lagi!', 'error');
            return back();            
        }
    }

    public function post_update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'username' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = $request->password;

        $user->save();

        if($user) {
            toast('Data user berhasil diupdate!', 'success');
            return redirect('/admin-dashboard');
        } else {
            toast('Gagal update data user, coba lagi!', 'error');
            return back();            
        }
    }

    public function delete($id) {
        $user = User::findOrFail($id);

        $user->delete();

        if ($user) {
            toast('User berhasil dihapus!', 'success');
            return redirect('/admin-dashboard');
        } else {
            toast('Gagal hapus data user, coba lagi!', 'error');
            return back();   
        }
    }

    public function search_user(Request $request) {
        $query = $request->search;

        $user = User::where('name', 'LIKE', "%$query%")
                    ->orWhere('email', 'LIKE', "%$query%")
                    ->orWhere('username', 'LIKE', "%$query%")
                    ->get();

        return view('admin.dashboard', compact('user'));
    }
}
