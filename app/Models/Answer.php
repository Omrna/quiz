<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Answer extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function questions(){
        return $this->belongsTo('App\Models\Question','question_id','id');
    }

    /**
    * Fetch all answer/s
    *
    * @param integer user_id - User ID
    * @param integer question_id - Question ID
    * @return array - array of an existing answers
    */
    public function getAnswers($user_id, $question_id =null){
        $answers = [];
        if($question_id && $user_id){
            $answers = DB::select('SELECT * FROM answers WHERE user_id=:user_id AND question_id=:question_id',['user_id' => $user_id, 'question_id' => $question_id]);
        }else if($user_id){
            $answers = DB::select('SELECT * FROM answers WHERE user_id=:user_id',['user_id' => $user_id]);
        }
        return $answers;
    }

    /**
    * Update an answer
    *
    * @param integer user_id - User ID
    * @param integer question_id - Question ID
    * @param string answer - the new answer
    * @return bool - True if the action has been prcceded successfully, false otherwise
    */
    public function updateAnswer($user_id, $question_id, $answer){
        if($question_id && $user_id){
            $answers = DB::table('answers')->where([
                'user_id' => $user_id,
                'question_id' => $question_id
            ])->update(['answer' => $answer]);
            return true;
        }
        return false;
    }

    /**
    * Submit all answers, and update the user score
    *
    * @param integer user_id - User ID
    * @return bool - True if the action has been prcceded successfully, false otherwise
    */
    public function submitQuiz($user_id){
        if($user_id){
            // Get users answers
            $userAnswers = self::getAnswers($user_id);

            // Fetch all questions
            $questions = new Question();
            $allQuestions = $questions->getQuestions(true);

            $numberOfQuestions = count($allQuestions);
            $numberOfCorrectAnswers = 0;


            foreach($allQuestions as $i => $question) {
                foreach($userAnswers as $j => $answer) {
                    if(strcasecmp( $question->choice, $answer->answer) == 0){
                        $numberOfCorrectAnswers  ++;
                    }
                }
            }

            $userScore = 0;
            $userScore = ($numberOfCorrectAnswers / $numberOfQuestions) * 100;

            // Update the user score, and submit your answers,
            $answers = DB::table('users')->where(['id' => $user_id])->update(['score' => $userScore, 'is_answered_submitted' => true]);
            return true;
        }
        return false;
    }
}
