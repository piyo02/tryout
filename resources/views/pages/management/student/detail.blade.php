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
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">{{ $student->name }}</h4>
                        <a class="btn btn-sm ml-auto" href="/management/student">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Nama Siswa</label>
                                <input disabled id="name" name="name" type="text" class="form-control" placeholder="Nama Siswa" value="{{ isset($student) ? $student->name : '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Email Siswa</label>
                                <input disabled id="email" name="email" type="email" class="form-control" placeholder="Email Siswa" value="{{ isset($student) ? $student->email: '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Nomor Telepon Siswa</label>
                                <input disabled id="phone" name="phone" type="text" class="form-control" placeholder="Nomor Telepon Siswa" value="{{ isset($student) ? $student->student_profile[0]->phone : '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Tempat, Tanggal Lahir Siswa</label>
                                <input disabled id="birthday" name="birthday" type="text" class="form-control" placeholder="Tempat, Tanggal Lahir Siswa" value="{{ isset($student) ? $student->student_profile[0]->birthday : '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Alamat Siswa</label>
                                <textarea disabled name="address" id="address" rows="5" class="form-control">{{ isset($student) ? $student->student_profile[0]->address : '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <img src="{{ asset('storage') . '/' . $student->image }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection