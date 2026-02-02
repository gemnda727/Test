<?php
/* ======================================================
   MENTAL HEALTH MODULE - LANDING PAGE
   SRQ-29 Screening
   ------------------------------------------------------
   Fungsi  : Halaman pembuka psikotes
   Akses   : /mental/
   Flow    : index → tes.php
   ====================================================== */
?>
<?php include 'header.php'; ?>

<!-- CSS khusus modul psikotes -->
<link rel="stylesheet" href="assets/css/psikotes.css">
<link rel="stylesheet" href="style.css">


<section class="mental-hero-section">

    <div class="container">

        <!-- ===============================
             CARD UTAMA
        ================================ -->
        <div class="ps-card ps-hero-card">

            <!-- Judul -->
            <h1 class="ps-title text-center">
                Tes Kesehatan Mental (SRQ-29)
            </h1>

            <!-- Subjudul -->
            <p class="ps-subtitle text-center">
                Skrining mandiri berbasis <strong>Self Reporting Questionnaire (WHO)</strong>  
                untuk membantu mendeteksi dini kondisi kesehatan mental Anda.
            </p>


            <!-- ===============================
                 INFORMASI UMUM TES
            ================================ -->
            <div class="ps-info-grid">

                <div class="ps-info-item">
                    <span class="ps-info-icon">📝</span>
                    <div>
                        <strong>29 Pertanyaan</strong>
                        <p>Jawaban Ya / Tidak</p>
                    </div>
                </div>

                <div class="ps-info-item">
                    <span class="ps-info-icon">⏱</span>
                    <div>
                        <strong>± 5 Menit</strong>
                        <p>Waktu pengerjaan singkat</p>
                    </div>
                </div>

                <div class="ps-info-item">
                    <span class="ps-info-icon">🔒</span>
                    <div>
                        <strong>Privat</strong>
                        <p>Hasil hanya di perangkat Anda</p>
                    </div>
                </div>

            </div>


            <!-- ===============================
                 DOMAIN YANG DINILAI
            ================================ -->
            <div class="ps-domain-box">

                <h3>Apa yang dinilai pada tes ini?</h3>

                <ul class="ps-domain-list">
                    <li>Gangguan Mental Emosional (cemas/depresi)</li>
                    <li>Gangguan Adiksi (NAPZA/alkohol)</li>
                    <li>Gejala Psikotik</li>
                    <li>Post Traumatic Stress Disorder (PTSD)</li>
                </ul>

            </div>


            <!-- ===============================
                 DISCLAIMER SINGKAT
            ================================ -->
            <div class="ps-warning">
                Tes ini <strong>bukan diagnosis medis</strong>, melainkan skrining awal.  
                Jika hasil menunjukkan indikasi gangguan, disarankan berkonsultasi dengan tenaga profesional.
            </div>


            <!-- ===============================
                 CTA BUTTON
            ================================ -->
            <div class="text-center" style="margin-top:35px;">
                <a href="tes.php" class="ps-btn-primary">
                    Mulai Tes Sekarang
                </a>
            </div>

        </div>

    </div>

</section>


<?php include 'footer.php'; ?>