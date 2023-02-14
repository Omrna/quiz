@extends('layouts.adminlayout')

@section('admincontent')
<div class="col-sm-8 main-contents">
    <div class="container">
        <h2 class="page-title">Admin Users:</p>
        <br>
        <table class="table table-bordered">
          <thead class="table-title">
            <tr>
              <th>Full Names</th>
              <th>Usernames</th>
            </tr>
          </thead>
          <tbody class="table-contents">
            @foreach( $users as $user )
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->username}}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
</div>
@endsection

