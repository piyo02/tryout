<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\Variation;
use App\Models\Collection;
use App\Models\StudentAnswer;
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

    public function store_group(Request $request)
    {
        // $total = ($request->col_variation_id == 2) ? 10 : 50;
        $total = 50;
        $validatedData = $request->validate([
            'question' => 'required',
            'variation_id' => 'required',
            'collection_id' => 'required',
        ]);

        $statement = \explode(" ", $request->question);
        if( count($statement) != 5 ){
            return redirect('/management/collection/' . $request->collection_id)->with('danger', 'Soal yang anda masukkan tidak sesuai format');
        }

        $options = ['A', 'B', 'C', 'D', 'E'];
        $parent = Question::create([
            'value' => $request->question,
            'collection_id' => $request->collection_id,
            'created_by' => auth()->user()->id,
            'status' => 1,
            'variation_id' => $request->variation_id,
        ]);
        for ($i=0; $i < $total; $i++) { 
            
            $question = $statement;
            shuffle($question);
            
            $answer = array_pop($question);
            $idx_answer = array_search($answer, $statement);
            $str_question = implode(" ", $question);
            
            $quest = Question::create([
                'value' => $str_question,
                'parent_id' => $parent->id,
                'collection_id' => $request->collection_id,
                'created_by' => auth()->user()->id,
                'status' => 1,
                'variation_id' => $request->variation_id,
            ]);

            for ($j=0; $j < 5; $j++) { 
                Option::create([
                    'value' => $options[$j],
                    'skor' => ($j == $idx_answer) ? 1 : 0,
                    'question_id' => $quest->id,
                ]);
            }
        }
        return redirect('/management/collection/' . $request->collection_id)->with('success', 'Berhasil Membuat Soal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Question $question)
    {
        $variations = Variation::where('about', 'question')->get();
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
            'variation_id' => $questions[0]->variation_id,
            'variations' => $variations,
            'button_add' => false,
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
            $question_content = Storage::disk('local')->get('public/uploads/questions/question.html');
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
        $questionHasStudentAnswer = StudentAnswer::where('question_id', $question->id)->get();
        $path = ( $question->parent_id ) ? "/management/question/$question->parent_id?col_id=$question->collection_id" : '/management/collection/' . $question->collection_id;
        
        if( count($questionHasStudentAnswer) ){
            return redirect($path)->with('danger', 'Gagal Menghapus Bank Soal karena telah dikerjakan!');
        } else {
            Option::where('question_id', $question->id)->delete();
            Question::destroy($question->id);
            
            return redirect($path)->with('success', 'Berhasil Menghapus Data');
        }

    }
}
