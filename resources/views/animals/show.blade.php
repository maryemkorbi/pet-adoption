@extends('layouts.app')

@section('title', $animal->name)

@section('content')
    <p><a href="{{ route('animals.index') }}">&larr; Back to the animals</a></p>

    @if ($animal->photo)
        <img src="{{ asset('storage/'.$animal->photo) }}" alt="{{ $animal->name }}" style="max-width: 360px; border-radius: 12px;">
    @endif

    <h1>{{ $animal->name }} <span class="badge {{ $animal->status }}">{{ ucfirst($animal->status) }}</span></h1>

    <ul>
        <li>Species: {{ ucfirst($animal->species) }}{{ $animal->breed ? ' ('.$animal->breed.')' : '' }}</li>
        <li>Age: {{ $animal->age }} {{ $animal->age === 1 ? 'year' : 'years' }}</li>
        <li>Gender: {{ $animal->gender }}</li>
        <li>Vaccinated: {{ $animal->vaccinated ? 'yes' : 'no' }}</li>
        <li>Shelter: <a href="{{ route('shelters.show', $animal->shelter) }}">{{ $animal->shelter->name }}</a> ({{ $animal->shelter->city }})</li>
    </ul>

    <p>{{ $animal->description ?? 'No description yet.' }}</p>
    <p><small>Added {{ $animal->created_at->diffForHumans() }}</small></p>

    <p>
        <a class="button light" href="{{ route('animals.edit', $animal) }}">Edit</a>
    </p>
    <form method="POST" action="{{ route('animals.destroy', $animal) }}" onsubmit="return confirm('Delete this animal?')">
        @csrf
        @method('DELETE')
        <button class="button light" type="submit">Delete</button>
    </form>

    @include('animals._requests')
@endsection
