@extends('pages.tryout.working')

@section('models')
<div class="page-inner">
    <div class="row">
        <div class="col-sm-8">
            <div class="card card-stats card-round">
                <div class="card-body ">
                    <h4>{{ $tryout->collection->name }}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-6">
                    <div class="card p-3 text-center">
                        <h4 id="time"></h4>
                    </div>
                </div>
                <div class="col-6">
                    <form action="/tryout/finished" method="post" id="form_finish" class="form_finish">
                        @csrf
                        <input type="hidden" id="start_date" name="start_date" value="{{ session()->get('start_date') }}">
                        <input type="hidden" id="end_date" name="end_date" value="{{ session()->get('end_date') }}">
                        <input type="hidden" id="time" name="time" value="{{ session()->get('time') }}">
                        <input type="hidden" id="tryout_id" name="tryout_id" value="{{ $tryout->id }}">
                        <input type="hidden" id="variation_id" name="variation_id" value="{{ $tryout->collection->variation_id }}">
                        <input type="hidden" id="worksheet_id" name="worksheet_id" value="{{ session()->get('worksheet_id') }}">
                        <button id="btn_finish" type="submit" class="btn_finish btn btn-danger">SELESAI</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            @foreach ($questions as $question)
            <div class="card d-none" id="{{ $question->id }}" value="{{ $question->id }}">
                <div class="card-header">
                    <h4><b>Soal {{$loop->iteration}}/{{count($questions)}}</b></h4>
                </div>
                <div class="card-body">
                    <div id="question" class="mb-2">
                        {!! file_get_contents(storage_path('app/'.$question->value)) !!}
                    </div>
                    <div class="options">
                        @foreach ($question->options as $option)
                        <div class="mb-3"><button onclick="answer( {{$option->id}}, {{$question->id}}, {{$option->skor}} )" class="mr-2 btn btn-sm btn-default btn-round btn-border">{{ $options[$loop->iteration] }}</button><span>{{ $option->value }}</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body p-2">
                    <div class="col-12">
                        <div class="row justify-content-around">
                            @foreach ($questions as $question)
                            <button id="btn_number_{{ $question->id }}" onclick="change_question({{ $question->id }})" value="{{ $question->id }}" class="btn_number text-center btn-sm px-4 btn btn-default btn-border">{{$loop->iteration}}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection