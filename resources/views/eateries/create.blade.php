@extends('layouts.app')

@section('content')
    {{-- Show the shared form with values for a new eatery. --}}
    <section class="panel mx-auto max-w-3xl">
        <h1 class="mb-5 font-serif text-4xl font-bold">Add Eatery</h1>
        <form method="POST" action="{{ route('eateries.store') }}">
            @csrf
            @include('eateries._form')
            <button type="submit" class="button mt-5">Save Eatery</button>
        </form>
    </section>
@endsection
