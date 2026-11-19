@extends('layouts.app')

@section('content')
    <h1 class="mb-5 font-serif text-4xl font-bold">Districts</h1>
    {{-- Display the precomputed eatery count alongside each district. --}}
    <ul class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($districts as $district)
            <li class="panel">
                <a class="text-link" href="{{ route('districts.show', $district) }}">{{ $district->name }}</a>
                <p class="mt-2">{{ $district->eateries_count }} {{ Str::plural('eatery', $district->eateries_count) }}</p>
            </li>
        @endforeach
    </ul>
@endsection
