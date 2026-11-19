@extends('layouts.app')

@section('content')
    {{-- Introduce the guide and show the three live totals. --}}
    <section class="rounded-3xl bg-emerald-900 px-6 py-9 text-white sm:px-10">
        <h1 class="font-serif text-4xl font-bold sm:text-5xl">Kaon Ta! Davao</h1>
        <p class="mt-3 text-emerald-100">Explore Davao City’s carinderias and neighborhood eateries.</p>
        <dl class="mt-7 grid max-w-xl grid-cols-3 gap-4">
            <div><dt>Eateries</dt><dd class="text-3xl font-bold">{{ $eateryCount }}</dd></div>
            <div><dt>Districts</dt><dd class="text-3xl font-bold">{{ $districtCount }}</dd></div>
            <div><dt>Reviews</dt><dd class="text-3xl font-bold">{{ $reviewCount }}</dd></div>
        </dl>
    </section>
    {{-- Reuse the cards for the three highest-rated eateries. --}}
    <section class="mt-8">
        <h2 class="mb-4 font-serif text-3xl font-bold">Top Rated</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($topEateries as $eatery)
                <x-eatery-card :eatery="$eatery" />
            @empty
                <p>No reviews yet.</p>
            @endforelse
        </div>
    </section>
@endsection
