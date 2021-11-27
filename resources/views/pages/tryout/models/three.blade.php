@extends('pages.tryout.working')

@section('models')
<div class="page-navs py-3 pr-2">
    <div class="row">
        <div class="col-sm-8">
            <div class="card card-stats card-round">
                <div class="card-body text-center">
                    @foreach($questions as $question)
                    <button id="btn-{{$question->id}}" class="btn-sm btn btn-default btn-border">{{$loop->iteration}}</button>
                    @endforeach
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
                        <input type="hidden" id="column" name="column" value="{{ count($questions) }}">
                        <button id="btn_finish" type="submit" class="btn_finish d-none btn btn-danger">SELESAI</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-inner page-inner-fill">
    <div id="questKanban" class="board">
        <?php $index = 1; ?>
        @foreach ($questions as $question)
            <span class="d-none parent" id="{{$question->id}}">
                <?php $parent_index = 0; ?>
                @foreach($question->childs as $parent)
                <div class="kanban-board child-{{$question->id}}" style="width: 450px">
                    <div class="card">
                        <div class="card-header text-center bg-danger text-white">
                            <h6 id="colum"><b>KOLOM {{$index}}</b></h6>
                        </div>
                        <div class="text-center card-body">
                            {!! file_get_contents(storage_path('app/'.$parent->value)) !!}
                        </div>
                    </div>
                    <?php $child_index = 0; ?>
                    @foreach($parent->childs as $child)
                    <div class="row mb-3">
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{$loop->iteration}}
                                    </span>
                                    <input type="text" class="form-control" value="{!! file_get_contents(storage_path('app/'.$child->value)) !!}">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="selectgroup" id="options">
                                <?php $option_index = 0; ?>
                                @foreach($child->options as $option)
                                <div class="selectgroup-item">
                                    <input type="radio" class="selectgroup-input">
                                    <span onclick="answer( {{$option->id}}, {{$child->id}}, {{$option->skor}} )" class="selectgroup-button selectgroup-button-icon">{{$option->value}}</span>
                                </div>
                                <?php $option_index++; ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <?php $child_index++; ?>
                    @endforeach
                </div>
                <?php $parent_index++; ?>
                @endforeach
            </span>
        <?php $index++; ?>
        @endforeach
    </div>
</div>
@endsection