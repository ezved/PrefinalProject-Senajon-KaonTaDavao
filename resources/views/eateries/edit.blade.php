{{-- Use the shared page layout. --}}
@extends('layouts.app')

{{-- Provide the content for the main area. --}}
@section('content')
    {{-- Load the current values and submit a PUT request. --}}
    <section class="panel mx-auto max-w-3xl">
        <h1 class="mb-5 font-serif text-4xl font-bold">Edit Eatery</h1>
        <form method="POST" action="{{ route('eateries.update', $eatery) }}">
            {{-- Send the token Laravel checks for this form. --}}
            @csrf
            {{-- Tell Laravel which HTTP method this form uses. --}}
            @method('PUT')
            {{-- Render the shared section here. --}}
            @include('eateries._form')
            {{-- Submit the current form. --}}
            <button type="submit" class="button mt-5">Save Eatery</button>
        </form>
    </section>
@endsection
