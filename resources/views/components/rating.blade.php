{{-- Render a number and star for averages and individual ratings. --}}
@props(['value', 'precision' => 0])
<span class="font-semibold text-amber-800">{{ number_format($value, $precision) }} <span aria-label="stars">★</span></span>
