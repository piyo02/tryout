@extends('layout.main')

@section('content')
<div class="panel-header bg-primary-gradient">
    <div class="page-inner py-5">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
            <div>
                <h2 class="text-white pb-2 fw-bold">Try Out</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="row mt--1">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Try Out Yang Telah Diikuti</h4>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Token</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tryouts as $tryout)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $tryout->collection->name }}</td>
                                    <td>{{ preg_replace("/(?!^).(?!$)/", "*", $tryout->token) }}</td>
                                    <td>{{$tryout->date}}</td>
                                    <td>
                                        <a href="/history/tryout/{{$tryout->id}}" class="btn btn-sm btn-default">
                                            <i class="icon-eye"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <ul class="pagination pg-primary">
                        {{ $tryouts->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
