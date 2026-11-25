@extends('layouts.app')

@section('title', 'Shelters')

@section('content')
    <h1>Shelters</h1>

    <div class="grid">
        @foreach ($shelters as $shelter)
            <article class="card">
                <h3>{{ $shelter->name }}</h3>
                <p>{{ $shelter->city }} · {{ $shelter->phone }}</p>
                <p>{{ $shelter->animals_count }} {{ $shelter->animals_count === 1 ? 'animal' : 'animals' }}</p>
                <a href="{{ route('shelters.show', $shelter) }}">See its animals</a>
            </article>
        @endforeach
    </div>
@endsection
