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

            {{-- Waitlist Status (muncul kalau sub = Surgical Waitlist Tracking) --}}
            <div class="mb-3 d-none" id="waitlist_status_wrapper">
                <label>Status Waitlist</label>
                <select id="waitlist_status" name="waitlist_status" class="form-control">
                    <option value="">-- Pilih Status --</option>
                    <option value="active">Active</option>
                    <option value="completed">Completed</option>
                    <option value="suspended">Suspended</option>
                </select>
            </div>

            {{-- Dynamic Form Fields --}}
            <div id="form_fields">
                @include('entry.forms.dynamic')
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const categories = @json($categories);

        function showForm(id) {
            document.querySelectorAll('#form_fields > div').forEach(div => {
                div.classList.add('d-none');
            });
            if (id) document.getElementById(id).classList.remove('d-none');
        }

        // Handle change kategori → isi sub categories
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

            // Reset form ketika ganti kategori
            showForm(null);
            document.getElementById('waitlist_status_wrapper').classList.add('d-none');
        });

        // Handle change sub kategori → tampilkan form sesuai rules
        document.getElementById('sub_category').addEventListener('change', function() {
            let subCatText = this.options[this.selectedIndex].text;
            let categoryText = document.getElementById('category').options[document.getElementById('category')
                .selectedIndex].text;
            let waitlistWrapper = document.getElementById('waitlist_status_wrapper');

            if (subCatText.includes("Surgical Waitlist Tracking")) {
                waitlistWrapper.classList.remove('d-none');
                showForm(null);
            } else if (categoryText === "Surgical Care") {
                waitlistWrapper.classList.add('d-none');
                showForm("form_surgical");
            } else {
                waitlistWrapper.classList.add('d-none');
                showForm("form_normal");
            }
        });

        // Handle change waitlist status
        document.getElementById('waitlist_status').addEventListener('change', function() {
            let status = this.value;
            if (status === 'active') showForm("form_waitlist_active");
            else if (status === 'completed') showForm("form_waitlist_completed");
            else if (status === 'suspended') showForm("form_waitlist_suspended");
            else showForm(null);
        });
    </script>
@endpush
