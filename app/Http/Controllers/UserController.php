<?php

namespace App\Http\Controllers;

use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id')->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$data = $request->validate([
        $data = $request->validate([
            'username'      => 'required',
            'email'      => 'required|unique:users',
            'password'      => 'required|min:6|confirmed',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        Alert::success('SUKSES', 'Data Berhasil dibuat', 'Type');
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        $data = $request->validate([
            'username' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
        ]);

        $user->update($data);

        Alert::success('Sukses', 'Data berhasil diupdate');

        return redirect('/user');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        Alert::success('Sukses', 'Data berhasil dihapus');
        return redirect('/user');
    }
}
