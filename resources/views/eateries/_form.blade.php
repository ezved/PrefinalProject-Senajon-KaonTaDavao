{{-- Render the shared section here. --}}
@include('partials.errors')

{{-- Use submitted values after an error and saved values on first edit. --}}
<div class="grid gap-4 sm:grid-cols-2">
    <div>
        <label class="label" for="name">Name</label>
        {{-- Collect the name value. --}}
        <input class="field" id="name" name="name" value="{{ old('name', $eatery->name) }}">
        {{-- Show the validation message beside this field. --}}
        @error('name') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
        {{-- Show the validation message beside this field. --}}
        @error('slug') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label" for="district_id">District</label>
        {{-- Show the available choices. --}}
        <select class="field" id="district_id" name="district_id">
            <option value="">Choose a district</option>
            {{-- Render one item for each record. --}}
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(old('district_id', $eatery->district_id) == $district->id)>{{ $district->name }}</option>
            @endforeach
        </select>
        {{-- Show the validation message beside this field. --}}
        @error('district_id') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div class="sm:col-span-2">
        <label class="label" for="address">Address</label>
        {{-- Collect the address value. --}}
        <input class="field" id="address" name="address" value="{{ old('address', $eatery->address) }}">
        {{-- Show the validation message beside this field. --}}
        @error('address') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label" for="price_range">Price range</label>
        {{-- Show the available choices. --}}
        <select class="field" id="price_range" name="price_range">
            <option value="">Choose a price range</option>
            {{-- Render one item for each record. --}}
            @foreach (['budget' => 'Budget', 'mid' => 'Mid', 'splurge' => 'Splurge'] as $value => $label)
                <option value="{{ $value }}" @selected(old('price_range', $eatery->price_range) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        {{-- Show the validation message beside this field. --}}
        @error('price_range') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label" for="specialty">Specialty</label>
        {{-- Collect the specialty value. --}}
        <input class="field" id="specialty" name="specialty" value="{{ old('specialty', $eatery->specialty) }}">
        {{-- Show the validation message beside this field. --}}
        @error('specialty') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div class="sm:col-span-2">
        {{-- The hidden value lets an unchecked box stay unchecked after an error. --}}
        <input type="hidden" name="is_open" value="0">
        <label class="label"><input type="checkbox" name="is_open" value="1" @checked(old('is_open', $eatery->is_open))> Open</label>
        {{-- Show the validation message beside this field. --}}
        @error('is_open') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <fieldset class="sm:col-span-2">
        <legend class="label">Features</legend>
        {{-- A previous submission with no choices should show an empty selection. --}}
        @php($checkedFeatures = session()->hasOldInput() ? old('features', []) : $selectedFeatures)
        <div class="mt-2 flex flex-wrap gap-x-5 gap-y-2">
            {{-- Render one item for each record. --}}
            @foreach ($features as $feature)
                <label class="text-sm"><input type="checkbox" name="features[]" value="{{ $feature->id }}" @checked(in_array($feature->id, (array) $checkedFeatures))> {{ $feature->name }}</label>
            @endforeach
        </div>
        {{-- Show the validation message beside this field. --}}
        @error('features') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
        {{-- Render one item for each record. --}}
        @foreach ($errors->get('features.*') as $featureErrors)
            {{-- Render one item for each record. --}}
            @foreach ($featureErrors as $message)
                <p class="text-sm text-red-700">{{ $message }}</p>
            @endforeach
        @endforeach
    </fieldset>
    <div>
        <label class="label" for="permit_no">Permit number</label>
        {{-- Collect the permit no value. --}}
        <input class="field" id="permit_no" name="permit_no" value="{{ old('permit_no', $eatery->permit?->permit_no) }}" placeholder="DVO-2026-0415">
        {{-- Show the validation message beside this field. --}}
        @error('permit_no') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label" for="expires_on">Permit expiry date</label>
        {{-- Collect the expires on value. --}}
        <input class="field" type="date" id="expires_on" name="expires_on" value="{{ old('expires_on', $eatery->permit?->expires_on?->format('Y-m-d')) }}">
        {{-- Show the validation message beside this field. --}}
        @error('expires_on') <p class="text-sm text-red-700">{{ $message }}</p> @enderror
    </div>
</div>
