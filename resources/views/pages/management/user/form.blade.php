@extends('layout.main')

@section('content')
<div class="panel-header bg-primary-gradient">
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
                            <a class="btn btn-danger btn-sm ml-auto text-white" href="/management/user">
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
                                    <label>Nama User</label>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Nama User" value="{{ isset($user) ? $user->name : '' }}" required>
                                    <input id="role_id" name="role_id" type="hidden" class="form-control" value="3" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Email User</label>
                                    <input id="email" {{ ($edit) ? 'disabled' : '' }} name="email" type="email" class="form-control" placeholder="Email User" value="{{ isset($user) ? $user->email: '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label for="image">Foto User</label>
                                    <input type="file" name="image" id="image" class="form-control-file">
                                </div>
                            </div>
                            {{-- @if ($edit)
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default mt-5">
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
                            </div>
                            @endif --}}
                            @if (isset($user))
                                <div class="col-md-6 pr-0">
                                    <img src="{{ asset('storage') . '/' . $user->image }}" class="img-fluid">
                                </div>
                            @endif
                        </div>
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