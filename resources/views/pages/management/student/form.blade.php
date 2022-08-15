@extends('layout.main')

@section('content')
<div class="panel-header bg-warning-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">{{ $header }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">
        <div class="col-12">
            <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                @csrf
                @if ($edit)
                    @method('put')
                @endif
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <a class="btn btn-danger btn-sm ml-auto text-white" href="/management/student">
                                Batal
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (!$edit)
                        <div class="card-sub text-info">									
                            Password user adalah kata pada email user sebelum @ (contoh: user@gmail.com, passwordnya adalah user)
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Nama Siswa</label>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Nama Siswa" value="{{ isset($student) ? $student->name : '' }}" required>
                                    <input id="role_id" name="role_id" type="hidden" class="form-control" value="4" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Email Siswa</label>
                                    <input id="email" {{ ($edit) ? 'disabled' : '' }} name="email" type="email" class="form-control" placeholder="Email Siswa" value="{{ isset($student) ? $student->email: '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Nomor Telepon Siswa</label>
                                    <input id="phone" name="phone" type="text" class="form-control" placeholder="Nomor Telepon Siswa" value="{{ isset($student) ? $student->student_profile[0]->phone : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Tempat, Tanggal Lahir Siswa</label>
                                    <input id="birthday" name="birthday" type="text" class="form-control" placeholder="Tempat, Tanggal Lahir Siswa" value="{{ isset($student) ? $student->student_profile[0]->birthday : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Alamat Siswa</label>
                                    <textarea name="address" id="address" rows="5" class="form-control">{{ isset($student) ? $student->student_profile[0]->address : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default mb-5">
                                    <label for="image">Foto Siswa</label>
                                    <input type="file" name="image" id="image" class="form-control-file">
                                </div>
                                {{-- @if ($edit)
                                <div class="form-group form-group-default">
                                    <label>Password Lama</label>
                                    <input id="old_pass" name="old_pass" type="text" class="form-control" placeholder="Password Lama">
                                </div>    
                                <div class="form-group form-group-default">
                                    <label>Password Baru</label>
                                    <input id="password" name="password" type="text" class="form-control" placeholder="Password Baru">
                                </div>    
                                <div class="form-group form-group-default">
                                    <label>Konfirmasi Password Baru</label>
                                    <input id="confirm_passw" name="confirm_passw" type="text" class="form-control" placeholder="Konfirmasi Password Baru">
                                </div>  
                                @endif --}}
                            </div>
                            @if (isset($student))
                                <div class="col-md-6 pr-0">
                                    <img src="{{ asset('storage') . '/' . $student->image }}" class="img-fluid">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <button type="submit" class="btn btn-success ml-auto">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection