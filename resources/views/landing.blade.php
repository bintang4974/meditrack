<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CliniTrack Pro - Clinical Logbook Sistem untuk Dokter Residen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .pricing-card {
            transition: all 0.3s ease;
        }

        .pricing-card:hover {
            transform: scale(1.05);
        }

        .recommended {
            border: 2px solid #667eea;
            position: relative;
        }

        .recommended::before {
            content: "REKOMENDASI";
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: #667eea;
            color: white;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .workflow-step {
            position: relative;
        }

        .workflow-step::after {
            content: "";
            position: absolute;
            top: 30px;
            right: -20px;
            width: 40px;
            height: 2px;
            background: #e5e7eb;
        }

        .workflow-step:last-child::after {
            display: none;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        .scroll-smooth {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="scroll-smooth">
    <!-- Navigation -->
    <nav class="fixed w-full bg-white/95 backdrop-blur-sm shadow-sm z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-notes-medical text-3xl text-gradient"></i>
                    <span class="text-2xl font-bold text-gradient">CliniTrack Pro</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#fitur" class="text-gray-700 hover:text-purple-600 transition">Fitur</a>
                    <a href="#workflow" class="text-gray-700 hover:text-purple-600 transition">Cara Kerja</a>
                    <a href="#pricing" class="text-gray-700 hover:text-purple-600 transition">Harga</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-purple-600 transition">Testimoni</a>
                    <button
                        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-2 rounded-full hover:shadow-lg transition">
                        Mulai Gratis
                    </button>
                </div>
                <button class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-20 gradient-bg text-white">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-block bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-6">
                        <span class="text-sm font-semibold">🏥 Platform Clinical Logbook Terpercaya</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        Kelola Logbook Klinis Anda dengan Sistem <span class="text-yellow-300">Project-Based</span> yang
                        Revolusioner
                    </h1>
                    <p class="text-xl mb-8 text-white/90">
                        Platform modern untuk dokter residen dan dosen. Kelola multiple rumah sakit, tim dokter, dan
                        rekam medis pasien dalam satu sistem terintegrasi.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button
                            class="bg-white text-purple-600 px-8 py-4 rounded-full font-semibold hover:shadow-xl transition transform hover:scale-105">
                            <i class="fas fa-rocket mr-2"></i> Coba Gratis Sekarang
                        </button>
                        <button
                            class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-purple-600 transition">
                            <i class="fas fa-play-circle mr-2"></i> Lihat Demo
                        </button>
                    </div>
                    <div class="mt-8 flex items-center space-x-6">
                        <div class="flex -space-x-2">
                            <img src="https://picsum.photos/seed/doctor1/40/40"
                                class="w-10 h-10 rounded-full border-2 border-white">
                            <img src="https://picsum.photos/seed/doctor2/40/40"
                                class="w-10 h-10 rounded-full border-2 border-white">
                            <img src="https://picsum.photos/seed/doctor3/40/40"
                                class="w-10 h-10 rounded-full border-2 border-white">
                            <img src="https://picsum.photos/seed/doctor4/40/40"
                                class="w-10 h-10 rounded-full border-2 border-white">
                        </div>
                        <div>
                            <div class="flex text-yellow-300">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="text-sm">Dipercaya 500+ dokter residen</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="float-animation">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                            <div class="bg-white rounded-xl p-6 shadow-2xl">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="font-bold text-gray-800">Project Operasi Obgyn</h3>
                                    <span
                                        class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-semibold">Active</span>
                                </div>
                                <div class="space-y-3">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-hospital mr-2 text-purple-600"></i>
                                        <span>3 Rumah Sakit</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-user-md mr-2 text-purple-600"></i>
                                        <span>12 Dokter</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-users mr-2 text-purple-600"></i>
                                        <span>245 Pasien</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-file-medical mr-2 text-purple-600"></i>
                                        <span>1,847 Entries</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Fitur Unggulan Sistem <span
                        class="text-gradient">Project-Based</span></h2>
                <p class="text-xl text-gray-600">Kelola praktik klinis Anda dengan cara yang lebih terstruktur dan
                    efisien</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Project Management -->
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-project-diagram text-3xl feature-icon"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Project Management</h3>
                    <p class="text-gray-600 mb-4">Buat dan kelola multiple project untuk berbagai keperluan klinis,
                        pendidikan, atau penelitian.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Unlimited project (Pro)</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Custom project settings</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Team collaboration</li>
                    </ul>
                </div>

                <!-- Multi Hospital -->
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-hospital-alt text-3xl feature-icon"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Multi Rumah Sakit</h3>
                    <p class="text-gray-600 mb-4">Kelola praktik di beberapa rumah sakit dalam satu project yang
                        terintegrasi.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Tambah unlimited rumah sakit</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Manage hospital data</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Location tracking</li>
                    </ul>
                </div>

                <!-- Team Management -->
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-users-medical text-3xl feature-icon"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Team Management</h3>
                    <p class="text-gray-600 mb-4">Undang dan kelola tim dokter dari berbagai rumah sakit dalam satu
                        project.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Role-based access</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Doctor profiles</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Specialization tracking</li>
                    </ul>
                </div>

                <!-- Patient Records -->
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-user-injured text-3xl feature-icon"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Patient Records</h3>
                    <p class="text-gray-600 mb-4">Kelola data pasien lengkap dengan rekam medis yang terstruktur.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Comprehensive patient data</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Medical history tracking</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Diagnosis records</li>
                    </ul>
                </div>

                <!-- Clinical Logbook -->
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-notes-medical text-3xl feature-icon"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Clinical Logbook</h3>
                    <p class="text-gray-600 mb-4">Catat setiap kasus klinis dengan detail yang lengkap dan terstruktur.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Detailed case entries</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>File attachments</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Unlimited entries (Pro)</li>
                    </ul>
                </div>

                <!-- Smart Reports -->
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-3xl feature-icon"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Smart Reports</h3>
                    <p class="text-gray-600 mb-4">Generate laporan komprehensif dengan filtering yang fleksibel.</p>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Export PDF & Excel</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Advanced filtering</li>
                        <li><i class="fas fa-check text-green-500 mr-2"></i>Custom reports</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Workflow Section -->
    <section id="workflow" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Cara Kerja Sistem <span class="text-gradient">Project-Based</span>
                </h2>
                <p class="text-xl text-gray-600">4 langkah mudah untuk mengelola logbook klinis Anda</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <div class="workflow-step text-center">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">
                        1
                    </div>
                    <h3 class="text-xl font-bold mb-3">Buat Project</h3>
                    <p class="text-gray-600">Mulai dengan membuat project baru untuk keperluan spesifik Anda</p>
                </div>

                <div class="workflow-step text-center">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">
                        2
                    </div>
                    <h3 class="text-xl font-bold mb-3">Tambah Rumah Sakit</h3>
                    <p class="text-gray-600">Tambahkan semua rumah sakit tempat Anda praktik</p>
                </div>

                <div class="workflow-step text-center">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">
                        3
                    </div>
                    <h3 class="text-xl font-bold mb-3">Undang Tim</h3>
                    <p class="text-gray-600">Ajak dokter lain bergabung dalam project Anda</p>
                </div>

                <div class="workflow-step text-center">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 text-white text-2xl font-bold">
                        4
                    </div>
                    <h3 class="text-xl font-bold mb-3">Catat & Lapor</h3>
                    <p class="text-gray-600">Input kasus klinis dan generate laporan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Pilih Paket <span class="text-gradient">Berlangganan</span></h2>
                <p class="text-xl text-gray-600">Fleksibel sesuai kebutuhan praktik klinis Anda</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Free Plan -->
                <div class="bg-white rounded-2xl p-8 pricing-card">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold mb-2">Free</h3>
                        <div class="text-4xl font-bold mb-2">Rp 0<span class="text-lg text-gray-600">/bulan</span>
                        </div>
                        <p class="text-gray-600">Cocok untuk mencoba fitur dasar</p>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Maksimal 2 Project</p>
                                <p class="text-sm text-gray-600">Buat hingga 2 project aktif</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Unlimited Rumah Sakit</p>
                                <p class="text-sm text-gray-600">Tambah rumah sakit tanpa batas</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Unlimited Dokter</p>
                                <p class="text-sm text-gray-600">Undang dokter sebanyak-banyaknya</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Unlimited Pasien</p>
                                <p class="text-sm text-gray-600">Kelola pasien tanpa batas</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">5 Entries/Pasien/Bulan</p>
                                <p class="text-sm text-gray-600">Logbook terbatas per pasien</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-times text-red-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold text-gray-400">Custom Labels & Tags</p>
                                <p class="text-sm text-gray-400">Hanya menggunakan yang tersedia</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-times text-red-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold text-gray-400">Custom Categories</p>
                                <p class="text-sm text-gray-400">Hanya kategori default</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Basic Reports</p>
                                <p class="text-sm text-gray-600">Export PDF & Excel dasar</p>
                            </div>
                        </div>
                    </div>

                    <button
                        class="w-full bg-gray-100 text-gray-700 py-3 rounded-full font-semibold hover:bg-gray-200 transition">
                        Mulai Gratis
                    </button>
                </div>

                <!-- Pro Plan -->
                <div class="bg-white rounded-2xl p-8 pricing-card recommended">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold mb-2">Pro</h3>
                        <div class="text-4xl font-bold mb-2">Rp 149K<span class="text-lg text-gray-600">/bulan</span>
                        </div>
                        <p class="text-gray-600">Untuk praktik klinis profesional</p>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Unlimited Projects</p>
                                <p class="text-sm text-gray-600">Buat project tanpa batas</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Unlimited Rumah Sakit</p>
                                <p class="text-sm text-gray-600">Tambah rumah sakit tanpa batas</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Unlimited Dokter</p>
                                <p class="text-sm text-gray-600">Undang dokter sebanyak-banyaknya</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Unlimited Pasien</p>
                                <p class="text-sm text-gray-600">Kelola pasien tanpa batas</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Unlimited Entries</p>
                                <p class="text-sm text-gray-600">Logbook tanpa batas per pasien</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Custom Labels & Tags</p>
                                <p class="text-sm text-gray-600">Buat label dan tag khusus</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Custom Categories</p>
                                <p class="text-sm text-gray-600">Buat kategori logbook sendiri</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Advanced Reports</p>
                                <p class="text-sm text-gray-600">Filter kompleks & custom reports</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-3 mt-1"></i>
                            <div>
                                <p class="font-semibold">Priority Support</p>
                                <p class="text-sm text-gray-600">Support prioritas 24/7</p>
                            </div>
                        </div>
                    </div>

                    <button
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-full font-semibold hover:shadow-lg transition">
                        Pilih Pro
                    </button>
                </div>
            </div>

            <div class="text-center mt-12">
                <p class="text-gray-600">
                    <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                    30 hari uang kembali • Tidak ada kartu kredit untuk Free • Batalkan kapan saja
                </p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Apa Kata <span class="text-gradient">Dokter</span> Kami</h2>
                <p class="text-xl text-gray-600">Testimoni dari pengguna setia CliniTrack Pro</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-2xl p-8">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6">"Sistem project-based benar-benar membantu saya mengelola praktik di
                        3 rumah sakit berbeda. Semua data terintegrasi dengan baik!"</p>
                    <div class="flex items-center">
                        <img src="https://picsum.photos/seed/doctor5/50/50" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-semibold">Dr. Sarah Wijaya</p>
                            <p class="text-sm text-gray-600">Dokter Spesialis Obgyn</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6">"Fitur collaboration memudahkan saya dan tim dokter residen untuk
                        berbagi kasus dan belajar bersama. Sangat recommended!"</p>
                    <div class="flex items-center">
                        <img src="https://picsum.photos/seed/doctor6/50/50" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-semibold">Prof. Dr. Budi Santoso</p>
                            <p class="text-sm text-gray-600">Dosen Kedokteran</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-2xl p-8">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6">"Export laporan sangat membantu untuk presentasi dan publikasi
                        ilmiah. Data lengkap dan mudah diakses."</p>
                    <div class="flex items-center">
                        <img src="https://picsum.photos/seed/doctor7/50/50" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-semibold">Dr. Ahmad Fauzi</p>
                            <p class="text-sm text-gray-600">Dokter Residen Bedah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Siap Meningkatkan Efisiensi Praktik Klinis Anda?</h2>
            <p class="text-xl mb-8 text-white/90">Bergabunglah dengan 500+ dokter yang sudah menggunakan CliniTrack Pro
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button
                    class="bg-white text-purple-600 px-8 py-4 rounded-full font-semibold hover:shadow-xl transition transform hover:scale-105">
                    <i class="fas fa-rocket mr-2"></i> Mulai Gratis Sekarang
                </button>
                <button
                    class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-purple-600 transition">
                    <i class="fas fa-calendar mr-2"></i> Jadwalkan Demo
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-notes-medical text-2xl text-purple-400"></i>
                        <span class="text-xl font-bold">CliniTrack Pro</span>
                    </div>
                    <p class="text-gray-400">Platform clinical logbook terpercaya untuk dokter residen dan dosen di
                        Indonesia.</p>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Produk</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Fitur</a></li>
                        <li><a href="#" class="hover:text-white transition">Harga</a></li>
                        <li><a href="#" class="hover:text-white transition">Demo</a></li>
                        <li><a href="#" class="hover:text-white transition">Integrasi</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Status</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">© 2024 CliniTrack Pro. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition"><i
                            class="fab fa-facebook text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i
                            class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i
                            class="fab fa-linkedin text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition"><i
                            class="fab fa-instagram text-xl"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navigation
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg');
            } else {
                nav.classList.remove('shadow-lg');
            }
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards and sections
        document.querySelectorAll('.card-hover, .pricing-card, .workflow-step').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>

</html>
