@extends('layouts.admin')


@section('style')
  <style>
    .user_image{
      border-radius: 50%;
      width: 2rem;
      height: 2rem;
      object-fit: cover;
    }
  </style>
@endsection

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
              <th>Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Created At</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($resources as $resource)
                    <tr>
                      <td>{{$resource->id}}</td>
                      <td><img class="user_image" src="{{$resource->photo}}"></td>
                      <td>{{$resource->user->name}}</td>
                      <td>{{$resource->user->email}}</td>
                      <td>{{$resource->phone}}</td>
                      <td>{{$resource->created_at->diffForHumans()}}</td>
                      <td><a href="{{route('generate_pdf',$resource->id)}}" class="btn btn-block btn-outline-primary btn-sm">Export to PDF</a></td>
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
  {{ $resources->links() }}
@endsection

