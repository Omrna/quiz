<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
    public function __construct( Question $question){
        $this->question = $question;
    }

    public function add(Request $request){
        $data = [];
        $success=''; // To set the success process
        if(!(Auth::user()->role)){ // Check if admin access or not
            return redirect('user');
        }else{ // if admin access then show all users
            if( $request->isMethod('post') ){

                // Get values
                $data['question'] = $request->input('question');
                $data['choice'] = $request->input('choice');

                // Validate if the variables to make sure that the variables have been set
                $this->validate(
                    $request,
                    [
                        'question' => 'required',
                        'choice' => 'required',
                    ]
                );
                $success='You have added the question successfully!';
                $this->question->insert($data); // Insert the data
            }

            return view('questions/add')->with('success',$success); // First parameter is the folder name, the second one is the filename
        }
    }

    public function showquestions(Request $request){
        if(!(Auth::user()->role)){ // Check if admin access or not
            return redirect('user');
        }else{ // if admin access then show all users
            $data = [];
            $data['questions'] = $this->question->all(); // Show all admin users
            return view('questions/allquestions',$data); // first parameter is the folder name, the second one is the filename
        }
    }
}
