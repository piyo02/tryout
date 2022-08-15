@extends('layout.main')

@section('content')
<div class="panel-header bg-warning-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Manajemen Jenis Soal</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--1">
        @error('about')
            {{ $message }}
        @enderror
        @error('value')
            {{ $message }}
        @enderror
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
                        <h4 class="card-title">Daftar Jenis Soal</h4>
                        <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#add-variation">
                            <i class="fa fa-plus"></i>
                            Tambah Jenis Soal
                        </button>

                        <div class="modal fade" id="add-variation" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="/management/variation" method="post">
                                        @csrf
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                Tambah</span>
                                                <span class="fw-light">
                                                    Jenis Soal
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
                                                        <label>Tipe</label>
                                                        <input id="value_" name="value_" type="text" class="form-control" placeholder="Tipe" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group form-group-default">
                                                        <label>Data</label>
                                                        <select class="form-control" id="about" name="about">
                                                            <option value="collection">Bank Soal</option>
                                                            <option value="question">Soal</option>
                                                            {{-- <option value="tryout">Tryout</option> --}}
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
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Data</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variations as $variation)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$variation->value}}</td>
                                    <?php $variation_name = $variation->about?>
                                    <td>{{$$variation_name}}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#edit-variation-{{$variation->id}}">
                                            <i class="fa fa-pencil-alt"></i>
                                            Edit
                                        </button>

                                        <div class="modal fade" id="edit-variation-{{$variation->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/management/variation/{{$variation->id}}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                Edit</span>
                                                                <span class="fw-light">
                                                                    Tipe
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
                                                                        <label>Tipe</label>
                                                                        <input value="{{ $variation->value }}" id="value_" name="value_" type="text" class="form-control" placeholder="Tipe" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Data</label>
                                                                        <select class="form-control" id="about" name="about">
                                                                            <option {{ ($variation->about == 'collection') ? 'selected' : '' }} value="collection">Bank Soal</option>
                                                                            <option {{ ($variation->about == 'question') ? 'selected' : '' }} value="question">Soal</option>
                                                                            {{-- <option {{ ($variation->about == 'tryout') ? 'selected' : '' }} value="tryout">Tryout</option> --}}
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
                                        <button class="btn btn-danger btn-sm ml-auto" data-toggle="modal" data-target="#delete-variation-{{$variation->id}}">
                                            <i class="fa fa-trash"></i>
                                            Hapus
                                        </button>

                                        <div class="modal fade" id="delete-variation-{{$variation->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="/management/variation/{{ $variation->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-header no-bd">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">
                                                                Hapus</span>
                                                                <span class="fw-light">
                                                                    Tipe
                                                                </span>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="small text-danger">Menghapus Tipe akan menghapus Bank Soal</p>
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
                        {{ $variations->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
