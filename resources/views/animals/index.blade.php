@extends('layouts.app')

@section('title', 'Animals')

@section('content')
    <h1>Animals looking for a home</h1>
    <p>{{ $availableCount }} {{ $availableCount === 1 ? 'animal is' : 'animals are' }} available right now.</p>

    <form method="GET" action="{{ route('animals.index') }}">
        <input name="search" value="{{ request('search') }}" placeholder="Search by name">
        <input type="hidden" name="species" value="{{ request('species') }}">
        <button class="button light" type="submit">Search</button>
    </form>

    <p class="filters">
        <a href="{{ route('animals.index') }}">All</a>
        @foreach ($species as $oneSpecies)
            <a href="{{ route('animals.index', ['species' => $oneSpecies]) }}">{{ ucfirst($oneSpecies) }}</a>
        @endforeach
    </p>

    <div class="grid">
        @forelse ($animals as $animal)
            @include('animals._card', ['animal' => $animal])
        @empty
            <p>No animal found.</p>
        @endforelse
    </div>

    {{ $animals->links('pagination::default') }}
@endsection
