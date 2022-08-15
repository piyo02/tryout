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
                        <a class="btn btn-danger btn-sm ml-auto text-white" href="/management/collection">
                            Batal
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($edit)
                            @method('put')
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group form-group-default">
                                    <label>Nama Siswa</label>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Nama Siswa" value="{{ isset($collection) ? $collection->name : '' }}" required>
                                    <input id="role_id" name="role_id" type="hidden" class="form-control" value="4" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Email Siswa</label>
                                    <input id="email" {{ ($edit) ? 'disabled' : '' }} name="email" type="email" class="form-control" placeholder="Email Siswa" value="{{ isset($collection) ? $collection->email: '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Nomor Telepon Siswa</label>
                                    <input id="phone" name="phone" type="text" class="form-control" placeholder="Nomor Telepon Siswa" value="{{ isset($collection) ? $collection->collection_profile[0]->phone : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Tempat, Tanggal Lahir Siswa</label>
                                    <input id="birthday" name="birthday" type="text" class="form-control" placeholder="Tempat, Tanggal Lahir Siswa" value="{{ isset($collection) ? $collection->collection_profile[0]->birthday : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label>Alamat Siswa</label>
                                    <textarea name="address" id="address" rows="5" class="form-control">{{ isset($collection) ? $collection->collection_profile[0]->address : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label for="image">Foto Siswa</label>
                                    <input type="file" name="image" id="image" class="form-control-file">
                                </div>
                            </div>
                            @if (isset($collection))
                                <div class="col-md-6 pr-0">
                                    <img src="{{ asset('storage') . '/' . $collection->image }}" class="img-fluid">
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <button class="btn btn-success ml-auto">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection