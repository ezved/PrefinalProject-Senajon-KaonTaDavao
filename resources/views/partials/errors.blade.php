{{-- Summarize validation errors above the current form. --}}
@if ($errors->any())
    <div role="alert" class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-red-900">
        <p class="font-semibold">Check the following fields.</p>
        <ul class="mt-1 list-disc pl-5">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif
