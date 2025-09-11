{{-- Surgical Care --}}
@if ($category->category_main === 'Surgical Care')
    @include('entry.forms._surgical')
@endif

{{-- Medical Care --}}
@if ($category->category_main === 'Medical Care')
    @include('entry.forms._medical')
@endif

{{-- Overlap fields (Surgical Care & Medical Care) --}}
@if (in_array($category->category_main, ['Surgical Care', 'Medical Care']))
    @include('entry.forms._common')
@endif

{{-- Surgical Waitlist Tracking --}}
@if ($category->category_sub === 'Surgical Waitlist Tracking')
    @include('entry.forms._waitlist')
@endif
