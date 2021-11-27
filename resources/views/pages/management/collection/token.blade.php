@extends('layout.main')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Manajemen Token</h2>
                <a class="btn btn-xs btn-danger" href="/management/collection">Kembali</a>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--1">
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
                        <h4 class="card-title">Daftar Token</h4>
                        <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#add-tryout">
                            Generate Token
                        </button>

                        <div class="modal fade" id="add-tryout" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="/management/tryout" method="post">
                                        @csrf
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                Generate</span> 
                                                <span class="fw-light">
                                                    Token
                                                </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <input type="hidden" name="collection_id" value="{{request()->col_id}}">
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Tanggal Try Out diadakan</label>
                                                        <input type="text" id="datepicker" name="date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target=".datetimepicker-input" autocomplete="off" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Durasi Ujian (menit)</label>
                                                        <input id="time" name="time" type="number" class="form-control" placeholder="Waktu" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Token</th>
                                <th scope="col">Tanggal Ujian</th>
                                <th scope="col">Durasi Ujian (menit)</th>
                                <th scope="col">Status</th>
                                {{-- <th scope="col">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tryouts as $tryout)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$tryout->token}}</td>
                                    <td>{{$tryout->date}}</td>
                                    <td>{{$tryout->time}}</td>
                                    <td>{!! $status[$tryout->status] !!}</td>
                                    {{-- <td>
                                        <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#edit-tryout-{{$tryout->id}}">
                                            <i class="fa fa-pencil-alt"></i>
                                            Edit
                                        </button>
                
                                        <div class="modal fade" id="edit-tryout-{{$tryout->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/management/tryout/{{$tryout->id}}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                Edit</span> 
                                                                <span class="fw-light">
                                                                    Token
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Tanggal {{$tryout->date}}</label>
                                                                        <input type="text" id="datepicker" name="date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target=".datetimepicker-input" autocomplete="off" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Waktu</label>
                                                                        <input value="{{$tryout->time}}" id="time" name="time" type="number" class="form-control" placeholder="Waktu" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Status</label>
                                                                        <select class="form-control" id="status" name="status">
                                                                            @foreach ($variations as $variation)
                                                                            <option {{($tryout->status == $variation->id) ? 'selected': ''}} value="{{$variation->id}}">{{$variation->value}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer no-bd">
                                                            <button type="submit" class="btn btn-success">Simpan</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger btn-sm ml-auto" data-toggle="modal" data-target="#delete-tryout-{{$tryout->id}}">
                                            <i class="fa fa-trash"></i>
                                            Hapus
                                        </button>

                                        <div class="modal fade" id="delete-tryout-{{$tryout->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/management/tryout/{{ $tryout->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                Hapus</span> 
                                                                <span class="fw-light">
                                                                    Token
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="small text-danger">Menghapus Token akan menghapus soal dan seluruh hasil kerja Siswa</p>
                                                            <h4>Yakin ingin menghapus data?</h4>
                                                        </div>
                                                        <div class="modal-footer no-bd">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
    
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pg-primary">
                        {{ $tryouts->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection