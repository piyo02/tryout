<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentProfile;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::where('role_id', 4)->latest()->paginate(10);
        return view('pages.management.student.index', [
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.management.student.form', [
            'action' => '/management/student',
            'header' => 'Manajemen Siswa - Form Tambah',
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
            
            $user_id = User::create($validatedData)->id;
            
            if( $user_id ){
                $validatedDataProfile = $request->validate([
                    'phone' => 'required',
                    'address' => 'required',
                    'birthday' => 'required',
                ]);
                $validatedDataProfile['user_id'] = $user_id;
                StudentProfile::create($validatedDataProfile);
            }
            $status = 'success';
            $message = 'Berhasil Menambahkan Siswa';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Menambahkan Siswa';
        }
        return redirect('/management/student')->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {
        return view('pages.management.student.detail', [
            'header' => 'Detail Siswa',
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        return view('pages.management.student.form', [
            'header' => 'Manajemen Siswa - Form Edit',
            'action' => '/management/student/' . $student->id,
            'edit' => true,
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        try {
            $image = $request->file('image');
            if( $image ){
                $validatedData['image'] = $image->store('images/users');
            }
            User::where('id', $student->id)->update($validatedData);
            
            $validatedDataProfile = $request->validate([
                'phone' => 'required',
                'address' => 'required',
                'birthday' => 'required',
            ]);
            StudentProfile::where('id', $student->student_profile[0]->id)->update($validatedDataProfile);

            $status = 'success';
            $message = 'Berhasil Mengubah Data Siswa';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Mengubah Data Siswa';
        }
        return redirect('/management/student')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        User::destroy($student->id);
        return redirect('/management/student')->with('success', 'Berhasil Menghapus Data');
    }
}
