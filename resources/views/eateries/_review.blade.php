{{-- Post a review under one of the seeded reviewer names. --}}
<form method="POST" action="{{ route('eateries.reviews.store', $eatery) }}" class="space-y-4">
    {{-- Send the token Laravel checks for this form. --}}
    @csrf
    {{-- Render the shared section here. --}}
    @include('partials.errors')
    <div>
        <label class="label" for="user_id">Reviewer</label>
        {{-- Show the available choices. --}}
        <select class="field" id="user_id" name="user_id">
            <option value="">Choose a reviewer</option>
            {{-- Render one item for each record. --}}
            @foreach ($users as $reviewer)
                <option value="{{ $reviewer->id }}" @selected(old('user_id') == $reviewer->id)>{{ $reviewer->name }}</option>
            @endforeach
        </select>
        {{-- Show the validation message beside this field. --}}
        @error('user_id') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label" for="rating">Rating</label>
        {{-- Collect the rating value. --}}
        <input class="field" type="number" id="rating" name="rating" value="{{ old('rating') }}" placeholder="1–5 stars">
        {{-- Show the validation message beside this field. --}}
        @error('rating') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label" for="body">Review</label>
        {{-- Collect the body value. --}}
        <textarea class="field" id="body" name="body" rows="4">{{ old('body') }}</textarea>
        {{-- Show the validation message beside this field. --}}
        @error('body') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    {{-- Submit the current form. --}}
    <button type="submit" class="button">Post Review</button>
</form>
