<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MainController extends Controller
{
    public function login_form() {
        return view('login');
    }

    public function register_form() {
        return view('register');
    }

    public function admin_dashboard() {
        $user = User::all();

        $title = 'Hapus User!';
        $text = "Apakah anda yakin menghapus data user ini?";
        confirmDelete($title, $text);

        return view('admin.dashboard', compact('user'));
    }

    public function user_dashboard() {
        return view('user.dashboard');
    }

    public function post_login(Request $request) {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:15',
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            toast('Selamat datang di dashboard admin!', 'success');
            return redirect('/admin-dashboard');
        } elseif(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            toast('Selamat datang di dashboard user!', 'success');
            return redirect('/user-dashboard');
        } else {
            toast('Pastikan email atau password sudah benar', 'error');
            return back();
        }
    }

    public function post_register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'username' => 'required',
            'password' => 'required|min:8|max:15',
        ]);

        $user = new User;

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        if($user) {
            Alert::success('Success!', 'Akun berhasil dibuat, silahkan login');
            return redirect('/login');
        } else {
            toast('Gagal buat akun baru, coba lagi!', 'error');
            return back();            
        }
    }

    public function admin_logout() {
        Alert::success('Berhasil!', 'Anda telah berhasil logout!');
        Auth::guard('admin')->logout();
        return redirect('/login');
    }

    public function user_logout() {
        Alert::success('Berhasil!', 'Anda telah berhasil logout!');
        Auth::logout();
        return redirect('/login');
    }
}
