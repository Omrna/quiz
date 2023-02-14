<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller{

    public function __construct( Answer $answer){
        $this->answer = $answer;
    }

    public function add(Request $request){
        $data = [];
        $success=''; // To set the success process
        $user_id = Auth::user()->id; // Get current user id
        $is_user_submitted = Auth::user()->is_answered_submitted; // Check if the current user has submitted their questions

        if( $request->isMethod('post') ){

            // Get values from the input fields
            $question_id = $request->input('question_id');
            $answer = $request->input('answer');

            $data['answer'] = $answer;
            $data['question_id'] = $question_id;
            $data['user_id'] = $user_id;

            // Validate if the variables to make sure that the variables have been set
            $this->validate(
                $request,
                [
                    'answer' => 'required',
                    'question_id' => 'required',
                ]
            );

            // Fetch an answer if exist for a specfic question
            $answer_data = $this->answer->getAnswers($user_id, $question_id);

            if($is_user_submitted){
                $success='You have already submitted your answers!';
            }else if(!empty($answer_data)){ // If there is an answer already, we need to update it
                $update_answer_data = $this->answer->updateAnswer($user_id, $question_id, $answer);
                if( $update_answer_data ){
                    $success='You have updated your answer!';
                }
            }else{
                $success='You have answered this question!';
                $this->answer->insert($data); // Insert the data
            }

        }

         // Fetch all questions
        $questions = new Question();
        $data['questions'] = $questions->getQuestions();

        // Fetch all answers if exists for the asked questions
        $data['answers'] = $this->answer->getAnswers($user_id);

        $data['submitted_answers'] = Auth::user()->is_answered_submitted; // Check if the current user has submitted their questions
        $data['user_score'] = Auth::user()->score; // Get user score

        return view('layouts.userlayout',$data)->with('success',$success);
    }

    public function fetch_data(Request $request){
        if($request->ajax()){ // Load data dynamically
            $data = [];
            $success=''; // To set the success process
            $user_id = Auth::user()->id; // Get current user id

             // Fetch all questions
            $questions = new Question();
            $data['questions'] = $questions->getQuestions();

            // Fetch all answers if exists for the asked questions
            $data['answers'] = $this->answer->getAnswers($user_id);

            $data['submitted_answers'] = Auth::user()->is_answered_submitted; // Check if the current user has submitted their questions
            $data['user_score'] = Auth::user()->score; // Get user score
            return  view('normal_users.usersquestions',$data)->with('success',$success)->render();
        }

    }


    public function submit_your_answers(Request $request){
        $data = [];
        $success=''; // To set the success process
        $user_id = Auth::user()->id; // Get current user id
        $is_user_submitted = Auth::user()->is_answered_submitted; // Check if the current user has submitted their questions

        if( $request->isMethod('post') ){
            $data['is_answered_submitted'] = true;

            if($is_user_submitted){
                $success='You have already submitted your answers!';
            }else{ // Submit quiz answers for a spesfic user
                $isSubmitted = $this->answer->submitQuiz($user_id);
                $success= $isSubmitted ? 'You have submitted your answers successfully!' : "Error!";
            }

        }

        // Fetch all questions
        $questions = new Question();
        $data['questions'] = $questions->getQuestions();

        // Fetch all answers if exists for the asked questions
        $data['answers'] = $this->answer->getAnswers($user_id);

        $data['submitted_answers'] = Auth::user()->is_answered_submitted; // Check if the current user has submitted their questions
        $data['user_score'] = Auth::user()->score; // Get user score

        return view('layouts.userlayout',$data)->with('success',$success); // First parameter is the folder name, the second one is the filename
    }
}
