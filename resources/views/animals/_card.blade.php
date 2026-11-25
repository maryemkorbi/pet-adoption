<article class="card">
    @if ($animal->photo)
        <img src="{{ asset('storage/'.$animal->photo) }}" alt="{{ $animal->name }}">
    @endif
    <h3>{{ $animal->name }}</h3>
    <p>
        <span class="badge">{{ ucfirst($animal->species) }}</span>
        <span class="badge {{ $animal->status }}">{{ ucfirst($animal->status) }}</span>
    </p>
    <p>{{ $animal->age }} {{ $animal->age === 1 ? 'year' : 'years' }} · {{ $animal->gender }}</p>
    <p>At <a href="{{ route('shelters.show', $animal->shelter) }}">{{ $animal->shelter->name }}</a></p>
    <a href="{{ route('animals.show', $animal) }}">Details</a>
</article>
