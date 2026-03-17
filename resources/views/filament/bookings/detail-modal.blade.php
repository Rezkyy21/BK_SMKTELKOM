<div style="font-size:14px;">

    <!-- CARD DATA SISWA -->
    <div style="
        border:1px solid #e5e7eb;
        border-radius:10px;
        padding:16px;
        margin-bottom:14px;
   
    ">

        <p style="font-weight:600; margin-bottom:10px;">
            Informasi Siswa
        </p>

        <div style="line-height:1.7">

            <p>
                <strong>Nama :</strong>
                {{ $booking->siswa?->nama ?? $booking->siswa?->user?->name ?? '-' }}
            </p>

           <p>
           @php
                $kelas = $booking->siswa->kelas ?? null;
            @endphp

            <p>
                <strong>Kelas:</strong>
                {{
                    $kelas
                    ? ($kelas->grade_level . ' ' . ($kelas->major->name ?? '-') . ' ' . $kelas->name)
                    : '-'
                }}
            </p>

            <p>
                <strong>Waktu :</strong>
                {{ $booking->jadwal?->jam_mulai 
                    ? substr($booking->jadwal->jam_mulai,0,5) . ' - ' . substr($booking->jadwal->jam_selesai,0,5) 
                    : '-' }}
            </p>

            <p>
                <strong>Topik :</strong>
                {{ $booking->topik?->nama_topik ?? '-' }}
            </p>

        </div>

    </div>


    <!-- CARD MASALAH -->
    <div style="
        border:1px solid #e5e7eb;
        border-radius:10px;
        padding:16px;
    ">

        <p style="
            font-weight:600;
            margin-bottom:10px;
        ">
            Masalah yang Disampaikan
        </p>

        <div style="
            border:1px solid #e5e7eb;
            border-radius:8px;
            padding:12px;
            max-height:200px;
            overflow:auto;
            line-height:1.6;
            word-break:break-word;
            overflow-wrap:anywhere;
        ">
            {{ $booking->catatan_siswa ?? '-' }}
        </div>

    </div>

</div>