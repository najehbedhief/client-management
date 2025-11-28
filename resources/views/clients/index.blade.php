@extends('layouts.app')
 
@section('title', 'List of clients')
 
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>List of clients</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Add new customer</a>
    </div>
 
    <table class="table table-hover table-sm mt-4">
         <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>
                        @if($client->photo)
                            <img src="{{ asset('photos/' . $client->photo) }}" alt="{{ $client->name }}" width="100" class="img-thumbnail object-fit-cover">
                        @else
                            No photo
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-outline-warning mr-1"><i class="fa-solid fa-pen"></i></a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $clients->links('pagination::bootstrap-4') }}
</div>
@endsection