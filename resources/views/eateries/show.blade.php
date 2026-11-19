{{-- Use the shared page layout. --}}
@extends('layouts.app')

{{-- Provide the content for the main area. --}}
@section('content')
    {{-- Show the eatery details and the two management actions. --}}
    <section class="panel">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <a class="text-link" href="{{ route('districts.show', $eatery->district) }}">{{ $eatery->district->name }}</a>
                <h1 class="mt-2 font-serif text-4xl font-bold">{{ $eatery->name }}</h1>
            </div>
            <div class="flex flex-wrap gap-2">
                <a class="secondary" href="{{ route('eateries.edit', $eatery) }}">Edit</a>
                <form method="POST" action="{{ route('eateries.destroy', $eatery) }}">
                    {{-- Send the token Laravel checks for this form. --}}
                    @csrf
                    {{-- Tell Laravel which HTTP method this form uses. --}}
                    @method('DELETE')
                    {{-- Submit the current form. --}}
                    <button type="submit" class="secondary text-red-800">Delete Eatery</button>
                </form>
            </div>
        </div>
        <p class="mt-3">{{ $eatery->address }}</p>
        <p class="mt-2">{{ ['budget' => '₱', 'mid' => '₱₱', 'splurge' => '₱₱₱'][$eatery->price_range] }} · {{ ucfirst($eatery->price_range) }} · {{ $eatery->is_open ? 'Open' : 'Closed' }}</p>
        <p class="mt-2">Specialty: {{ $eatery->specialty ?? 'Unlisted' }}</p>
        <div class="mt-4 flex flex-wrap gap-2">
            {{-- Render one item for each record. --}}
            @foreach ($eatery->features as $feature)
                <a class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-semibold text-emerald-900" href="{{ route('eateries.index', ['feature' => $feature->name]) }}">{{ $feature->name }}</a>
            @endforeach
        </div>
    </section>

    {{-- Put dishes and the current permit side by side on wide screens. --}}
    <div class="mt-5 grid gap-5 md:grid-cols-2">
        <section class="panel">
            <h2 class="mb-3 font-serif text-2xl font-bold">Dishes</h2>
            <ul class="divide-y divide-stone-200">
                {{-- Render the records or show the empty state. --}}
                @forelse ($eatery->dishes as $dish)
                    <li class="flex justify-between gap-3 py-2">
                        <span>{{ $dish->name }} @if ($dish->is_bestseller) <span class="rounded-full bg-amber-100 px-2 py-1 text-xs font-semibold">Bestseller</span> @endif</span>
                        <span>₱{{ number_format((float) $dish->price, 2) }}</span>
                    </li>
                @empty
                    <li>No dishes listed.</li>
                @endforelse
            </ul>
        </section>
        <section class="panel">
            <h2 class="mb-3 font-serif text-2xl font-bold">Business Permit</h2>
            @if ($eatery->permit)
                <p>{{ $eatery->permit->permit_no }}</p>
                <p>Expires {{ $eatery->permit->expires_on->format('F j, Y') }}</p>
                @if ($eatery->permit->expires_on->lt(today()))
                    <p class="mt-2 font-semibold text-red-700">Permit expired</p>
                @endif
            @else
                <p>No permit listed.</p>
            @endif
        </section>
    </div>

    {{-- Show reviews newest first and keep their delete actions as forms. --}}
    <div class="mt-5 grid items-start gap-5 lg:grid-cols-[3fr_2fr]">
        <section class="panel">
            <h2 class="mb-2 font-serif text-2xl font-bold">Reviews</h2>
            <div class="divide-y divide-stone-200">
                {{-- Render the records or show the empty state. --}}
                @forelse ($eatery->reviews as $review)
                    <article class="py-3">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <a class="text-link" href="{{ route('reviewers.show', $review->user) }}">{{ $review->user->name }}</a>
                            <form method="POST" action="{{ route('reviews.destroy', $review) }}">
                                {{-- Send the token Laravel checks for this form. --}}
                                @csrf
                                {{-- Tell Laravel which HTTP method this form uses. --}}
                                @method('DELETE')
                                {{-- Submit the current form. --}}
                                <button type="submit" class="text-sm font-semibold text-red-800 hover:underline">Delete</button>
                            </form>
                        </div>
                        <p class="text-sm"><x-rating :value="$review->rating" /> · <time datetime="{{ $review->created_at->toDateString() }}">{{ $review->created_at->format('F j, Y') }}</time></p>
                        <p class="mt-2 whitespace-pre-line">{{ $review->body }}</p>
                    </article>
                @empty
                    <p class="py-3">No reviews yet.</p>
                @endforelse
            </div>
        </section>
        <section class="panel">
            @if ($eatery->is_open)
                <h2 class="mb-3 font-serif text-2xl font-bold">Write a Review</h2>
                {{-- Render the shared section here. --}}
                @include('eateries._review')
            @else
                <p>This eatery is closed. Reviews are paused.</p>
            @endif
        </section>
    </div>
@endsection
