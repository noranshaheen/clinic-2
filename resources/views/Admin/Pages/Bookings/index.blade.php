@extends('Admin.Layout.master')

@section('title')
    Bookings
@endsection

@section('breadcrumbs')
    Bookings
@endsection

@section('content')
    <div class="content">
        <a href="{{ route('admin.bookings.create') }}" class="btn btn-success">Create Booking</a>
        <div>
            @if (session('success'))
                <div class="alert alert-success p-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div>
            <table class="table my-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Date</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->email }}</td>
                            <td>{{ $booking->phone }}</td>
                            <td>{{ $booking->date }}</td>
                            <td>{{ $booking->doctor->name }}</td>
                            <td>
                                <a href="{{route('admin.bookings.edit',$booking->id)}}">Edit</a>
                                <form action="{{route('admin.bookings.destroy',$booking->id)}}" method="POST"> 
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="delete" />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-content-center">
            <p>
                {{ $bookings->links() }}
            </p>
        </div>
    </div>
@endsection
