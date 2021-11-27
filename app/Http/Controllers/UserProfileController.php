<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function show(User $profile)
    {
        return view('pages.profile.detail', [
            'user' => $profile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $profile)
    {
        return view('pages.profile.form', [
            'action' => '/profile/' . $profile->id,
            'header' => 'Edit Profil',
            'edit' => true,
            'user' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        try {
            $image = $request->file('image');
            if( $image ){
                $validatedData['image'] = $image->store('images/users');
            }
            if( $request->old_pass ){
                $check = Hash::check($request->old_pass, $profile->password);
                if( $check && $request->password && $request->password == $request->confirm_pass ){
                    $validatedData['password'] = \bcrypt($request->password);
                }
                $request->session()->flush();
            }

            User::where('id', $profile->id)->update($validatedData);
            $status = 'success';
            $message = 'Berhasil Mengubah Profil Anda';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Mengubah Profil Anda';
        }
        return redirect('/profile/' . $profile->id)->with($status, $message);
    }
}
