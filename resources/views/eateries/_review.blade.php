{{-- Post a review under one of the seeded reviewer names. --}}
<form method="POST" action="{{ route('eateries.reviews.store', $eatery) }}" class="space-y-4">
    @csrf
    @include('partials.errors')
    <div>
        <label class="label" for="user_id">Reviewer</label>
        <select class="field" id="user_id" name="user_id">
            <option value="">Choose a reviewer</option>
            @foreach ($users as $reviewer)
                <option value="{{ $reviewer->id }}" @selected(old('user_id') == $reviewer->id)>{{ $reviewer->name }}</option>
            @endforeach
        </select>
        @error('user_id') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label" for="rating">Rating</label>
        <input class="field" type="number" id="rating" name="rating" value="{{ old('rating') }}" placeholder="1–5 stars">
        @error('rating') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label" for="body">Review</label>
        <textarea class="field" id="body" name="body" rows="4">{{ old('body') }}</textarea>
        @error('body') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <button type="submit" class="button">Post Review</button>
</form>
