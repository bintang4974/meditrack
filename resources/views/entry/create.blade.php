@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Entry</li>
                <li class="breadcrumb-item active">Tambah Entry</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <h3>Tambah Entry</h3>

        <form action="{{ route('entries.store', [$project, $site, $patient]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Category --}}
            <div class="mb-3">
                <label>Kategori</label>
                <select id="category" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Sub Category --}}
            <div class="mb-3">
                <label>Sub Kategori</label>
                <select id="sub_category" name="sub_category_id" class="form-control">
                    <option value="">-- Pilih Sub Kategori --</option>
                </select>
            </div>

            {{-- Waitlist Status (hanya muncul untuk Waitlist Tracking) --}}
            <div class="mb-3 d-none" id="waitlist_status_wrapper">
                <label>Status Waitlist</label>
                <select id="waitlist_status" name="waitlist_status" class="form-control">
                    <option value="">-- Pilih Status --</option>
                    <option value="active">Active</option>
                    <option value="completed">Completed</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>

            {{-- Dynamic Fields --}}
            <div id="form_fields"></div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const categories = @json($categories);

        // Populate subcategories
        document.getElementById('category').addEventListener('change', function() {
            let categoryId = this.value;
            let subCatSelect = document.getElementById('sub_category');
            subCatSelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';

            let selectedCat = categories.find(c => c.id == categoryId);
            if (selectedCat && selectedCat.sub_categories) {
                selectedCat.sub_categories.forEach(sc => {
                    subCatSelect.innerHTML += `<option value="${sc.id}">${sc.name}</option>`;
                });
            }
        });

        // Handle subcategory change
        document.getElementById('sub_category').addEventListener('change', function() {
            let subCatText = this.options[this.selectedIndex].text;
            let categorySelect = document.getElementById('category');
            let categoryText = categorySelect.options[categorySelect.selectedIndex].text;
            let waitlistWrapper = document.getElementById('waitlist_status_wrapper');
            let formFields = document.getElementById('form_fields');
            formFields.innerHTML = '';

            // Surgical Waitlist Tracking (khusus sub kategori)
            if (subCatText.includes("Surgical Waitlist Tracking")) {
                waitlistWrapper.classList.remove('d-none');
            }
            // Semua Surgical Care sub
            else if (categoryText === "Surgical Care") {
                waitlistWrapper.classList.add('d-none');
                formFields.innerHTML = `@include('entry.forms._surgical')`;
            }
            // Normal entry (selain 2 kategori di atas)
            else {
                waitlistWrapper.classList.add('d-none');
                formFields.innerHTML = `@include('entry.forms._normal')`;
            }
        });

        // Waitlist status handler
        document.getElementById('waitlist_status').addEventListener('change', function() {
            let status = this.value;
            let formFields = document.getElementById('form_fields');
            formFields.innerHTML = '';

            if (status === 'active') {
                formFields.innerHTML = `@include('entry.forms._waitlist_active')`;
            } else if (status === 'completed') {
                formFields.innerHTML = `@include('entry.forms._waitlist_completed')`;
            } else if (status === 'suspended') {
                formFields.innerHTML = `@include('entry.forms._waitlist_suspended')`;
            }
        });
    </script>
@endpush
