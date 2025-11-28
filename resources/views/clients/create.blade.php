@extends('layouts.app')

@section('title', 'Ajouter un client')

@section('content')
<h2>Add new customer</h2>

<form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" class="form-control" required pattern="^\+?[0-9]{8,15}$" title="Enter a valid phone number">
    </div>
    <div class="form-group">
        <label for="photo">Photo</label>
        <input type="file" name="photo" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Add new customer</button>
</form>
@endsection