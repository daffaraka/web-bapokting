@extends('frontend.base-layout')
@section('title', 'Profil Bidang Bapokting')
@section('content')
    <div class="container section-title" style="margin-top: 10vw;" data-aos="fade-up">
        <h2>Struktur Tugas & Wewenang</h2>
        <p>Bidang Bapokting</p>
    </div>

    <div class="container">

        <!-- 1. Kepala Bidang Bapokting -->
        <div class="row gy-4 mb-5" data-aos="fade-up">
            <div class="col-lg-12">
                <h3 class="text-black">1. Kepala Bidang Bapokting</h3>
            </div>
            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <h5 class="fw-bold">Tugas:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-primary"></i> Memimpin dan mengoordinasikan seluruh kegiatan di
                        bidang Bahan Pokok dan Penting.</li>
                    <li><i class="bi bi-check2-circle text-primary"></i> Merumuskan kebijakan, rencana, dan program kerja
                        bidang.</li>
                    <li><i class="bi bi-check2-circle text-primary"></i> Melakukan pembinaan terhadap seluruh tim dan UPTD
                        wilayah.</li>
                </ul>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <h5 class="fw-bold">Wewenang:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-primary"></i> Mengambil keputusan strategis terkait pengelolaan
                        bahan pokok dan penting.</li>
                    <li><i class="bi bi-check2-circle text-primary"></i> Menetapkan prioritas program dan kegiatan.</li>
                    <li><i class="bi bi-check2-circle text-primary"></i> Memberikan arahan kepada ketua tim dan kepala UPTD.
                    </li>
                </ul>
            </div>
        </div>

        <!-- 2. Ketua Tim Harga -->
        <div class="row gy-4 mb-5" data-aos="fade-up">
            <div class="col-lg-12">
                <h3 class="text-black">2. Ketua Tim Harga</h3>
            </div>
            <div class="col-lg-6 content">
                <h5 class="fw-bold">Tugas:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-success"></i> Mengelola dan memantau perkembangan harga bahan
                        pokok dan penting.</li>
                    <li><i class="bi bi-check2-circle text-success"></i> Menyusun laporan evaluasi harga secara berkala.
                    </li>
                    <li><i class="bi bi-check2-circle text-success"></i> Melakukan koordinasi dengan stakeholder terkait
                        harga pasar.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h5 class="fw-bold">Wewenang:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-success"></i> Mengakses data harga dari berbagai wilayah.</li>
                    <li><i class="bi bi-check2-circle text-success"></i> Menyampaikan rekomendasi kebijakan harga kepada
                        Kepala Bidang.</li>
                </ul>
            </div>
        </div>

        <!-- 3. Ketua Tim Ketersediaan -->
        <div class="row gy-4 mb-5" data-aos="fade-up">
            <div class="col-lg-12">
                <h3 class="text-black">3. Ketua Tim Ketersediaan</h3>
            </div>
            <div class="col-lg-6 content">
                <h5 class="fw-bold">Tugas:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-warning"></i> Memastikan ketersediaan pasokan bahan pokok dan
                        penting di wilayah kerja.</li>
                    <li><i class="bi bi-check2-circle text-warning"></i> Menyusun proyeksi kebutuhan dan distribusi pasokan.
                    </li>
                    <li><i class="bi bi-check2-circle text-warning"></i> Melakukan koordinasi dengan distributor, gudang,
                        dan UPTD.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h5 class="fw-bold">Wewenang:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-warning"></i> Mengatur perencanaan distribusi logistik bahan
                        pokok.</li>
                    <li><i class="bi bi-check2-circle text-warning"></i> Memberikan usulan penyediaan bahan kebutuhan
                        mendesak.</li>
                </ul>
            </div>
        </div>

        <!-- 4. Ketua Tim Pengawasan -->
        <div class="row gy-4 mb-5" data-aos="fade-up">
            <div class="col-lg-12">
                <h3 class="text-black">4. Ketua Tim Pengawasan</h3>
            </div>
            <div class="col-lg-6 content">
                <h5 class="fw-bold">Tugas:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-danger"></i> Melakukan pengawasan terhadap distribusi,
                        ketersediaan, dan harga bahan pokok.</li>
                    <li><i class="bi bi-check2-circle text-danger"></i> Melakukan inspeksi dan sidak ke pasar atau wilayah
                        distribusi.</li>
                    <li><i class="bi bi-check2-circle text-danger"></i> Menyusun laporan hasil pengawasan.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h5 class="fw-bold">Wewenang:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-danger"></i> Menindaklanjuti pelanggaran regulasi dalam
                        distribusi bahan pokok.</li>
                    <li><i class="bi bi-check2-circle text-danger"></i> Memberikan rekomendasi sanksi administratif bila
                        diperlukan.</li>
                </ul>
            </div>
        </div>

        <!-- 5. Staf Pelaksana -->
        <div class="row gy-4 mb-5" data-aos="fade-up">
            <div class="col-lg-12">
                <h3 class="text-black">5. Staf Pelaksana (setiap tim)</h3>
            </div>
            <div class="col-lg-6 content">
                <h5 class="fw-bold">Tugas:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-secondary"></i> Membantu ketua tim dalam pelaksanaan tugas
                        teknis.</li>
                    <li><i class="bi bi-check2-circle text-secondary"></i> Melakukan pendataan, pemantauan lapangan, dan
                        pelaporan kegiatan.</li>
                    <li><i class="bi bi-check2-circle text-secondary"></i> Menjalankan tugas sesuai pembagian kerja dalam
                        tim.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h5 class="fw-bold">Wewenang:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-secondary"></i> Mengakses data operasional dan melakukan
                        pelaporan ke ketua tim.</li>
                    <li><i class="bi bi-check2-circle text-secondary"></i> Melakukan kunjungan lapangan atas nama tim.</li>
                </ul>
            </div>
        </div>

        <!-- 6. Administrasi -->
        <div class="row gy-4 mb-5" data-aos="fade-up">
            <div class="col-lg-12">
                <h3 class="text-dark">6. Administrasi (setiap tim)</h3>
            </div>
            <div class="col-lg-6 content">
                <h5 class="fw-bold">Tugas:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-info"></i> Mengelola dokumen, surat-menyurat, dan laporan
                        kegiatan.</li>
                    <li><i class="bi bi-check2-circle text-info"></i> Menyusun arsip dan dokumentasi kegiatan tim.</li>
                    <li><i class="bi bi-check2-circle text-info"></i> Membantu urusan teknis administrasi harian tim.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h5 class="fw-bold">Wewenang:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-info"></i> Mengelola sistem arsip internal dan akses data
                        administratif.</li>
                    <li><i class="bi bi-check2-circle text-info"></i> Mengatur jadwal dan logistik rapat/kegiatan tim.</li>
                </ul>
            </div>
        </div>

        <!-- 7. Kepala UPTD Wilayah -->
        <div class="row gy-4 mb-5" data-aos="fade-up">
            <div class="col-lg-12">
                <h3 class="text-dark">7. Kepala UPTD Wilayah I - IX</h3>
            </div>
            <div class="col-lg-6 content">
                <h5 class="fw-bold">Tugas:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-dark"></i> Melaksanakan kebijakan bidang Bapokting di
                        masing-masing wilayah.</li>
                    <li><i class="bi bi-check2-circle text-dark"></i> Mengawasi distribusi, harga, dan ketersediaan bahan
                        pokok di wilayahnya.</li>
                    <li><i class="bi bi-check2-circle text-dark"></i> Melaporkan data dan kondisi wilayah ke kantor
                        pusat/Bidang Bapokting.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h5 class="fw-bold">Wewenang:</h5>
                <ul>
                    <li><i class="bi bi-check2-circle text-dark"></i> Mengambil tindakan teknis di lapangan sesuai arahan
                        pusat.</li>
                    <li><i class="bi bi-check2-circle text-dark"></i> Melakukan koordinasi dengan instansi dan stakeholder
                        wilayah.</li>
                </ul>
            </div>
        </div>

    </div>
@endsection
