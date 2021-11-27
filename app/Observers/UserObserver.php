<?php

namespace App\Observers;

use App\Models\Question;
use App\Models\StudentProfile;
use App\Models\User;
use App\Models\Worksheet;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    protected $key = 'user_id';
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $request = Request::all();
        $image = Request::file('image');
        if( $image ){
            $user->image = $image->store('images/users');
        }
    }

    public function deleting(User $user)
    {
        try {
            Question::where('created_by', $user->id)->delete();
            StudentProfile::where($this->key, $user->id)->delete();
            Worksheet::where($this->key, $user->id)->delete();
        } catch (\Exception $exception) {
            $message = 'Gagal Menghapus "' . $user->name;
        }
    }

    public function deleted(User $user)
    {
        try {
            if( $user->image != 'images/users/user.jpg' ){
                Storage::delete( $user->image );
            }
        } catch (\Exception $exception) {
            $message = 'Gagal Menghapus Foto "' . $user->name;
        }
    }
}
