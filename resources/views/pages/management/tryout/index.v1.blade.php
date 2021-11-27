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
                        <h4 class="card-title">Try Out</h4>
                        <button class="btn btn-xs btn-default ml-auto"  data-toggle="modal" data-target="#token">
                            Token Try Out
                        </button>

                        <div class="modal fade" id="token" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="/tryout/token" method="post">
                                        @csrf
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                Token</span>
                                                <span class="fw-light">
                                                Try Out
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
                                                        <label>Token</label>
                                                        <input type="text" id="token" name="token" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" class="btn btn-sm btn-primary">Kerjakan</button>
                                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
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
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tryouts as $tryout)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ preg_replace("/(?!^).(?!$)/", "*", $tryout->token) }}</td>
                                    <td>{{$tryout->date}}</td>
                                    <td>
                                        <a href="/tryout/{{$tryout->id}}" class="btn btn-sm btn-default">
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
                        {{ $tryouts->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
