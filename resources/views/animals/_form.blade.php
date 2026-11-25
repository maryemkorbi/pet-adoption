<p>
    <label for="name">Name</label><br>
    <input id="name" name="name" value="{{ old('name', $animal->name) }}">
    @error('name') <br><small class="error">{{ $message }}</small> @enderror
</p>

<p>
    <label for="shelter_id">Shelter</label><br>
    <select id="shelter_id" name="shelter_id">
        <option value="">— choose —</option>
        @foreach ($shelters as $shelter)
            <option value="{{ $shelter->id }}" @selected(old('shelter_id', $animal->shelter_id) == $shelter->id)>{{ $shelter->name }}</option>
        @endforeach
    </select>
    @error('shelter_id') <br><small class="error">{{ $message }}</small> @enderror
</p>

<p>
    <label for="species">Species</label><br>
    <select id="species" name="species">
        <option value="">— choose —</option>
        @foreach (App\Models\Animal::SPECIES as $species)
            <option value="{{ $species }}" @selected(old('species', $animal->species) === $species)>{{ ucfirst($species) }}</option>
        @endforeach
    </select>
    @error('species') <br><small class="error">{{ $message }}</small> @enderror
</p>

<p>
    <label for="breed">Breed (optional)</label><br>
    <input id="breed" name="breed" value="{{ old('breed', $animal->breed) }}">
    @error('breed') <br><small class="error">{{ $message }}</small> @enderror
</p>

<p>
    <label for="age">Age (years)</label><br>
    <input id="age" name="age" type="number" min="0" max="30" value="{{ old('age', $animal->age) }}">
    @error('age') <br><small class="error">{{ $message }}</small> @enderror
</p>

<p>
    Gender<br>
    @foreach (App\Models\Animal::GENDERS as $gender)
        <label>
            <input type="radio" name="gender" value="{{ $gender }}" @checked(old('gender', $animal->gender) === $gender)>
            {{ ucfirst($gender) }}
        </label>
    @endforeach
    @error('gender') <br><small class="error">{{ $message }}</small> @enderror
</p>

<p>
    <input type="hidden" name="vaccinated" value="0">
    <label>
        <input type="checkbox" name="vaccinated" value="1" @checked(old('vaccinated', $animal->vaccinated))>
        Vaccinated
    </label>
    @error('vaccinated') <br><small class="error">{{ $message }}</small> @enderror
</p>

<p>
    <label for="description">Description</label><br>
    <textarea id="description" name="description" rows="4" cols="50">{{ old('description', $animal->description) }}</textarea>
    @error('description') <br><small class="error">{{ $message }}</small> @enderror
</p>

<p>
    <label for="photo">Photo (optional, max 2 MB)</label><br>
    <input id="photo" name="photo" type="file" accept="image/*">
    @error('photo') <br><small class="error">{{ $message }}</small> @enderror
</p>
