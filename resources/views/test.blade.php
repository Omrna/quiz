
        <div class="container">
            @php
                $inserted_answer = '';
                $succ = strlen($success)>0 ? True : False;
            @endphp

            @if($succ)
                <p class="success-message">{{$success}}</p>
            @endif

            @if(count($questions)<1)
                <p>No questions are provided at the moment!</p>
            @endif

            @php
            // echo '<pre>';
            //     print_R($questions);
            // echo '</pre>';
            @endphp

            @foreach( $questions as $question )
                @php
                // Check if there is already existing answer
                foreach($answers as $answer){
                    if($answer->question_id === $question->id){
                        $inserted_answer = $answer->answer;
                    }
                }
                @endphp
            <div class="card-header">Question: {{$question->question}}</div>

            <div class="card-body">
                <div class="answer-form">
                    <form action="{{ route('answer') }}"  method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="answer">Answer:</label>
                            <input name="answer"  type="text" class="form-control" id="answer" placeholder="Answer the question" value="{{ $inserted_answer}}">
                        </div><br>
                        <input name="question_id" type="text" class="form-control" id="question_id" value="{{$question->id}}" style="display: none;">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Answer</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        {!! $questions->links() !!}


        <div class="card-body">
            <div class="answer-form">
                <form action="{{ route('submit_quiz') }}"  method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary">Submit your answers</button>
                </form>
                {{-- <button type="button" class="btn btn-primary">Show your score</button> --}}
            </div>
        </div>

        </div>

