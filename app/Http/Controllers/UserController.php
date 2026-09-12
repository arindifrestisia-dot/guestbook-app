<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 0) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses untuk halaman ini');
            return redirect()->route('dashboard');
        }

        $users = User::all();
        return view('after-login.users.index', compact('users'));
    }

    public function create()
    {
        if (Auth::user()->role == 0) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses untuk halaman ini');
            return redirect()->route('dashboard');
        }
        return view('after-login.users.create');
    }

    public function store(Request $request)
    {

        if (Auth::user()->role == 0) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses untuk halaman ini');
            return redirect()->route('dashboard');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|',
            'email' => 'required|string|email|max:255|',
            'password' => 'required|string|min:8',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|in:0,1',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->position = $request->position;
        $user->role = $request->role;

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $user->photo = $imageName;
        }

        if (User::where('username', $request->input('username'))->exists()) {
            Alert::error('Gagal!', 'Username sudah terdaftar.');
            return redirect()->back()->withInput()->with('username', $request->input('username'));
        }

        if (User::where('email', $request->input('email'))->exists()) {
            Alert::error('Gagal!', 'Email sudah terdaftar.');
            return redirect()->back()->withInput()->with('email', $request->input('email'));
        }

        if (strlen($request->input('password')) < 8) {
            Alert::error('Gagal!', 'Password terlalu pendek. Password harus minimal 8 karakter.');
            return redirect()->back()->withInput()->with('password', $request->input('password'));
        }

        $user->save();

        activity()
            ->performedOn($user)
            ->causedBy(Auth::user())
            ->log('Meambahkan User Baru');

        Alert::success('Sukses!', 'User baru berhasil ditambahkan');
        return redirect()->route('users.index');
    }

    public function detail($id)
    {

        if (Auth::user()->role == 0) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses untuk halaman ini');
            return redirect()->route('dashboard');
        }

        $user = User::find($id);


        $title = 'Hapus User!';
        $text = 'Apakah anda yakin ingin menghapus user ini?';
        confirmDelete($title, $text);

        return view('after-login.users.detail', compact('user'));
    }

    public function edit($id)
    {

        if (Auth::user()->role == 0) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses untuk halaman ini');
            return redirect()->route('dashboard');
        }

        $user = User::find($id);
        return view('after-login.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {

        if (Auth::user()->role == 0) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses untuk halaman ini');
            return redirect()->route('dashboard');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required|in:0,1',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->position = $request->position;
        $user->role = $request->role;

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $user->photo = $imageName;
        }

        $user->save();

        activity()
            ->performedOn($user)
            ->causedBy(Auth::user())
            ->log('Mengupdate User ' . $user->name);

        Alert::success('Sukses!', 'User berhasil diperbarui');

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {

        if (Auth::user()->role == 0) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses untuk halaman ini');
            return redirect()->route('dashboard');
        }

        $user = User::find($id);

        $user->delete();

        activity()
            ->performedOn($user)
            ->causedBy(Auth::user())
            ->log('Menghapus User ' . $user->name);

        Alert::success('Sukses!', 'User Berhasil Dihapus');

        return redirect()->route('users.index');
    }

    public function search(Request $request)
    {

        if (Auth::user()->role == 0) {
            Alert::error('Akses Ditolak', 'Anda tidak memiliki hak akses untuk halaman ini');
            return redirect()->route('dashboard');
        }

        $search = $request->get('search');
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('username', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('position', 'like', '%' . $search . '%')
            ->orWhere('photo', 'like', '%' . $search . '%')
            ->get();

        return view('after-login.users.index', compact('users'));
    }
}
