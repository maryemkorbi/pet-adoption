@extends('layouts.app')

@section('title', 'Add an animal')

@section('content')
    <h1>Add an animal</h1>

    <form method="POST" action="{{ route('animals.store') }}" enctype="multipart/form-data">
        @csrf
        @include('animals._form')
        <button class="button" type="submit">Add the animal</button>
    </form>
@endsection
