{{-- Use the shared page layout. --}}
@extends('layouts.app')

{{-- Provide the content for the main area. --}}
@section('content')
    <h1 class="font-serif text-4xl font-bold">{{ $district->name }}</h1>
    {{-- This count comes from the district's reviews through its eateries. --}}
    <p class="mb-6 mt-2">{{ $district->reviews_count }} {{ Str::plural('review', $district->reviews_count) }} in {{ $district->name }}</p>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        {{-- Render the records or show the empty state. --}}
        @forelse ($eateries as $eatery)
            {{-- Render this eatery using the shared card. --}}
            <x-eatery-card :eatery="$eatery" />
        @empty
            <p>No eateries listed in this district.</p>
        @endforelse
    </div>
@endsection
