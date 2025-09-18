{{-- Surgical Care --}}
<div id="form_surgical" class="d-none">
    @include('entry.forms._surgical')
</div>

{{-- Normal Entry --}}
<div id="form_normal" class="d-none">
    @include('entry.forms._normal')
</div>

{{-- Waitlist (Active) --}}
<div id="form_waitlist_active" class="d-none">
    @include('entry.forms._waitlist_active')
</div>

{{-- Waitlist (Completed) --}}
<div id="form_waitlist_completed" class="d-none">
    @include('entry.forms._waitlist_completed')
</div>

{{-- Waitlist (Suspended) --}}
<div id="form_waitlist_suspended" class="d-none">
    @include('entry.forms._waitlist_suspended')
</div>
