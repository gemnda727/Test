<?php
session_start();

if (!isset($_SESSION['srq29'])) {
    header("Location: index.php");
    exit;
}

$data  = $_SESSION['srq29'];
$hasil = $data['hasil'];


/* ======================================================
   MAPPING TEKS
====================================================== */

function interpretEmosional($n){
    return ($n >= 6) ? "Cenderung mengalami kecemasan/depresi" : "Dalam batas normal";
}
function interpretAdiksi($n){
    return ($n >= 1) ? "Mengarah ke penggunaan zat Napza/Alkohol" : "Tidak terindikasi";
}
function interpretPsikotik($n){
    return ($n >= 1) ? "Mengarah gejala Psikosis" : "Tidak terindikasi";
}
function interpretPTSD($n){
    return ($n >= 3) ? "Mengarah adanya PTSD" : "Tidak terindikasi";
}


/* ======================================================
   RENDER HTML TEMPLATE
====================================================== */

ob_start();
include __DIR__ . '/partials/template_pdf.php';
$html = ob_get_clean();


/* ======================================================
   DOMPDF CONFIG (FIX LOGO ISSUE)
====================================================== */

require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();

/* 🔥 WAJIB biar gambar/logo kebaca */
$options->set('isRemoteEnabled', true);

/* parser lebih stabil */
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream("hasil-psikotes.pdf", [
    "Attachment" => false
]);
exit;
