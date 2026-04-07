<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Konseling</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: #fff;
    color: #222;
}

/* PAGE */
.page {
    width: 210mm;
    min-height: 297mm;
    padding: 20mm;
}

/* HEADER */
.header {
    text-align: center;
    border-bottom: 2px solid #000;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.header h1 {
    font-size: 18px;
    letter-spacing: 1px;
}

.header p {
    font-size: 12px;
    color: #555;
}

/* INFO BAR */
.info-bar {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 11px;
}

.badge {
    border: 1px solid #000;
    padding: 3px 10px;
    font-weight: bold;
}

/* SECTION */
.section {
    margin-bottom: 15px;
}

.section-title {
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 6px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 3px;
}

/* TABLE STYLE */
.table {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
}

.table td {
    padding: 6px 4px;
    vertical-align: top;
}

.table td:first-child {
    width: 140px;
    color: #666;
}

/* BOX TEXT */
.box {
    border: 1px solid #ccc;
    padding: 10px;
    min-height: 70px;
    line-height: 1.6;
    text-align: justify;
}

/* GRID */
.grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

/* FOOTER */
.footer {
    margin-top: 30px;
    font-size: 11px;
    display: flex;
    justify-content: space-between;
}

.signature {
    text-align: center;
    margin-top: 50px;
}

/* PRINT */
@media print {
    @page {
        size: A4;
        margin: 0;
    }
}
</style>
</head>

<body>

<div class="page">

    <!-- HEADER -->
    <div class="header">
        <h1>SMK Telkom Purwokerto</h1>
        <p>Laporan Konseling Siswa</p>
    </div>

    <!-- INFO -->
    <div class="info-bar">
        <div>
            Tanggal: {{ $laporan->created_at?->format('d M Y') ?? '-' }}
        </div>
        <div class="badge">
            {{ $laporan->status ?? 'Draft' }}
        </div>
    </div>

    <!-- DATA SISWA -->
    <div class="section">
        <div class="section-title">Data Siswa</div>
        <table class="table">
            <tr>
                <td>Nama</td>
                <td>: {{ $laporan->nama_siswa ?? ($laporan->siswa?->nama ?? '-') }}</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>: {{ $laporan->nis ?? ($laporan->siswa?->nis ?? '-') }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: {{ $laporan->kelas ?? ($laporan->siswa?->classRoom?->full_name ?? '-') }}</td>
            </tr>
            <tr>
                <td>Guru BK</td>
                <td>: {{ $laporan->nama_guru ?? ($laporan->guru?->nama ?? '-') }}</td>
            </tr>
            <tr>
                <td>Topik</td>
                <td>: {{ $laporan->topik ?? $laporan->booking?->topik?->nama_topik ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- DETAIL SESI -->
    <div class="section">
        <div class="section-title">Detail Sesi</div>
        <table class="table">
            <tr>
                <td>Metode</td>
                <td>: {{ $laporan->metode_konseling ?? '-' }}</td>
            </tr>
            <tr>
                <td>Durasi</td>
                <td>: {{ $laporan->durasi ? $laporan->durasi . ' menit' : '-' }}</td>
            </tr>
            <tr>
                <td>Jadwal</td>
                <td>
                    :
                    @if(!empty($laporan->jadwal))
                        {{ $laporan->jadwal }}
                    @elseif($laporan->booking?->jadwal)
                        {{ $laporan->booking->jadwal->hari }},
                        {{ substr($laporan->booking->jadwal->jam_mulai,0,5) }}
                        - 
                        {{ substr($laporan->booking->jadwal->jam_selesai,0,5) }}
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <!-- ISI -->
    <div class="section">
        <div class="section-title">Isi Laporan</div>

        <div class="box">
            <b>Catatan Sesi:</b><br>
            {{ $laporan->catatan_sesi ?? '-' }}
        </div>

        <br>

        <div class="grid-2">
            <div class="box">
                <b>Assessment:</b><br>
                {{ $laporan->diagnosis ?? '-' }}
            </div>

            <div class="box">
                <b>Kesimpulan:</b><br>
                {{ $laporan->kesimpulan ?? '-' }}
            </div>
        </div>
    </div>

    <!-- TINDAK LANJUT -->
    <div class="section">
        <div class="section-title">Tindak Lanjut</div>
        <div class="box">
            {{ $laporan->tindak_lanjut ?? '-' }}
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <div>
            Dicetak: {{ now()->format('d M Y H:i') }}
        </div>
        <div class="signature">
            Guru BK<br><br><br>
            __________________
        </div>
    </div>

</div>

</body>
</html>