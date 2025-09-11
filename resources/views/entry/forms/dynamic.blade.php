@if ($category->category_main === 'Surgical Care')
    {{-- Base fields for Surgical Care --}}
    @include('entry.forms._surgical')
@endif

@if ($category->category_main === 'Medical Care')
    {{-- Base fields for Medical Care --}}
    @include('entry.forms._medical')
@endif

{{-- Overlap fields untuk Surgical dan Medical --}}
@if (in_array($category->category_main, ['Surgical Care', 'Medical Care']))
    @include('entry.forms._common')
@endif

@if ($category->category_sub === 'Surgical Waitlist Tracking')
    {{-- Waitlist form --}}
    @include('entry.forms._waitlist')
@endif
