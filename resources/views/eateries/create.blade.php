{{-- Use the shared page layout. --}}
@extends('layouts.app')

{{-- Provide the content for the main area. --}}
@section('content')
    {{-- Show the shared form with values for a new eatery. --}}
    <section class="panel mx-auto max-w-3xl">
        <h1 class="mb-5 font-serif text-4xl font-bold">Add Eatery</h1>
        <form method="POST" action="{{ route('eateries.store') }}">
            {{-- Send the token Laravel checks for this form. --}}
            @csrf
            {{-- Render the shared section here. --}}
            @include('eateries._form')
            {{-- Submit the current form. --}}
            <button type="submit" class="button mt-5">Save Eatery</button>
        </form>
    </section>
@endsection
