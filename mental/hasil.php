<?php
session_start();

if (!isset($_SESSION['srq29'])) {
    header("Location: index.php");
    exit;
}

$data  = $_SESSION['srq29'];
$hasil = $data['hasil'];


/* =====================================================
   MAPPING TEKS (TANPA ANGKA)
   ===================================================== */

function interpretEmosional($n) {
    return ($n >= 6)
        ? "Cenderung mengalami kecemasan/depresi"
        : "Dalam batas normal";
}

function interpretAdiksi($n) {
    return ($n >= 1)
        ? "Mengarah ke penggunaan zat Napza/Alkohol"
        : "Tidak terindikasi";
}

function interpretPsikotik($n) {
    return ($n >= 1)
        ? "Mengarah gejala Psikosis"
        : "Tidak terindikasi";
}

function interpretPTSD($n) {
    return ($n >= 3)
        ? "Mengarah adanya PTSD"
        : "Tidak terindikasi";
}


/* =====================================================
   VIEW
   ===================================================== */
include '../header.php';
?>

<link rel="stylesheet" href="/mental/assets/css/psikotes.css">

<section class="container" style="padding:60px 0;">

    <div class="ps-card">

        <!-- ===============================
             DATA PESERTA
        =============================== -->
        <h3 style="margin-bottom:15px;">Data Peserta</h3>

        <table class="ps-table-info">
            <tr>
                <td>Tanggal</td>
                <td><?= date('d M Y (H:i)', strtotime($data['tanggal'])) ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><?= htmlspecialchars($data['nama']) ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><?= htmlspecialchars($data['gender']) ?></td>
            </tr>
            <tr>
                <td>Umur</td>
                <td><?= htmlspecialchars($data['umur']) ?> tahun</td>
            </tr>
        </table>


        <!-- ===============================
             JUDUL TES
        =============================== -->
        <div class="ps-result-title">
            Tes Kesehatan Mental<br>(SRQ-29)
        </div>


        <!-- ===============================
             TABEL HASIL (TANPA ANGKA)
        =============================== -->
       <div class="ps-table-scroll">

        </div> <table class="ps-table-hasil">

            <thead>
                <tr>
                    <th>Domain</th>
                    <th>Hasil</th>
                </tr>
            </thead>

            <tbody>

            <tr>
                <td>CEMAS / DEPRESI</td>
                <td>
                    <span class="ps-badge <?= ($hasil['emosional'] >= 6 ? 'ps-badge-risk' : 'ps-badge-normal') ?>">
                        <?= interpretEmosional($hasil['emosional']) ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td>ALKOHOL / NAPZA</td>
                <td>
                    <span class="ps-badge <?= ($hasil['adiksi'] >= 1 ? 'ps-badge-risk' : 'ps-badge-normal') ?>">
                        <?= interpretAdiksi($hasil['adiksi']) ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td>PSIKOSIS</td>
                <td>
                    <span class="ps-badge <?= ($hasil['psikotik'] >= 1 ? 'ps-badge-risk' : 'ps-badge-normal') ?>">
                        <?= interpretPsikotik($hasil['psikotik']) ?>
                    </span>
                </td>
            </tr>

            <tr>
                <td>PTSD</td>
                <td>
                    <span class="ps-badge <?= ($hasil['ptsd'] >= 3 ? 'ps-badge-risk' : 'ps-badge-normal') ?>">
                        <?= interpretPTSD($hasil['ptsd']) ?>
                    </span>
                </td>
            </tr>

            </tbody>


        </table>


        <!-- ===============================
             ACTION BUTTON
        =============================== -->
        <div style="text-align:center; margin-top:35px;">
            <a href="cetak.php" class="ps-btn-primary">Download PDF</a>
        </div>

    </div>

</section>

<?php include '../footer.php'; ?>
