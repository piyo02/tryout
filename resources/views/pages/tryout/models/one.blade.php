@extends('pages.tryout.working')

@section('models')
<div class="page-inner">
    <div class="row">
        <div class="col-sm-8">
            <div class="card bg-primary text-white card-stats card-round">
                <div class="card-body ">
                    <h4>{{ $tryout->collection->name }}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-6">
                    <div class="card bg-primary text-white px-2 pt-3 pb-2">
                        <div class="row justify-content-center">
                            <h2 >
                                <i style="width: 30px;" class="fas fa-clock"></i>
                            </h2>
                            <h2 id="time" style="font-weight: bold;"></h2>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <form action="/tryout/finished" method="post" id="form_finish" class="form_finish">
                        @csrf
                        <input type="hidden" id="start_date" name="start_date" value="{{ session()->get('start_date') }}">
                        <input type="hidden" id="end_date" name="end_date" value="{{ session()->get('end_date') }}">
                        <input type="hidden" id="tryout_time" name="tryout_time" value="{{ session()->get('time') }}">
                        <input type="hidden" id="tryout_id" name="tryout_id" value="{{ $tryout->id }}">
                        <input type="hidden" id="variation_id" name="variation_id" value="{{ $tryout->collection->variation_id }}">
                        <input type="hidden" id="worksheet_id" name="worksheet_id" value="{{ session()->get('worksheet_id') }}">
                        <button style="text-align: center; padding-bottom: 7px !important; padding-top: 13px !important;" id="btn_finish" type="submit" class="btn_finish btn btn-primary">
                            <h2 style="font-weight: bold;">SELESAI</h2>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            @foreach ($answers as $answer)
            <div class="card d-none" id="{{ $answer->question_id }}" value="{{ $answer->question_id }}">
                <div class="card-header">
                    <h4><b>Soal {{$loop->iteration}}/{{count($answers)}}</b></h4>
                </div>
                <div class="card-body">
                    <div id="question" class="mb-2">
                        {!! file_get_contents(storage_path('app/'.$answer->question->value)) !!}
                    </div>
                    <div class="options">
                        @foreach ($answer->question->options as $option)
                        <div class="mb-3"><button id="{{$option->id}}" onclick="answer( {{$option->id}}, {{$answer->question_id}}, {{$option->skor}} )" class="mr-2 btn btn-sm btn-primary btn-round btn-border quest_{{$answer->question_id}}">{{ $options[$loop->iteration] }}</button><span>{{ $option->value }}</span></div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-sm-4">
            <div class="card bg-primary">
                <div class="card-body p-2">
                    <div class="col-12">
                        <div class="row justify-content-around">
                            @foreach ($answers as $answer)
                            <button id="btn_number_{{ $answer->question_id }}" onclick="change_question({{ $answer->question_id }})" value="{{ $answer->question_id }}" class="btn_number text-center btn-sm px-4 mx-2 btn btn-white btn-border">{{$loop->iteration}}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection