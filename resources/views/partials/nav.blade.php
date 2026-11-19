{{-- Link to the four main pages from the shared header. --}}
<header class="border-b border-emerald-950 bg-emerald-950 text-white">
    <nav aria-label="Main navigation" class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
        <a href="{{ route('home') }}" class="font-serif text-xl font-bold">Kaon Ta! Davao – Senajon's Food Guide</a>
        <div class="flex flex-wrap items-center gap-4 text-sm">
            <a href="{{ route('home') }}" class="hover:underline">Home</a>
            <a href="{{ route('eateries.index') }}" class="hover:underline">Eateries</a>
            <a href="{{ route('districts.index') }}" class="hover:underline">Districts</a>
            <a href="{{ route('eateries.create') }}" class="rounded-lg bg-amber-200 px-3 py-2 font-bold text-emerald-950">Add Eatery</a>
        </div>
    </nav>
</header>
