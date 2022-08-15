<?php

namespace App\Observers;

use App\Models\Option;
use App\Models\Question;
use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Request;

class QuestionObserver
{
    public function created(Question $question)
    {
        $request = Request::all();
        $total = (array_key_exists('quest_two_opt', $request)) ? ($request['quest_two_opt'] == true) ? 2 : 5 : 5;
        if(isset($request['answer'])){
            for ($i=0; $i < $total; $i++) { 
                $option = 'option_' . $i;
                $skor = ($request['answer'] == $option) ? 1 : 0; 
                
                if( $request[$option] ){
                    Option::create([
                        'value' => $request[$option],
                        'skor' => $skor,
                        'question_id' => $question->id,
                    ]);
                }
            }
        }
    }

    public function deleting(Question $question)
    {
        Option::where('question_id', $question->id)->delete();
        Question::where('parent_id', $question->id)->delete();
        StudentAnswer::where('question_id', $question->id)->delete();
    }

    public function deleted(Question $question)
    {
        try {
            unlink( \storage_path( 'app/' . $question->value ) );
        } catch (\Throwable $th) {
            $message = 'Gagal Menghapus Soal';
        }
    }
}
