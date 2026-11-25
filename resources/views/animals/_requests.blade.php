<h2>Adoption requests ({{ $animal->adoptionRequests->count() }})</h2>

@foreach ($animal->adoptionRequests as $adoptionRequest)
    <div class="card">
        <strong>{{ $adoptionRequest->full_name }}</strong> · {{ $adoptionRequest->email }} · {{ $adoptionRequest->phone }}
        <span class="badge">{{ $adoptionRequest->status }}</span>
        <p>{{ $adoptionRequest->message }}</p>

        @if ($adoptionRequest->status === 'pending')
            <form method="POST" action="{{ route('requests.update', $adoptionRequest) }}" style="display: inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="accepted">
                <button class="button" type="submit">Accept</button>
            </form>
            <form method="POST" action="{{ route('requests.update', $adoptionRequest) }}" style="display: inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="refused">
                <button class="button light" type="submit">Refuse</button>
            </form>
        @endif
    </div>
@endforeach

@if ($animal->status !== 'adopted')
    <h2>Adopt {{ $animal->name }}</h2>
    <form method="POST" action="{{ route('requests.store', $animal) }}">
        @csrf
        <p>
            <label for="full_name">Your full name</label><br>
            <input id="full_name" name="full_name" value="{{ old('full_name') }}">
            @error('full_name') <br><small class="error">{{ $message }}</small> @enderror
        </p>
        <p>
            <label for="email">Email</label><br>
            <input id="email" name="email" type="email" value="{{ old('email') }}">
            @error('email') <br><small class="error">{{ $message }}</small> @enderror
        </p>
        <p>
            <label for="phone">Phone</label><br>
            <input id="phone" name="phone" value="{{ old('phone') }}">
            @error('phone') <br><small class="error">{{ $message }}</small> @enderror
        </p>
        <p>
            <label for="message">Why would you like to adopt {{ $animal->name }}?</label><br>
            <textarea id="message" name="message" rows="3" cols="50">{{ old('message') }}</textarea>
            @error('message') <br><small class="error">{{ $message }}</small> @enderror
        </p>
        <button class="button" type="submit">Send my request</button>
    </form>
@endif
