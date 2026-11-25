@extends('layouts.app')

@section('title', 'Edit '.$animal->name)

@section('content')
    <h1>Edit {{ $animal->name }}</h1>

    <form method="POST" action="{{ route('animals.update', $animal) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('animals._form')
        <button class="button" type="submit">Save changes</button>
        <a href="{{ route('animals.show', $animal) }}">Cancel</a>
    </form>
@endsection
