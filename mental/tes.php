<?php
/* ======================================================
   MENTAL HEALTH MODULE - HALAMAN TES (SRQ-29)
   ------------------------------------------------------
   Fungsi  : Form input + proses jawaban
   Flow    : tes → hasil
   Storage : Session only (tanpa DB)
   ====================================================== */

session_start();

/* ================================
   LOAD DEPENDENCIES
================================ */
require_once __DIR__ . '/config/srq29_questions.php';
require_once __DIR__ . '/logic/scoring.php';


/* ================================
   PROSES SUBMIT
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama   = trim($_POST['nama'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $umur   = intval($_POST['umur'] ?? 0);

    $jawaban = [];

    // ambil 29 jawaban
    for ($i = 1; $i <= 29; $i++) {
        $jawaban[$i] = isset($_POST["q$i"]) ? intval($_POST["q$i"]) : 0;
    }

    // validasi sederhana
    if ($nama !== '' && $gender !== '' && $umur > 0) {

        // hitung skor (dari logic/scoring.php)
        $hasil = hitungSkorSRQ29($jawaban);

        // simpan ke session
        $_SESSION['srq29'] = [
            'nama'     => $nama,
            'gender'   => $gender,
            'umur'     => $umur,
            'tanggal'  => date('Y-m-d H:i:s'),
            'jawaban'  => $jawaban,
            'hasil'    => $hasil
        ];

        // redirect ke hasil
        header("Location: hasil.php");
        exit;
    }
}


/* ================================
   VIEW
================================ */
include '../header.php';
?>

<link rel="stylesheet" href="/mental/assets/css/psikotes.css">

<section class="container" style="padding:60px 0;">

    <div class="ps-card">

        <h2 class="ps-title">Form Tes SRQ-29</h2>


        <!-- =======================================
             FORM
        ======================================== -->
        <form method="POST">


            <!-- ===============================
                 DATA PESERTA
            ================================ -->
            <div class="ps-section">
                <h3>Data Peserta</h3>

                <div class="ps-grid-3">

                    <div>
                        <label>Nama</label>
                        <input type="text" name="nama" required>
                    </div>

                    <div>
                        <label>Jenis Kelamin</label>
                        <select name="gender" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label>Umur</label>
                        <input type="number" name="umur" min="1" required>
                    </div>

                </div>
            </div>


            <!-- ===============================
                 SOAL SRQ-29
            ================================ -->
            <div class="ps-section">
                <h3>Pertanyaan</h3>

                <?php foreach ($questions as $no => $pertanyaan): ?>
                    <div class="ps-question">

                        <span class="ps-q-text">
                            <?= $no . '. ' . htmlspecialchars($pertanyaan) ?>
                        </span>

                        <div class="ps-radio-group">
                            <label>
                                <input type="radio" name="q<?= $no ?>" value="1" required>
                                Ya
                            </label>

                            <label>
                                <input type="radio" name="q<?= $no ?>" value="0">
                                Tidak
                            </label>
                        </div>

                    </div>
                <?php endforeach; ?>

            </div>


            <!-- ===============================
                 DISCLAIMER
            ================================ -->
            <div class="ps-warning" style="margin-top:20px;">
                Tes ini merupakan alat skrining awal, bukan diagnosis medis.
                Jika hasil menunjukkan indikasi gangguan, silakan berkonsultasi dengan tenaga profesional.
            </div>


            <!-- ===============================
                 SUBMIT BUTTON
            ================================ -->
            <div style="text-align:center; margin-top:30px;">
                <button type="submit" class="ps-btn-primary">
                    Lihat Hasil
                </button>
            </div>

        </form>

    </div>

</section>

<?php include '../footer.php'; ?>
