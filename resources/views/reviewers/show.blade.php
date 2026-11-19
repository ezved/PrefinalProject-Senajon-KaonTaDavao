{{-- Use the shared page layout. --}}
@extends('layouts.app')

{{-- Provide the content for the main area. --}}
@section('content')
    <h1 class="font-serif text-4xl font-bold">{{ $user->name }}</h1>
    <p class="mb-6 mt-2">{{ $user->reviews->count() }} {{ Str::plural('review', $user->reviews->count()) }} written</p>

    {{-- Use the newest-first history prepared by the controller. --}}
    <div class="space-y-4">
        {{-- Render one item for each record. --}}
        @foreach ($user->reviews as $review)
            <article class="panel">
                <h2 class="text-lg"><a class="text-link" href="{{ route('eateries.show', $review->eatery) }}">{{ $review->eatery->name }}</a></h2>
                <p class="mt-1"><x-rating :value="$review->rating" /></p>
                <p class="mt-2 whitespace-pre-line">{{ $review->body }}</p>
            </article>
        @endforeach
    </div>
@endsection
