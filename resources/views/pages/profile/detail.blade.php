@extends('layout.main')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Profil</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--2">
        @if (session()->has('success'))                        
            <div class="col-12">
                <div class="card bg-info py-2 px-4 text-white">
                    <b>{{ session('success') }}</b>
                </div>
            </div>
        @endif
        @if (session()->has('danger'))                        
            <div class="col-12">
                <div class="card bg-danger py-2 px-4 text-white">
                    <b>{{ session('danger') }}</b>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $user->name }}</h4>
                        <a class="btn btn-sm btn-primary ml-auto" href="/profile/{{$user->id}}/edit">
                            Edit Profil
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Nama User</label>
                                <input disabled id="name" name="name" type="text" class="form-control" placeholder="Nama User" value="{{ isset($user) ? $user->name : '' }}" required>
                            </div>
                            <div class="form-group form-group-default">
                                <label>Email User</label>
                                <input disabled id="email" name="email" type="email" class="form-control" placeholder="Email User" value="{{ isset($user) ? $user->email: '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-3 pr-0">
                            <img src="{{ asset('storage') . '/' . $user->image }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection