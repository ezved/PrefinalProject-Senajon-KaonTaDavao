{{-- Display the card data already loaded by its controller. --}}
@props(['eatery'])
<article class="panel flex h-full flex-col">
    <div class="flex items-start justify-between gap-2">
        <div>
            <a class="text-sm font-semibold text-emerald-800 hover:underline" href="{{ route('districts.show', $eatery->district) }}">{{ $eatery->district->name }}</a>
            <h2 class="mt-1 font-serif text-2xl font-bold">
                <a class="hover:underline" href="{{ route('eateries.show', $eatery) }}">{{ $eatery->name }}</a>
            </h2>
        </div>
        @unless ($eatery->is_open)
            <span class="rounded-full bg-stone-200 px-2 py-1 text-xs font-semibold">Closed</span>
        @endunless
    </div>
    {{-- The price symbols show the relative cost. --}}
    <p class="mt-3 text-sm text-stone-700">{{ ['budget' => '₱', 'mid' => '₱₱', 'splurge' => '₱₱₱'][$eatery->price_range] }} · {{ $eatery->specialty ?? 'Specialty unlisted' }}</p>
    <div class="mt-4 flex flex-wrap gap-2">
        @foreach ($eatery->features as $feature)
            <a class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-900 hover:bg-emerald-100" href="{{ route('eateries.index', ['feature' => $feature->name]) }}">{{ $feature->name }}</a>
        @endforeach
    </div>
    {{-- Show an average only when reviews exist. --}}
    <p class="mt-auto pt-4 text-sm">
        @if ($eatery->reviews_count)
            <x-rating :value="$eatery->reviews_avg_rating" :precision="1" /> ({{ $eatery->reviews_count }} {{ Str::plural('review', $eatery->reviews_count) }})
        @else
            No reviews yet.
        @endif
    </p>
</article>
