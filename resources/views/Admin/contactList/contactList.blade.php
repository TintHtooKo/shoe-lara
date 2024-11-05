@extends('admin.layout.master')
@section('content')
<div class=" content-body">
    <div class="text-center my-4">
        <h2>Contact List</h2>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered table-dark text-center">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @if ($contact->count() != 0)
                @foreach ($contact as $item)
                <tr>
                    <td class="@if($item->is_read == false)bg-danger text-white px-2 py-1 rounded @endif"> 
                        @if($item->is_read == false)
                        Unread
                        @endif 
                        {{ ($contact->currentPage() - 1) * $contact->perPage() + $loop->iteration }}
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->subject }}</td>
                    <td>{{Str::words($item->message,10)}}</td>
                    <td>
                        <div class=" d-flex align-items-center justify-content-center ">
                            <a href="{{route('Admin#contactDetail',$item->id)}}" class="btn btn-sm btn-warning cursor-pointer mx-2"><i class="fa-solid fa-eye"></i></a>
                            @if (Auth::user()->role == 'superadmin')
                            <a href="{{route('Admin#contactDelete',$item->id)}}" class="btn btn-sm btn-danger cursor-pointer"><i class="fa-solid fa-trash"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="5">There is no contact message</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <span class="d-flex justify-content-end">{{ $contact->links() }}</span>
    </div>
</div>
@endsection