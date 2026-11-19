@extends('layouts.app')

@section('content')
    <div class="mb-5 flex flex-wrap items-center justify-between gap-3">
        <h1 class="font-serif text-4xl font-bold">Eateries</h1>
        <a class="button" href="{{ route('eateries.create') }}">Add Eatery</a>
    </div>

    {{-- Submit all three filters as one query string. --}}
    <form action="{{ route('eateries.index') }}" method="GET" class="panel mb-6 grid items-end gap-4 sm:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr_auto]">
        <label class="label">Search
            <input class="field" name="q" value="{{ $q }}" placeholder="Name or specialty">
        </label>
        <label class="label">District
            <select class="field" name="district">
                <option value="">All districts</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" @selected($districtId === $district->id)>{{ $district->name }}</option>
                @endforeach
            </select>
        </label>
        <label class="label">Feature
            <select class="field" name="feature">
                <option value="">All features</option>
                @foreach ($features as $feature)
                    <option value="{{ $feature->name }}" @selected($featureName === $feature->name)>{{ $feature->name }}</option>
                @endforeach
            </select>
        </label>
        <button class="button" type="submit">Filter</button>
    </form>

    {{-- Let the grid grow from one column to three as space allows. --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($eateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
        @empty
            <p>No eateries match your filters.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $eateries->links() }}</div>
@endsection
