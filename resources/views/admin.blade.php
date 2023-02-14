@extends('layouts.app')

@section('content')
    <div class="row admin-section">

        <div class="col-sm-4 left-side-nav">
            <a href="{{ route('allquestions') }}">All Questions</a>
            <a href="{{ route('addquestion') }}">New Question</a>
            <a href="{{ route('users') }}">All Users</a>
            <a href="{{ route('admins') }}">Admin Users</a>
        </div>
    </div>
@endsection
