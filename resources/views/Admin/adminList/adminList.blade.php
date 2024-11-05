@extends('admin.layout.master')
@section('content')
<div class=" content-body">
    <div class="text-center my-4">
        <h2>Admin List</h2>
    </div>
    <div class="row justify-content-between align-items-center my-3 mx-1">
        <div class="col-6 col-md-2 mb-2 mb-md-0">
            @if (Auth::user()->role == 'superadmin') 
                <a href="{{route('Admin#addAdminPage')}}" class="btn btn-primary text-white "><i class="fa-solid fa-plus"></i></a>
            @endif
        </div>
        <div class="col-12 col-md-6">
            <form action="{{route('Admin#AdminList')}}" method="GET">
                @csrf
                <div class="input-group">
                    <input type="text" value="{{request('search')}}" name="search" class="form-control mx-2" placeholder="Search">
                    <button type="submit" class="btn bg-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-dark text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
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
                @if ($admin->count() != 0)
                @foreach ($admin as $item)
                <tr>
                    <td>{{ ($admin->currentPage() - 1) * $admin->perPage() + $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone ?? '-' }}</td>
                    <td>{{ $item->address ?? '-' }}</td>
                    @if (Auth::user()->role == 'superadmin')
                    <td>
                        <div class=" d-flex align-items-center justify-content-center ">
                            <a href="{{route('Admin#deleteAdmin',$item->id)}}" class="btn btn-sm btn-danger cursor-pointer"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="5">There is no admin</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <span class="d-flex justify-content-end">{{ $admin->links() }}</span>
    </div>
</div>
@endsection