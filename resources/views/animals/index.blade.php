@extends('layouts.app')

@section('title', 'Animals')

@section('content')
    <h1>Animals looking for a home</h1>

    <div class="grid">
        @forelse ($animals as $animal)
            @include('animals._card', ['animal' => $animal])
        @empty
            <p>No animal found.</p>
        @endforelse
    </div>
@endsection