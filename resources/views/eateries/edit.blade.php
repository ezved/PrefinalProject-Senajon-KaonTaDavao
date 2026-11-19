@extends('layouts.app')

@section('content')
    {{-- Load the current values and submit a PUT request. --}}
    <section class="panel mx-auto max-w-3xl">
        <h1 class="mb-5 font-serif text-4xl font-bold">Edit Eatery</h1>
        <form method="POST" action="{{ route('eateries.update', $eatery) }}">
            @csrf
            @method('PUT')
            @include('eateries._form')
            <button type="submit" class="button mt-5">Save Eatery</button>
        </form>
    </section>
@endsection
