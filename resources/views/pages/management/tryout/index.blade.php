@extends('layout.main')

@section('content')
<div class="panel-header bg-warning-gradient">
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
                <form action="/tryout/token" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Try Out</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default">
                            <label>Masukkan Token</label>
                            <input type="text" id="token" placeholder="Masukkan Token Tryout yang akan diikuti" name="token" class="form-control" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">IKUTI UJIAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
