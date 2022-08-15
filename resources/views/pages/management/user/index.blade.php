@extends('layout.main')

@section('content')
<div class="panel-header bg-warning-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Manajemen Pengguna</h2>
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
                        <h4 class="card-title">Daftar Pengguna</h4>
                        <a class="btn btn-primary btn-sm ml-auto text-white" href="/management/user/create">
                            <i class="fa fa-plus"></i>
                            Tambah User
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm ml-auto text-white" href="/management/user/{{$user->id}}">
                                            <i class="icon-eye"></i>
                                            Detail
                                        </a>
                                        <a class="btn btn-default btn-sm ml-auto text-white" href="/management/user/{{$user->id}}/edit">
                                            <i class="fa fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <button class="btn btn-danger btn-sm ml-auto" data-toggle="modal" data-target="#delete-user-{{$user->id}}">
                                            <i class="fa fa-trash"></i>
                                            Hapus
                                        </button>

                                        <div class="modal fade" id="delete-user-{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/management/user/{{ $user->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                Hapus Data</span>
                                                                <span class="fw-light">
                                                                    User
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="small text-danger">Menghapus Data User akan menghapus soal yang telah dibuat oleh user</p>
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pg-primary">
                        {{ $users->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
