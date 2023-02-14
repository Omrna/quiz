<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    use HasFactory;

    public function answers(){
        return $this->hasMany('App\Models\Answer');
    }

    /**
    * Fetch all questions (one by one in a seprate pages)
    *
    *  @return array - array of an existing questions
    */
    public function getQuestions($getAllQuestions = false){
        $questions = DB::table('questions');
        $questions = $getAllQuestions ? $questions->get() : $questions->paginate(1); // Fetch one data at a time
        return $questions;
    }
}
