@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Laporan Aktivitas</h1>
    </div>

    <section class="section">
        <div class="card p-4 shadow-sm">
            <form id="filterForm">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label>Pilih Project</label>
                        <select name="project_id" id="project_id" class="form-select">
                            @foreach ($projects as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Rentang Waktu</label>
                        <div class="d-flex">
                            <input type="date" name="from_date" class="form-control me-2">
                            <input type="date" name="to_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Scope</label>
                        <select name="scope" class="form-select">
                            <option value="all">Cetak Semua Data Project</option>
                            <option value="mine">Data Saya Saja</option>
                        </select>
                    </div>
                </div>

                <hr>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label>Rumah Sakit</label>
                        <select name="site_id" id="site_id" class="form-select">
                            <option value="all">Semua Rumah Sakit</option>
                            @foreach ($sites as $site)
                                <option value="{{ $site->id }}">{{ $site->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="col-md-3">
                        <label>Label</label>
                        <select name="label_ids[]" class="form-select" multiple>
                            @foreach ($labels as $label)
                                <option value="{{ $label->id }}">{{ $label->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Tag</label>
                        <select name="tag_ids[]" class="form-select" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- <div class="mt-3">
                    <label>Kategori & Sub-Kategori</label>
                    <div class="accordion" id="categoryAccordion">
                        @foreach ($categories as $category)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $category->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $category->id }}">
                                        {{ $category->name }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $category->id }}" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        @foreach ($category->subCategories as $sub)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="sub_category_ids[]"
                                                    value="{{ $sub->id }}">
                                                <label class="form-check-label">{{ $sub->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> --}}

                <div class="mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="fw-bold">Kategori & Sub-Kategori</label>
                        <div>
                            <button type="button" class="btn btn-sm btn-outline-primary me-2" id="expandAll">Expand
                                All</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2" id="collapseAll">Collapse
                                All</button>
                            <button type="button" class="btn btn-sm btn-outline-success me-2" id="checkAll">Centang
                                Semua</button>
                            <button type="button" class="btn btn-sm btn-outline-danger" id="uncheckAll">Hapus
                                Centang</button>
                        </div>
                    </div>

                    <div class="accordion" id="categoryAccordion">
                        @foreach ($categories as $category)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $category->id }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $category->id }}">
                                        <input type="checkbox" class="form-check-input me-2 category-checkbox"
                                            data-category="{{ $category->id }}">
                                        {{ $category->name }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $category->id }}" class="accordion-collapse collapse"
                                    data-bs-parent="#categoryAccordion">
                                    <div class="accordion-body">
                                        @foreach ($category->subCategories as $sub)
                                            <div class="form-check ms-3">
                                                <input class="form-check-input sub-category-checkbox" type="checkbox"
                                                    name="sub_category_ids[]" data-parent="{{ $category->id }}"
                                                    value="{{ $sub->id }}" id="sub{{ $sub->id }}">
                                                <label class="form-check-label"
                                                    for="sub{{ $sub->id }}">{{ $sub->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="text-end mt-3">
                    <button type="button" class="btn btn-primary" id="filterBtn"><i class="bi bi-search"></i>
                        Tampilkan</button>
                </div>
            </form>
        </div>

        <div class="card mt-4 p-3 shadow-sm" id="reportResult">
            <div class="text-center text-muted">Silakan pilih filter untuk menampilkan data...</div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const accordion = document.getElementById('categoryAccordion');
                const expandAllBtn = document.getElementById('expandAll');
                const collapseAllBtn = document.getElementById('collapseAll');
                const checkAllBtn = document.getElementById('checkAll');
                const uncheckAllBtn = document.getElementById('uncheckAll');

                // Expand all categories
                expandAllBtn.addEventListener('click', () => {
                    accordion.querySelectorAll('.accordion-collapse').forEach(c => new bootstrap.Collapse(c, {
                        show: true
                    }));
                });

                // Collapse all categories
                collapseAllBtn.addEventListener('click', () => {
                    accordion.querySelectorAll('.accordion-collapse').forEach(c => new bootstrap.Collapse(c, {
                        hide: true
                    }));
                });

                // Check/uncheck all
                checkAllBtn.addEventListener('click', () => {
                    document.querySelectorAll('.form-check-input').forEach(chk => chk.checked = true);
                });
                uncheckAllBtn.addEventListener('click', () => {
                    document.querySelectorAll('.form-check-input').forEach(chk => chk.checked = false);
                });

                // Checkbox hierarchy behavior
                document.querySelectorAll('.category-checkbox').forEach(cat => {
                    cat.addEventListener('change', function() {
                        const catId = this.dataset.category;
                        document.querySelectorAll(`.sub-category-checkbox[data-parent="${catId}"]`)
                            .forEach(sub => sub.checked = this.checked);
                    });
                });

                document.querySelectorAll('.sub-category-checkbox').forEach(sub => {
                    sub.addEventListener('change', function() {
                        const parentId = this.dataset.parent;
                        const parent = document.querySelector(
                            `.category-checkbox[data-category="${parentId}"]`);
                        const allSubs = document.querySelectorAll(
                            `.sub-category-checkbox[data-parent="${parentId}"]`);
                        const allChecked = Array.from(allSubs).every(sub => sub.checked);
                        const noneChecked = Array.from(allSubs).every(sub => !sub.checked);

                        parent.checked = allChecked;
                        parent.indeterminate = !allChecked && !noneChecked;
                    });
                });

                // Ganti Rumah Sakit saat project berubah
                document.getElementById('project_id').addEventListener('change', function() {
                    const projectId = this.value;
                    const siteSelect = document.getElementById('site_id');
                    siteSelect.innerHTML = '<option>Memuat...</option>';

                    fetch(`/reports/sites/${projectId}`)
                        .then(res => res.json())
                        .then(sites => {
                            siteSelect.innerHTML = '<option value="all">Semua Rumah Sakit</option>';
                            sites.forEach(site => {
                                const opt = document.createElement('option');
                                opt.value = site.id;
                                opt.textContent = site.name;
                                siteSelect.appendChild(opt);
                            });
                        })
                        .catch(() => {
                            siteSelect.innerHTML = '<option value="">Gagal memuat</option>';
                        });
                });

                // Saat klik tombol tampilkan
                document.getElementById('filterBtn').addEventListener('click', function() {
                    let formData = new FormData(document.getElementById('filterForm'));
                    fetch("{{ route('reports.filter') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            document.getElementById('reportResult').innerHTML = data.html;

                            // ✅ Simpan filter terakhir ke tombol export (Excel & PDF)
                            const form = document.getElementById('filterForm');
                            const formDataObj = {};
                            new FormData(form).forEach((value, key) => {
                                if (!formDataObj[key]) formDataObj[key] = [];
                                formDataObj[key].push(value);
                            });
                            const jsonFilters = JSON.stringify(formDataObj);

                            // Tunggu DOM update, lalu isi hidden input
                            setTimeout(() => {
                                const excelInput = document.getElementById('excelFilters');
                                const pdfInput = document.getElementById('pdfFilters');
                                if (excelInput && pdfInput) {
                                    excelInput.value = jsonFilters;
                                    pdfInput.value = jsonFilters;
                                }
                            }, 300);
                        })
                        .catch(err => console.error(err));
                });
            });
        </script>
    @endpush
@endsection
