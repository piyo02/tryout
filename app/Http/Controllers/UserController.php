<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id', 3)->latest()->paginate(10);
        return view('pages.management.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.management.user.form', [
            'action' => '/management/user',
            'header' => 'Manajemen User - Form Tambah',
            'edit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'role_id' => 'required',
            'email' => 'required|unique:users',
        ]);
        try {
            $image = $request->file('image');
            if( $image ){
                $validatedData['image'] = $image->store('images/users');
            }
            
            $password = substr( $request->email, 0, strpos( $request->email, "@" ) );
            $validatedData['password'] = \bcrypt( $password );
            
            User::create($validatedData);
            $status = 'success';
            $message = 'Berhasil Menambahkan User';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Menambahkan User';
        }
        return redirect('/management/user')->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('pages.management.user.detail', [
            'header' => 'Detail User',
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.management.user.form', [
            'action' => '/management/user/' . $user->id,
            'header' => 'Manajemen User - Form Edit',
            'edit' => true,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        try {
            $image = $request->file('image');
            if( $image ){
                $validatedData['image'] = $image->store('images/users');
            }
            
            User::where('id', $user->id)->update($validatedData);
            $status = 'success';
            $message = 'Berhasil Mengubah Data User';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Mengubah Data User';
        }
        return redirect('/management/user')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/management/user')->with('success', 'Berhasil Menghapus Data');
    }
}
