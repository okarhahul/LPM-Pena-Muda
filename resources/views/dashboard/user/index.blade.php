@extends('dashboard.layouts.main')

@section('konten')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Info Data User</h1>
</div>

<div class="table-responsive col-lg">


  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
      </tr>
    </thead>
    @foreach ($user as $users)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $users->name }}</td>
      <td>{{ $users->username }}</td>
      <td>{{ $users->email }}</td>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection