@extends('layouts.adminlayout')

@section('admincontent')
<div class="col-sm-8 main-contents">
    <div class="container">
        <h2 class="page-title">Admin Users:</p>
        <br>
        <table class="table table-bordered">
          <thead class="table-title">
            <tr>
              <th>Question</th>
              <th>Choice</th>
            </tr>
          </thead>
          <tbody class="table-contents">
            @foreach( $questions as $question )
                <tr>
                    <td>{{$question->question}}</td>
                    <td>{{$question->choice}}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
</div>
@endsection

