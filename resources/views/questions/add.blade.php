@extends('layouts.adminlayout')

@section('admincontent')
<div class="col-sm-8 main-contents">
    <div class="container">
        @php
            $succ = strlen($success)>0 ? True : False;
        @endphp

        @if($succ)
            <p class="success-message">{{$success}}</p>
        @endif
        <h2 class="page-title">Add a New Question:</p>
        <br>
        <div class="question-form">
            <form action="{{ route('addquestion') }}"  method="post">
                {{ csrf_field() }}

                <div class="-group">
                    <label for="question">Question:</label>
                    <input name="question" type="text" class="form-control" id="question" placeholder="Enter a new question">
                </div><br>
                <div class="form-group">
                    <label for="choice">Choice:</label>
                    <input name="choice"  type="choice" class="form-control" id="choice" placeholder="Add an expected answer">
                </div><br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
      </div>
</div>
@endsection

