<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\Variation;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $collection = Collection::where('id', $request->col_id)->first();
        $parent_ids = [
            (object)[
                'name' => 'collection_id',
                'value' => $request->col_id,
            ]
        ];
        $parent = true;
        if(!$request->col_id){
            return redirect('/management/collection/');
        }
        if($request->parent_id){
            $parent = false;
            $parent_ids[] = (object)[
                'name' => 'parent_id',
                'value' => $request->parent_id,
            ];
        }
        if( $collection->variation_id == 1 ){
            $parent = false;
        }
        $cancel = ($request->parent_id) ? "/management/question/$request->parent_id?col_id=$request->col_id" : "/management/collection/$request->col_id";
        $variations = Variation::where('about', 'question')->get();
        return view('pages.management.collection.question.form', [
            'header' => 'Manajemen Soal - Form Tambah',
            'action' => (object)[
                'form' => '/management/question/',
                'cancel' => $cancel,
            ],
            'edit' => false,
            'parent' => $parent,
            'parent_ids' => $parent_ids,
            'variations' => $variations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'variation_id' => 'required',
            'collection_id' => 'required',
        ]);
        // file question
        $filename = 'soal-' . $request->collection_id . time() . '.html';
        $path = "public/uploads/questions/$filename";
        if( Storage::disk('local')->put($path, $request->value) ){
            $validatedData['value'] = $path;
        }

        if(isset($request->parent_id)){
            $validatedData['parent_id'] = $request->parent_id;
        }
        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['status'] = 1;
        try {
            Question::create($validatedData);
            $status = 'success';
            $message = 'Berhasil Menambahkan Soal';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Menambahkan Soal';
        }
        $path = ( isset($request->parent_id) ) ? "/management/question/$request->parent_id?col_id=$request->collection_id" : '/management/collection/' . $request->collection_id;
        return redirect($path)->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Question $question)
    {
        $questions = Question::where('parent_id', $question->id)->latest()->paginate(10);
        $back = ($request->parent_id) ? "/management/question/$request->parent_id?col_id=$request->col_id" : "/management/collection/$request->col_id";
        return view('pages.management.collection.detail', [
            'action' => (object) [
                'back' => $back,
                'create' => "/management/question/create?col_id=$request->col_id&parent_id=$question->id",
            ],
            'header' => "Manajemen Soal",
            'questions' => $questions,
            'collection_id' => $request->col_id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Question $question)
    {
        try {
            $question_content = Storage::disk('local')->get($question->value);
        } catch (\Exception $exception) {
            $question_content = Storage::disk('local')->get('public/uploads/question/question.html');
        }

        $cancel = "/management/collection/$request->col_id";
        $parent_ids = [
            (object)[
                'name' => 'collection_id',
                'value' => $request->col_id,
            ]
        ];
        $parent = true;
        if(!$request->col_id){
            return redirect('/management/collection/');
        }
        if($request->parent_id){
            $cancel = "/management/question/$request->parent_id?col_id=$request->col_id";
            $parent = false;
            $parent_ids[] = (object)[
                'name' => 'parent_id',
                'value' => $request->parent_id,
            ];
        }
        if( $question->collection->variation_id == 1 ){
            $parent = false;
        }
        $options = Option::where('question_id', $question->id)->get();
        $variations = Variation::where('about', 'question')->get();
        return view('pages.management.collection.question.form', [
            'action' => (object)[
                'form' => "/management/question/$question->id",
                'cancel' => $cancel,
            ],
            'header' => 'Manajemen Soal - Form Edit',
            'edit' => true,
            'variations' => $variations,
            'parent' => $parent,
            'parent_ids' => $parent_ids,
            'question' => $question,
            'options' => $options,
            'question_content' => $question_content,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $validatedData = $request->validate([
            'variation_id' => 'required',
            'status' => 'required',
        ]);
        // file question
        if( Storage::disk('local')->put($question->value, $request->value) ){
            $validatedData['value'] = $question->value;
        }

        try {
            Question::where('id', $question->id)->update($validatedData);
            if( isset($request->answer) ){
                for ($i=0; $i < 5; $i++) { 
                    $option = "option_$i";
                    $option_id = "id_option_$i";
                    $skor = ($request->answer == $option) ? 1 : 0;

                    if( $request->$option ){
                        Option::where('id', $request->$option_id)->update([
                            'value' => $request->$option,
                            'skor' => $skor,
                        ]);
                    }
                }
            }
            $status = 'success';
            $message = 'Berhasil Menambahkan Soal';
        } catch (\Exception $exception) {
            $status = 'danger';
            $message = 'Gagal Menambahkan Soal';
        }
        $path = ( $question->parent_id ) ? "/management/question/$question->parent_id?col_id=$question->collection_id" : '/management/collection/' . $question->collection_id;
        return redirect($path)->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        Question::destroy($question->id);
        $path = ( $question->parent_id ) ? "/management/question/$question->parent_id?col_id=$question->collection_id" : '/management/collection/' . $question->collection_id;
        return redirect($path)->with('success', 'Berhasil Menghapus Data');
    }
}
