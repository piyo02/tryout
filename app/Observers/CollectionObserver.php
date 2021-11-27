<?php

namespace App\Observers;

use App\Models\Collection;
use App\Models\Question;

class CollectionObserver
{
    public function deleting(Collection $collection)
    {
        $questions = Question::where('collection_id', $collection->id)->get();
        foreach ($questions as $question ) {
            Question::destroy($question->id);
        }
    }
}
