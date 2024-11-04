@extends('admin.layout.master')
@section('content')
<div class=" content-body">
    <div class="text-center my-4">
        <h2>Admin List</h2>
    </div>
    <div class="row justify-content-between align-items-center my-3 mx-1">
        <div class="col-6 col-md-2 mb-2 mb-md-0">
            <a href="#" class="btn btn-primary text-white "><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="col-12 col-md-6">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control mx-2" placeholder="Search">
                    <button type="submit" class="btn bg-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-dark text-center">
            <thead>
                <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    @if (Auth::user()->role == 'superadmin')
                    <th scope="col"></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($admin as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone ?? '-' }}</td>
                    <td>{{ $item->address ?? '-' }}</td>
                    @if (Auth::user()->role == 'superadmin')
                    <td>
                        <div class=" d-flex align-items-center justify-content-center ">
                          <a href="#" class="btn btn-sm btn-warning mx-2"><i class="fa-solid fa-pen-to-square"></i></a>
                          <form action="">
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                          </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
@endsection