@extends('layouts.app')

@section('title', $shelter->name)

@section('content')
    <p><a href="{{ route('shelters.index') }}">&larr; All shelters</a></p>

    <h1>{{ $shelter->name }}</h1>
    <p>{{ $shelter->city }} · {{ $shelter->phone }}{{ $shelter->email ? ' · '.$shelter->email : '' }}</p>

    <h2>{{ $animals->count() }} {{ $animals->count() === 1 ? 'animal' : 'animals' }}</h2>

    <div class="grid">
        @forelse ($animals as $animal)
            @include('animals._card', ['animal' => $animal])
        @empty
            <p>This shelter has no animals yet.</p>
        @endforelse
    </div>
@endsection
