<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use App\Models\TemplateSurat;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    public function run(): void
    {
        $jenisSuratList = [

            // ── MAHASISWA ─────────────────────────────────────────
            [
                'nama'          => 'Surat Keterangan Aktif Kuliah',
                'kode'          => 'SKAK',
                'deskripsi'     => 'Surat keterangan bahwa mahasiswa sedang aktif kuliah pada semester berjalan.',
                'role_pemohon'  => 'mahasiswa',
                'penandatangan' => 'wadek',
                'sla_hari'      => 1,
                'persyaratan'   => ['KTM / Kartu Tanda Mahasiswa'],
                'field_form'    => [
                    ['name' => 'keperluan', 'label' => 'Keperluan Surat',  'type' => 'text',     'required' => true],
                    ['name' => 'tujuan',    'label' => 'Ditujukan Kepada', 'type' => 'text',     'required' => true],
                    ['name' => 'catatan',   'label' => 'Keterangan Tambahan', 'type' => 'textarea', 'required' => false],
                ],
                'template_html' => $this->templateSKAK(),
            ],
            [
                'nama'          => 'Surat Pengantar PKL / Magang',
                'kode'          => 'PKL',
                'deskripsi'     => 'Surat pengantar untuk keperluan praktik kerja lapangan atau magang.',
                'role_pemohon'  => 'mahasiswa',
                'penandatangan' => 'dekan',
                'sla_hari'      => 2,
                'persyaratan'   => [
                    'KTM / Kartu Tanda Mahasiswa',
                    'Surat balasan / undangan dari instansi (jika ada)',
                ],
                'field_form'    => [
                    ['name' => 'nama_instansi',   'label' => 'Nama Instansi / Perusahaan', 'type' => 'text',     'required' => true],
                    ['name' => 'alamat_instansi', 'label' => 'Alamat Instansi',            'type' => 'textarea', 'required' => true],
                    ['name' => 'tanggal_mulai',   'label' => 'Tanggal Mulai PKL',          'type' => 'date',     'required' => true],
                    ['name' => 'tanggal_selesai', 'label' => 'Tanggal Selesai PKL',        'type' => 'date',     'required' => true],
                    ['name' => 'catatan',         'label' => 'Keterangan Tambahan',        'type' => 'textarea', 'required' => false],
                ],
                'template_html' => $this->templatePKL(),
            ],
            [
                'nama'          => 'Surat Pengantar Penelitian',
                'kode'          => 'PENELITIAN',
                'deskripsi'     => 'Surat pengantar untuk keperluan penelitian skripsi atau tugas akhir.',
                'role_pemohon'  => 'mahasiswa',
                'penandatangan' => 'dekan',
                'sla_hari'      => 2,
                'persyaratan'   => [
                    'KTM / Kartu Tanda Mahasiswa',
                    'Lembar persetujuan judul dari dosen pembimbing',
                ],
                'field_form'    => [
                    ['name' => 'judul_penelitian', 'label' => 'Judul Penelitian / TA', 'type' => 'text',     'required' => true],
                    ['name' => 'nama_instansi',    'label' => 'Nama Instansi Tujuan',  'type' => 'text',     'required' => true],
                    ['name' => 'alamat_instansi',  'label' => 'Alamat Instansi',       'type' => 'textarea', 'required' => true],
                    ['name' => 'nama_pembimbing',  'label' => 'Nama Dosen Pembimbing', 'type' => 'text',     'required' => true],
                    ['name' => 'catatan',          'label' => 'Keterangan Tambahan',   'type' => 'textarea', 'required' => false],
                ],
                'template_html' => $this->templatePenelitian(),
            ],
            [
                'nama'          => 'Surat Rekomendasi Beasiswa',
                'kode'          => 'BEASISWA',
                'deskripsi'     => 'Surat rekomendasi untuk keperluan pendaftaran beasiswa.',
                'role_pemohon'  => 'mahasiswa',
                'penandatangan' => 'dekan',
                'sla_hari'      => 3,
                'persyaratan'   => [
                    'KTM / Kartu Tanda Mahasiswa',
                    'Transkrip nilai terbaru',
                    'Surat keterangan tidak mampu (jika beasiswa ekonomi)',
                ],
                'field_form'    => [
                    ['name' => 'nama_beasiswa',    'label' => 'Nama Beasiswa',               'type' => 'text',     'required' => true],
                    ['name' => 'penyelenggara',    'label' => 'Penyelenggara Beasiswa',       'type' => 'text',     'required' => true],
                    ['name' => 'prestasi',         'label' => 'Prestasi / Pencapaian',        'type' => 'textarea', 'required' => false],
                    ['name' => 'catatan',          'label' => 'Keterangan Tambahan',          'type' => 'textarea', 'required' => false],
                ],
                'template_html' => $this->templateBeasiswa(),
            ],

            // ── DOSEN ─────────────────────────────────────────────
            [
                'nama'          => 'Surat Tugas',
                'kode'          => 'ST-DOSEN',
                'deskripsi'     => 'Surat tugas dosen untuk menghadiri kegiatan seminar, rapat, atau kegiatan lainnya.',
                'role_pemohon'  => 'dosen',
                'penandatangan' => 'dekan',
                'sla_hari'      => 1,
                'persyaratan'   => ['Undangan / surat dari penyelenggara kegiatan'],
                'field_form'    => [
                    ['name' => 'nama_kegiatan',   'label' => 'Nama Kegiatan',          'type' => 'text',     'required' => true],
                    ['name' => 'penyelenggara',   'label' => 'Penyelenggara',           'type' => 'text',     'required' => true],
                    ['name' => 'tempat',          'label' => 'Tempat Kegiatan',         'type' => 'text',     'required' => true],
                    ['name' => 'tanggal_mulai',   'label' => 'Tanggal Mulai',           'type' => 'date',     'required' => true],
                    ['name' => 'tanggal_selesai', 'label' => 'Tanggal Selesai',         'type' => 'date',     'required' => true],
                    ['name' => 'catatan',         'label' => 'Keterangan Tambahan',     'type' => 'textarea', 'required' => false],
                ],
                'template_html' => $this->templateSuratTugas(),
            ],
            [
                'nama'          => 'Surat Perjalanan Dinas',
                'kode'          => 'SPD',
                'deskripsi'     => 'Surat perjalanan dinas untuk kegiatan luar kota atau luar negeri.',
                'role_pemohon'  => 'dosen',
                'penandatangan' => 'dekan',
                'sla_hari'      => 2,
                'persyaratan'   => [
                    'Undangan / surat dari penyelenggara',
                    'Rincian anggaran perjalanan',
                ],
                'field_form'    => [
                    ['name' => 'tujuan',          'label' => 'Kota / Negara Tujuan',   'type' => 'text',  'required' => true],
                    ['name' => 'nama_kegiatan',   'label' => 'Nama Kegiatan',          'type' => 'text',  'required' => true],
                    ['name' => 'tanggal_mulai',   'label' => 'Tanggal Berangkat',      'type' => 'date',  'required' => true],
                    ['name' => 'tanggal_selesai', 'label' => 'Tanggal Kembali',        'type' => 'date',  'required' => true],
                    ['name' => 'transportasi',    'label' => 'Moda Transportasi',      'type' => 'select','required' => true,
                        'options' => [
                            ['value' => 'darat',   'label' => 'Darat'],
                            ['value' => 'udara',   'label' => 'Udara'],
                            ['value' => 'laut',    'label' => 'Laut'],
                        ],
                    ],
                    ['name' => 'catatan', 'label' => 'Keterangan', 'type' => 'textarea', 'required' => false],
                ],
                'template_html' => $this->templateSPD(),
            ],

        ];

        foreach ($jenisSuratList as $data) {
            $templateHtml = $data['template_html'];
            unset($data['template_html']);

            $jenis = JenisSurat::firstOrCreate(
                ['kode' => $data['kode']],
                $data
            );

            // Buat template jika belum ada
            if ($jenis->templates()->count() === 0) {
                TemplateSurat::create([
                    'jenis_surat_id' => $jenis->id,
                    'konten_html'    => $templateHtml,
                    'variabel_list'  => $this->extractVariables($templateHtml),
                    'is_aktif'       => true,
                ]);
            }
        }
    }

    // ── Template HTML ────────────────────────────────────────────

    private function templateSKAK(): string
    {
        return '
        <div style="font-family: Times New Roman, serif; font-size: 12pt; padding: 40px;">
            <div style="text-align:center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
                <strong style="font-size:14pt;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</strong><br>
                <strong style="font-size:13pt;">UNIVERSITAS CONTOH</strong><br>
                <span>FAKULTAS TEKNIK</span><br>
                <small>Jl. Contoh No. 1, Kota, Provinsi | Telp. (021) 0000000</small>
            </div>

            <div style="text-align:center; margin-bottom: 20px;">
                <strong style="text-decoration:underline; font-size:13pt;">SURAT KETERANGAN AKTIF KULIAH</strong><br>
                Nomor: {{nomor_surat}}
            </div>

            <p>Yang bertanda tangan di bawah ini, Wakil Dekan Bidang Akademik Fakultas Teknik Universitas Contoh,
            menerangkan bahwa:</p>

            <table style="margin-left:40px; line-height:2;">
                <tr><td>Nama</td><td>: <strong>{{name}}</strong></td></tr>
                <tr><td>NIM</td><td>: {{nim}}</td></tr>
                <tr><td>Program Studi</td><td>: {{unit_kerja_nama}}</td></tr>
                <tr><td>Keperluan</td><td>: {{keperluan}}</td></tr>
            </table>

            <p>adalah benar mahasiswa aktif pada Semester Ganjil/Genap Tahun Akademik {{tahun_akademik}}
            di Fakultas Teknik Universitas Contoh.</p>

            <p>Surat keterangan ini dibuat untuk keperluan <strong>{{tujuan}}</strong>
            dan agar dapat dipergunakan sebagaimana mestinya.</p>

            {{catatan}}

            <div style="margin-top:40px; text-align:right;">
                <p>{{kota}}, {{tanggal}}</p>
                <p>Wakil Dekan Bidang Akademik,</p>
                <br><br>
                <div>{{tanda_tangan}}</div>
                <p><strong>{{nama_pejabat}}</strong></p>
                <p>NIP. {{nip_pejabat}}</p>
            </div>

            <div style="margin-top:20px; font-size:9pt; border-top:1px solid #ccc; padding-top:10px;">
                <p>Dokumen ini dapat diverifikasi melalui:</p>
                <div>{{qr_code}}</div>
                <p>Kode: {{kode_unik}}</p>
            </div>
        </div>';
    }

    private function templatePKL(): string
    {
        return '
        <div style="font-family: Times New Roman, serif; font-size: 12pt; padding: 40px;">
            <div style="text-align:center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
                <strong style="font-size:14pt;">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</strong><br>
                <strong style="font-size:13pt;">UNIVERSITAS CONTOH — FAKULTAS TEKNIK</strong><br>
                <small>Jl. Contoh No. 1, Kota | Telp. (021) 0000000</small>
            </div>

            <div style="text-align:center; margin-bottom:20px;">
                <strong style="text-decoration:underline; font-size:13pt;">SURAT PENGANTAR PRAKTIK KERJA LAPANGAN</strong><br>
                Nomor: {{nomor_surat}}
            </div>

            <p>Yth. Pimpinan<br>
            <strong>{{nama_instansi}}</strong><br>
            {{alamat_instansi}}</p>

            <p>Dengan hormat, kami sampaikan bahwa mahasiswa berikut:</p>

            <table style="margin-left:40px; line-height:2;">
                <tr><td>Nama</td><td>: <strong>{{name}}</strong></td></tr>
                <tr><td>NIM</td><td>: {{nim}}</td></tr>
                <tr><td>Program Studi</td><td>: {{unit_kerja_nama}}</td></tr>
                <tr><td>Periode PKL</td><td>: {{tanggal_mulai}} s.d. {{tanggal_selesai}}</td></tr>
            </table>

            <p>bermaksud melaksanakan Praktik Kerja Lapangan (PKL) di instansi/perusahaan yang Bapak/Ibu pimpin.
            Kami mohon kiranya dapat diberikan kesempatan kepada mahasiswa tersebut.</p>

            <p>Atas perhatian dan kerja sama yang baik, kami ucapkan terima kasih.</p>

            <div style="margin-top:40px; text-align:right;">
                <p>{{kota}}, {{tanggal}}</p>
                <p>Dekan Fakultas Teknik,</p>
                <br><br>
                <div>{{tanda_tangan}}</div>
                <p><strong>{{nama_pejabat}}</strong></p>
                <p>NIP. {{nip_pejabat}}</p>
            </div>

            <div style="margin-top:20px; font-size:9pt; border-top:1px solid #ccc; padding-top:10px;">
                {{qr_code}} <small>Verifikasi: {{kode_unik}}</small>
            </div>
        </div>';
    }

    private function templatePenelitian(): string
    {
        return '
        <div style="font-family: Times New Roman, serif; font-size: 12pt; padding: 40px;">
            <div style="text-align:center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
                <strong>UNIVERSITAS CONTOH — FAKULTAS TEKNIK</strong><br>
                <small>Jl. Contoh No. 1 | Telp. (021) 0000000</small>
            </div>
            <div style="text-align:center; margin-bottom:20px;">
                <strong style="text-decoration:underline;">SURAT PENGANTAR PENELITIAN</strong><br>
                Nomor: {{nomor_surat}}
            </div>
            <p>Yth. Pimpinan <strong>{{nama_instansi}}</strong><br>{{alamat_instansi}}</p>
            <p>Dengan hormat, mahasiswa kami:</p>
            <table style="margin-left:40px; line-height:2;">
                <tr><td>Nama</td><td>: <strong>{{name}}</strong></td></tr>
                <tr><td>NIM</td><td>: {{nim}}</td></tr>
                <tr><td>Judul Penelitian</td><td>: {{judul_penelitian}}</td></tr>
                <tr><td>Pembimbing</td><td>: {{nama_pembimbing}}</td></tr>
            </table>
            <p>bermaksud melakukan penelitian di instansi Bapak/Ibu untuk keperluan penyusunan Tugas Akhir/Skripsi.</p>
            <div style="margin-top:40px; text-align:right;">
                <p>{{kota}}, {{tanggal}}</p>
                <p>Dekan,</p><br><br>
                <div>{{tanda_tangan}}</div>
                <p><strong>{{nama_pejabat}}</strong></p>
                <p>NIP. {{nip_pejabat}}</p>
            </div>
            <div style="margin-top:10px; font-size:9pt;">{{qr_code}}</div>
        </div>';
    }

    private function templateBeasiswa(): string
    {
        return '
        <div style="font-family: Times New Roman, serif; font-size: 12pt; padding: 40px;">
            <div style="text-align:center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
                <strong>UNIVERSITAS CONTOH — FAKULTAS TEKNIK</strong>
            </div>
            <div style="text-align:center; margin-bottom:20px;">
                <strong style="text-decoration:underline;">SURAT REKOMENDASI BEASISWA</strong><br>
                Nomor: {{nomor_surat}}
            </div>
            <p>Yang bertanda tangan di bawah ini, Dekan Fakultas Teknik, dengan ini merekomendasikan:</p>
            <table style="margin-left:40px; line-height:2;">
                <tr><td>Nama</td><td>: <strong>{{name}}</strong></td></tr>
                <tr><td>NIM</td><td>: {{nim}}</td></tr>
                <tr><td>Program Studi</td><td>: {{unit_kerja_nama}}</td></tr>
            </table>
            <p>sebagai kandidat penerima <strong>{{nama_beasiswa}}</strong> yang diselenggarakan oleh
            <strong>{{penyelenggara}}</strong>. Mahasiswa tersebut merupakan mahasiswa berprestasi dan berkarakter baik.</p>
            <div style="margin-top:40px; text-align:right;">
                <p>{{kota}}, {{tanggal}}</p>
                <p>Dekan,</p><br><br>
                <div>{{tanda_tangan}}</div>
                <p><strong>{{nama_pejabat}}</strong></p>
                <p>NIP. {{nip_pejabat}}</p>
            </div>
            <div style="font-size:9pt;">{{qr_code}}</div>
        </div>';
    }

    private function templateSuratTugas(): string
    {
        return '
        <div style="font-family: Times New Roman, serif; font-size: 12pt; padding: 40px;">
            <div style="text-align:center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
                <strong>UNIVERSITAS CONTOH — FAKULTAS TEKNIK</strong>
            </div>
            <div style="text-align:center; margin-bottom:20px;">
                <strong style="text-decoration:underline;">SURAT TUGAS</strong><br>
                Nomor: {{nomor_surat}}
            </div>
            <p>Dekan Fakultas Teknik Universitas Contoh menugaskan:</p>
            <table style="margin-left:40px; line-height:2;">
                <tr><td>Nama</td><td>: <strong>{{name}}</strong></td></tr>
                <tr><td>NIDN</td><td>: {{nidn}}</td></tr>
                <tr><td>Jabatan</td><td>: Dosen Tetap</td></tr>
            </table>
            <p>untuk menghadiri / mengikuti kegiatan:</p>
            <table style="margin-left:40px; line-height:2;">
                <tr><td>Kegiatan</td><td>: <strong>{{nama_kegiatan}}</strong></td></tr>
                <tr><td>Penyelenggara</td><td>: {{penyelenggara}}</td></tr>
                <tr><td>Tempat</td><td>: {{tempat}}</td></tr>
                <tr><td>Tanggal</td><td>: {{tanggal_mulai}} s.d. {{tanggal_selesai}}</td></tr>
            </table>
            <p>Demikian surat tugas ini dibuat untuk dilaksanakan sebagaimana mestinya.</p>
            <div style="margin-top:40px; text-align:right;">
                <p>{{kota}}, {{tanggal}}</p>
                <p>Dekan,</p><br><br>
                <div>{{tanda_tangan}}</div>
                <p><strong>{{nama_pejabat}}</strong></p>
            </div>
            <div style="font-size:9pt;">{{qr_code}}</div>
        </div>';
    }

    private function templateSPD(): string
    {
        return '
        <div style="font-family: Times New Roman, serif; font-size: 12pt; padding: 40px;">
            <div style="text-align:center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
                <strong>UNIVERSITAS CONTOH — FAKULTAS TEKNIK</strong>
            </div>
            <div style="text-align:center; margin-bottom:20px;">
                <strong style="text-decoration:underline;">SURAT PERINTAH PERJALANAN DINAS</strong><br>
                Nomor: {{nomor_surat}}
            </div>
            <table style="width:100%; line-height:2; border-collapse:collapse;">
                <tr><td style="width:35%">Nama / NIDN</td><td>: <strong>{{name}}</strong> / {{nidn}}</td></tr>
                <tr><td>Tujuan</td><td>: {{tujuan}}</td></tr>
                <tr><td>Keperluan</td><td>: {{nama_kegiatan}}</td></tr>
                <tr><td>Tanggal Berangkat</td><td>: {{tanggal_mulai}}</td></tr>
                <tr><td>Tanggal Kembali</td><td>: {{tanggal_selesai}}</td></tr>
                <tr><td>Transportasi</td><td>: {{transportasi}}</td></tr>
            </table>
            <div style="margin-top:40px; text-align:right;">
                <p>{{kota}}, {{tanggal}}</p>
                <p>Dekan,</p><br><br>
                <div>{{tanda_tangan}}</div>
                <p><strong>{{nama_pejabat}}</strong></p>
            </div>
            <div style="font-size:9pt;">{{qr_code}}</div>
        </div>';
    }

    // Ekstrak semua variabel {{xxx}} dari template
    private function extractVariables(string $html): array
    {
        preg_match_all('/\{\{(\w+)\}\}/', $html, $matches);
        return array_unique($matches[1]);
    }
}