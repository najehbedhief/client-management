@extends('layouts.app')
 
@section('title', 'List of clients')
 
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>List of clients</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Add new customer</a>
    </div>
 <div class="d-flex mb-3 mt-4 align-items-center">
    <!-- Search form -->
    <form method="GET" action="{{ route('clients.index') }}" class="mr-2 flex-grow-1">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </div>
    </form>

    <!-- Reset button -->
    <a href="{{ route('clients.index') }}" class="btn btn-outline-danger">Reset</a>
</div>

 @if($clients->count())

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

    @else
    <div class="alert alert-warning mt-4">
            No results found.
        </div>
    @endif
    <div class="d-flex justify-content-center">
    {{ $clients->links('pagination::bootstrap-4') }}
</div>
@endsection