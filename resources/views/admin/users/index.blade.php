@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Users</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Created At</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td><a href="{{route('change-role',$user->id)}}" type="button" class="btn btn-block btn-outline-primary btn-sm">@if ($user->role->id == 1)
                      Remove Admin Role
                    @else
                      Add Admin Role
                    @endif</button></td>
                    </tr>
                @endforeach
            </tbody>
          </table>
      
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  {{ $users->links() }}
@endsection
