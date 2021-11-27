@extends('layout.main')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Hasil Try Out</h2>
                <a class="btn btn-xs btn-danger" href="/history/tryout">Kembali</a>
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
        @if ($result)
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Nilai</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$result->user->name}}</td>
                                <td>{{$result->final_value}}</td>
                                <td>
                                    <a href="/history/tryout/worksheet/{{$result->id}}?tryout_id={{$result->tryout_id}}" class="btn btn-sm btn-default">
                                        <i class="icon-eye"></i>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Nilai</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($worksheets as $worksheet)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$worksheet->user->name}}</td>
                                    <td>{{$worksheet->final_value}}</td>
                                    <td>
                                        <a href="/history/tryout/worksheet/{{$worksheet->id}}?tryout_id={{$worksheet->tryout_id}}" class="btn btn-sm btn-default">
                                            <i class="icon-eye"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pg-primary">
                        {{ $worksheets->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
