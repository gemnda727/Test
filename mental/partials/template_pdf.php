<?php
$logoPath = __DIR__ . '/../assets/img/logo.png';
$logoBase64 = base64_encode(file_get_contents($logoPath));
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:13px;
    color:#333;
}

/* ===============================
   HEADER
================================ */
.header{
    width:100%;
    border-bottom:1px solid #ddd;
    padding-bottom:12px;
    margin-bottom:20px;
}

.header-table{
    width:100%;
}

.logo{
    height:60px;
}

.header-right{
    text-align:right;
    font-size:12px;
    line-height:1.4;
}

/* ===============================
   TITLE
================================ */
.main-title{
    text-align:center;
    font-size:20px;
    font-weight:bold;
    margin:15px 0 4px;
}

.sub-title{
    text-align:center;
    font-size:11px;
    color:#666;
    margin-bottom:20px;
}

/* ===============================
   DATA PESERTA
================================ */
.section-title{
    font-weight:bold;
    color:#005b8f;
    margin-bottom:8px;
}

.info-table{
    width:100%;
    border-collapse:collapse;
    margin-bottom:18px;
}

.info-table td{
    padding:4px 0;
}

/* ===============================
   CARD TITLE
================================ */
.card-title{
    background:#005b8f;
    color:white;
    padding:12px;
    border-radius:8px;
    text-align:center;
    font-weight:bold;
    margin:15px 0;
}

/* ===============================
   TABLE HASIL
================================ */
.table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

.table th{
    background:#005b8f;
    color:white;
    padding:10px;
    text-align:left;
}

.table td{
    padding:10px;
    border-bottom:1px solid #ddd;
}

/* ===============================
   BADGE
================================ */
.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:11px;
}

.normal{
    background:#e6f7ed;
    color:#1b7f3b;
}

.risk{
    background:#fdeaea;
    color:#b42318;
}

/* ===============================
   EMERGENCY
================================ */
.emergency{
    margin-top:20px;
    font-size:12px;
}

.emergency strong{
    color:#b42318;
}

/* ===============================
   DISCLAIMER
================================ */
.disclaimer{
    margin-top:18px;
    font-size:11px;
    color:#555;
    border-top:1px solid #ddd;
    padding-top:10px;
}

/* ===============================
   FOOTER
================================ */
.footer{
    margin-top:20px;
    text-align:center;
    font-size:10px;
    color:#888;
}

</style>
</head>

<body>

<!-- ===============================
     HEADER (TABLE LAYOUT — DOMPDF SAFE)
================================ -->
<div class="header">

<table class="header-table">
<tr>

<td width="120">
<?php if($logoBase64): ?>
<img src="data:image/png;base64,<?= $logoBase64 ?>" class="logo">
<?php endif; ?>
</td>

<td class="header-right">
<strong>Skrining Kesehatan Mental Online</strong><br>
RSU Brimedika Malang<br>
Jl. Mayjend Panjaitan No.176, Malang
</td>

</tr>
</table>

</div>


<!-- TITLE -->
<div class="main-title">HASIL PSIKOTES</div>
<div class="sub-title">Self Assessment | Evidence Based | Free</div>


<!-- DATA PESERTA -->
<div class="section-title">Data Peserta</div>

<table class="info-table">
<tr><td width="120">Tanggal</td><td>: <?= date('d M Y (H:i)', strtotime($data['tanggal'])) ?></td></tr>
<tr><td>Nama</td><td>: <?= htmlspecialchars($data['nama']) ?></td></tr>
<tr><td>Gender</td><td>: <?= htmlspecialchars($data['gender']) ?></td></tr>
<tr><td>Umur</td><td>: <?= htmlspecialchars($data['umur']) ?> tahun</td></tr>
</table>


<!-- CARD TITLE -->
<div class="card-title">
Tes Kesehatan Mental (SRQ-29)
</div>


<!-- TABLE HASIL -->
<table class="table">
<thead>
<tr>
<th>Domain</th>
<th>Hasil</th>
</tr>
</thead>

<tbody>

<tr>
<td>CEMAS / DEPRESI</td>
<td><span class="badge <?= ($hasil['emosional']>=6?'risk':'normal') ?>"><?= interpretEmosional($hasil['emosional']) ?></span></td>
</tr>

<tr>
<td>ALKOHOL / NAPZA</td>
<td><span class="badge <?= ($hasil['adiksi']>=1?'risk':'normal') ?>"><?= interpretAdiksi($hasil['adiksi']) ?></span></td>
</tr>

<tr>
<td>PSIKOSIS</td>
<td><span class="badge <?= ($hasil['psikotik']>=1?'risk':'normal') ?>"><?= interpretPsikotik($hasil['psikotik']) ?></span></td>
</tr>

<tr>
<td>PTSD</td>
<td><span class="badge <?= ($hasil['ptsd']>=3?'risk':'normal') ?>"><?= interpretPTSD($hasil['ptsd']) ?></span></td>
</tr>

</tbody>
</table>


<!-- EMERGENCY -->
<div class="emergency">
<strong>Emergensi:</strong><br>
RSU Brimedika Malang<br>
(0341) 580099
</div>


<!-- DISCLAIMER -->
<div class="disclaimer">
• Tes ini bukan diagnosis medis.<br>
• Jika hasil menunjukkan indikasi gangguan, silakan konsultasi tenaga profesional.<br>
• Hasil bersifat pribadi dan tidak disimpan di sistem.
</div>


<!-- FOOTER -->
<div class="footer">
© RSU Brimedika Malang <?= date('Y') ?>
</div>

</body>
</html>
