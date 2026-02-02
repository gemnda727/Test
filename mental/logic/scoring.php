<?php
/* ======================================================
   SCORING SRQ-29
   Menghitung skor + kategori indikasi
   ====================================================== */

function hitungSkorSRQ29($jawaban)
{
    /*
        $jawaban format:
        [
            1 => 1/0,
            2 => 1/0,
            ...
            29 => 1/0
        ]
    */

    // =========================
    // HITUNG PER DOMAIN
    // =========================
    $emosional = 0;
    for ($i = 1; $i <= 20; $i++) {
        $emosional += $jawaban[$i];
    }

    $adiksi = $jawaban[21];

    $psikotik = 0;
    for ($i = 22; $i <= 24; $i++) {
        $psikotik += $jawaban[$i];
    }

    $ptsd = 0;
    for ($i = 25; $i <= 29; $i++) {
        $ptsd += $jawaban[$i];
    }

    $total = array_sum($jawaban);


    // =========================
    // INTERPRETASI SEDERHANA
    // =========================
    $indikasi = [];

    if ($emosional >= 6) {
        $indikasi[] = "Gangguan mental emosional (cemas/depresi)";
    }

    if ($adiksi >= 1) {
        $indikasi[] = "Risiko penyalahgunaan zat / alkohol";
    }

    if ($psikotik >= 1) {
        $indikasi[] = "Gejala psikotik (perlu evaluasi profesional)";
    }

    if ($ptsd >= 3) {
        $indikasi[] = "Gejala PTSD (trauma)";
    }

    if (empty($indikasi)) {
        $indikasi[] = "Tidak ditemukan indikasi bermakna";
    }


    // =========================
    // RETURN DATA TERSTRUKTUR
    // =========================
    return [
        'total' => $total,
        'emosional' => $emosional,
        'adiksi' => $adiksi,
        'psikotik' => $psikotik,
        'ptsd' => $ptsd,
        'indikasi' => $indikasi
    ];
}
