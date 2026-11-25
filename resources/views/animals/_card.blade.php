<article class="card">
    <h3>{{ $animal->name }}</h3>
    <p>
        <span class="badge">{{ ucfirst($animal->species) }}</span>
        <span class="badge {{ $animal->status }}">{{ ucfirst($animal->status) }}</span>
    </p>
    <p>{{ $animal->age }} {{ $animal->age === 1 ? 'year' : 'years' }} · {{ $animal->gender }}</p>
    <p>At {{ $animal->shelter->name }}</p>
    <a href="{{ route('animals.show', $animal) }}">Details</a>
</article>