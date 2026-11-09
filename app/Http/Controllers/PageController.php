<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public const PERAN = [
        'Siswa Sekolah',
        'Mahasiswa Baru',
        'Mahasiswa Aktif',
        'Fresh Graduate',
        'Pekerja Mapan',
    ];

    protected $loreberries = [
        [
            'nomor' => 1,
            'kategori' => 'BOTANI • BUAH SEJATI',
            'emoji' => '🍓',
            'judul' => 'Stroberi Bukan Berry Sejati',
            'fakta' => 'Secara botani stroberi bukan berry. Butiran di kulitnya sebenarnya buah mungil bernama achene.',
            'sorotan' => ['angka' => '200', 'label' => 'rata-rata butiran di satu stroberi'],
            'poin' => [
                'Biji sejatinya ada di dalam tiap butir',
                'Bagian merahnya berasal dari dasar bunga yang membengkak',
                'Masih satu keluarga dengan bunga mawar',
            ],
            'pesan' => [
                'Siswa Sekolah' => 'Nilai ulangan kemarin turun gara-gara kurang teliti? Santai, besok baca soalnya sekali lagi ya.',
                'Mahasiswa Baru' => 'Baru masuk kuliah? Biasakan baca ulang instruksi tugas. Typo kecil bisa bikin nilai turun.',
                'Mahasiswa Aktif' => 'Cek ulang tugasmu sebelum dikumpulkan. Typo di halaman pertama bisa bikin nilai turun.',
                'Fresh Graduate' => 'Lagi siap melamar? Baca ulang CV dan email sebelum dikirim. Detail kecil berpengaruh.',
                'Pekerja Mapan' => 'Email penting? Baca ulang dua kali sebelum klik kirim. Kamu yang jam 5 sore pasti berterima kasih.',
            ],
            'pesan_usia' => [
                'remaja' => 'Biasakan teliti dari sekarang, ujian nanti jadi lebih tenang.',
                'muda' => 'Kebiasaan rapi yang kamu bangun sekarang bakal terbawa terus.',
                'dewasa' => 'Ketelitianmu sudah terlatih lama, itu skill yang tidak semua orang punya.',
            ],
        ],
        [
            'nomor' => 2,
            'kategori' => 'BOTANI • WARNA ALAMI',
            'emoji' => '🫐',
            'judul' => 'Daging Blueberry Itu Hijau',
            'fakta' => 'Blueberry kelihatan biru, padahal daging buahnya hijau pucat.',
            'sorotan' => ['angka' => 'Hijau', 'label' => 'warna asli daging buah blueberry'],
            'poin' => [
                'Kulitnya diselimuti lapisan lilin tipis yang memantulkan cahaya',
                'Pigmen antosianin di kulit ikut memberi warna gelap',
                'Lapisan lilinnya bisa hilang kalau digosok',
            ],
            'pesan' => [
                'Siswa Sekolah' => 'Teman sekelas yang pendiam belum tentu tidak seru. Coba ajak ngobrol hari ini.',
                'Mahasiswa Baru' => 'Dosen yang kelihatan galak belum tentu menakutkan. Coba konsultasi sekali, kamu bisa lebih tenang.',
                'Mahasiswa Aktif' => 'Dosen yang kelihatan galak biasanya asik saat konsultasi. Beranikan datang bimbingan.',
                'Fresh Graduate' => 'Rekan kerja atau mentor yang cuek mungkin sedang fokus. Sapa dulu, jangan buru-buru menyimpulkan.',
                'Pekerja Mapan' => 'Rekan kerja yang cuek mungkin cuma lagi fokus. Tanya kabarnya dulu, siapa tahu jadi akrab.',
            ],
            'pesan_usia' => [
                'remaja' => 'Kamu juga lebih seru dari kesan pertama orang, jadi percaya diri saja.',
                'muda' => 'Lagi bingung mau jadi apa? Wajar, kamu masih dalam proses.',
                'dewasa' => 'Pengalamanmu tidak selalu kelihatan, tapi orang di sekitarmu pasti merasakannya.',
            ],
        ],
        [
            'nomor' => 3,
            'kategori' => 'BOTANI • STRUKTUR BUAH',
            'emoji' => '🍇',
            'judul' => 'Raspberry Itu Gabungan Buah Mungil',
            'fakta' => 'Satu raspberry bukan buah tunggal, tapi gabungan buah-buah kecil bernama drupelet.',
            'sorotan' => ['angka' => 'Puluhan', 'label' => 'drupelet dalam satu raspberry'],
            'poin' => [
                'Tiap drupelet membawa bijinya sendiri',
                'Termasuk buah majemuk (aggregate fruit)',
                'Saat dipetik, bagian tengahnya berongga',
            ],
            'pesan' => [
                'Siswa Sekolah' => 'Tugas menumpuk? Kerjakan satu mata pelajaran dulu, sisanya nanti.',
                'Mahasiswa Baru' => 'Tugas kuliah menumpuk? Mulai dari satu bagian kecil hari ini, jangan tunggu semuanya sempurna.',
                'Mahasiswa Aktif' => 'Skripsi atau laporan panjang cukup dimulai dari satu paragraf hari ini.',
                'Fresh Graduate' => 'Proyek pertama terasa berat? Pecah jadi langkah kecil, lalu centang satu per satu.',
                'Pekerja Mapan' => 'Daftar kerjaan panjang? Pilih yang paling gampang, centang, lanjut.',
            ],
            'pesan_usia' => [
                'remaja' => 'Belajar 15 menit tiap hari lebih ampuh daripada begadang semalam.',
                'muda' => 'Progres kecil tapi rutin bakal kelihatan hasilnya beberapa bulan lagi.',
                'dewasa' => 'Rutinitas kecil yang kamu jaga diam-diam bikin hidupmu lebih tertata.',
            ],
        ],
        [
            'nomor' => 4,
            'kategori' => 'PERTANIAN • PANEN',
            'emoji' => '🍒',
            'judul' => 'Cranberry Bisa Mengapung',
            'fakta' => 'Cranberry punya kantong udara di dalamnya, jadi buahnya mengapung di air.',
            'sorotan' => ['angka' => 'Mengapung', 'label' => 'sifat cranberry saat direndam air'],
            'poin' => [
                'Kebun dibanjiri saat panen (wet harvest)',
                'Buah naik ke permukaan air',
                'Lalu dikumpulkan dengan mudah',
            ],
            'pesan' => [
                'Siswa Sekolah' => 'Kepala sudah panas gara-gara belajar? Rehat 10 menit dulu, minum, baru lanjut.',
                'Mahasiswa Baru' => 'Deadline dan adaptasi kuliah bikin pusing? Tarik napas dulu, tugasnya tidak akan kabur.',
                'Mahasiswa Aktif' => 'Deadline menumpuk bikin pusing? Tarik napas dulu, tugasnya tidak bakal kabur kok.',
                'Fresh Graduate' => 'Capek mencari kerja? Jalan sebentar, minum, lalu lanjut kirim lamaran.',
                'Pekerja Mapan' => 'Capek banget hari ini? Jalan sebentar dari mejamu, kepala jadi lebih adem.',
            ],
            'pesan_usia' => [
                'remaja' => 'Kamu tidak harus kuat terus. Istirahat juga bagian dari belajar.',
                'muda' => 'Hidup lagi ngebut? Sisakan waktu buat diri sendiri, walau sebentar.',
                'dewasa' => 'Jadwalkan istirahat seperti kamu menjadwalkan rapat. Sama pentingnya.',
            ],
        ],
        [
            'nomor' => 5,
            'kategori' => 'BOTANI • KLASIFIKASI',
            'emoji' => '🍌',
            'judul' => 'Pisang Itu Berry, Stroberi Bukan',
            'fakta' => 'Secara botani pisang memenuhi definisi berry, sedangkan stroberi dan raspberry justru tidak.',
            'sorotan' => ['angka' => 'Berry', 'label' => 'status botani pisang, tomat, dan terong'],
            'poin' => [
                'Berry sejati berasal dari satu bunga dengan satu bakal buah',
                'Kulitnya tipis dan bijinya ada di dalam daging buah',
                'Nama sehari-hari sering beda dari definisi botani',
            ],
            'pesan' => [
                'Siswa Sekolah' => 'Bahan ngobrol di kantin: pisang itu berry, stroberi bukan. Dijamin teman kamu bengong.',
                'Mahasiswa Baru' => 'Di kuliah, dosen sering tanya kenapa. Belajar mencari alasan, bukan cuma hafal definisi.',
                'Mahasiswa Aktif' => 'Saat belajar, cari tahu alasannya, jangan cuma hafal definisi. Dosen suka nanya kenapa.',
                'Fresh Graduate' => 'Jabatan pertama bukan penentu segalanya. Hasil kerja dan cara belajar yang bicara.',
                'Pekerja Mapan' => 'Jabatan di kartu nama tidak menentukan skill kamu. Hasil kerjamu yang bicara.',
            ],
            'pesan_usia' => [
                'remaja' => 'Nanya kenapa ke gurumu itu keren, bukan ngerepotin.',
                'muda' => 'Rajin nanya alasan di balik sesuatu bikin kamu cepat paham.',
                'dewasa' => 'Pengalamanmu bikin kamu jago baca isi, bukan cuma label.',
            ],
        ],
        [
            'nomor' => 6,
            'kategori' => 'SAINS • KANDUNGAN AIR',
            'emoji' => '🍉',
            'judul' => 'Semangka Hampir Seluruhnya Air',
            'fakta' => 'Semangka hampir seluruhnya terdiri dari air.',
            'sorotan' => ['angka' => '92%', 'label' => 'kandungan air pada semangka'],
            'poin' => [
                'Secara botani termasuk buah pepo, segolongan dengan labu dan timun',
                'Bijinya yang hitam bisa dimakan',
                'Kulit putihnya bisa diolah jadi acar atau tumisan',
            ],
            'pesan' => [
                'Siswa Sekolah' => 'Sudah minum air putih belum hari ini? Botol minummu menunggu tuh.',
                'Mahasiswa Baru' => 'Begadang orientasi dan tugas? Selingi air putih biar besok tidak pusing.',
                'Mahasiswa Aktif' => 'Begadang sambil ngemil terus? Selingi air putih biar besok tidak pusing.',
                'Fresh Graduate' => 'Sibuk melamar dan interview? Tetap bawa botol minum, jangan cuma kopi.',
                'Pekerja Mapan' => 'Taruh botol minum di meja, jangan cuma kopi.',
            ],
            'pesan_usia' => [
                'remaja' => 'Badan sehat bikin fokus belajar jauh lebih enak.',
                'muda' => 'Lagi sibuk mengejar banyak hal? Tubuhmu tetap butuh dirawat.',
                'dewasa' => 'Minum air cukup itu investasi kesehatan paling murah.',
            ],
        ],
        [
            'nomor' => 7,
            'kategori' => 'KIMIA • ENZIM',
            'emoji' => '🍍',
            'judul' => 'Nanas Punya Enzim Pelumat Protein',
            'fakta' => 'Lidah bisa terasa perih setelah makan nanas segar karena enzim di dalamnya.',
            'sorotan' => ['angka' => 'Bromelain', 'label' => 'enzim nanas yang menguraikan protein'],
            'poin' => [
                'Pemanasan membuat bromelain tidak aktif',
                'Nanas kalengan biasanya tidak bikin perih',
                'Nanas adalah buah majemuk dari banyak bunga',
            ],
            'pesan' => [
                'Siswa Sekolah' => 'Materi baru memang bikin pusing di awal. Nanti juga mengerti, tenang saja.',
                'Mahasiswa Baru' => 'Materi baru memang bikin pusing di awal. Pelan-pelan, nanti paham.',
                'Mahasiswa Aktif' => 'Mata kuliah yang bikin kepala berasap biasanya jadi favorit setelah paham.',
                'Fresh Graduate' => 'Tugas baru yang bikin deg-degan tandanya skill kamu sedang naik level.',
                'Pekerja Mapan' => 'Tugas baru yang bikin deg-degan tandanya skill kamu lagi naik level.',
            ],
            'pesan_usia' => [
                'remaja' => 'Salah itu wajar, namanya juga lagi belajar.',
                'muda' => 'Keluar dari zona nyaman memang tidak enak, tapi worth it.',
                'dewasa' => 'Belajar hal baru di usia segini keren banget, serius.',
            ],
        ],
        [
            'nomor' => 8,
            'kategori' => 'ZOOLOGI • LEBAH MADU',
            'emoji' => '🐝',
            'judul' => 'Madu Itu Hasil Kerja Bersama',
            'fakta' => 'Madu di sendokmu adalah hasil kerja banyak lebah.',
            'sorotan' => ['angka' => '1/12', 'label' => 'sendok teh madu per lebah seumur hidupnya'],
            'poin' => [
                'Satu sarang dihuni ribuan lebah pekerja',
                'Madu berasal dari nektar bunga yang diolah di sarang',
                'Lebah mengumpulkan nektar dari banyak bunga',
            ],
            'pesan' => [
                'Siswa Sekolah' => 'Ajak teman belajar bareng, latihan soal rame-rame lebih seru.',
                'Mahasiswa Baru' => 'Cari satu-dua teman seangkatan. Kuliah jadi lebih ringan kalau ada teman belajar.',
                'Mahasiswa Aktif' => 'Cari satu-dua teman seperjuangan, kuliah jadi tidak sesepi itu.',
                'Fresh Graduate' => 'Bilang terima kasih ke mentor atau rekan yang membantu kamu hari ini.',
                'Pekerja Mapan' => 'Bilang makasih ke rekan yang bantuin kamu hari ini. Hal kecil, efeknya besar.',
            ],
            'pesan_usia' => [
                'remaja' => 'Teman belajar yang asik bikin sekolah terasa lebih ringan.',
                'muda' => 'Teman-teman yang kamu kenal sekarang bisa jadi tim hebat suatu hari nanti.',
                'dewasa' => 'Tim yang saling percaya itu aset, rawat baik-baik.',
            ],
        ],
        [
            'nomor' => 9,
            'kategori' => 'ZOOLOGI • INDRA',
            'emoji' => '🦋',
            'judul' => 'Kupu-kupu Mencicipi dengan Kakinya',
            'fakta' => 'Kupu-kupu bisa mencicipi daun hanya dengan hinggap di atasnya.',
            'sorotan' => ['angka' => 'Kaki', 'label' => 'bagian tubuh yang punya reseptor rasa'],
            'poin' => [
                'Dipakai untuk menilai daun tempat bertelur',
                'Belalainya dipakai menghisap nektar',
                'Belalai menggulung saat tidak dipakai',
            ],
            'pesan' => [
                'Siswa Sekolah' => 'Penasaran dengan satu ekskul? Daftar dulu, coba seminggu.',
                'Mahasiswa Baru' => 'Coba satu organisasi atau kegiatan kampus semester ini. Siapa tahu cocok.',
                'Mahasiswa Aktif' => 'Ikut satu lomba atau organisasi semester ini, siapa tahu cocok.',
                'Fresh Graduate' => 'Ada peluang baru yang bikin penasaran? Angkat tangan dan coba.',
                'Pekerja Mapan' => 'Ada proyek baru yang bikin penasaran? Angkat tangan duluan.',
            ],
            'pesan_usia' => [
                'remaja' => 'Masih banyak hal yang bisa kamu coba, nikmatin saja.',
                'muda' => 'Banyak coba-coba sekarang bikin arah hidupmu makin jelas.',
                'dewasa' => 'Belum telat kok buat nyobain hal yang dari dulu bikin penasaran.',
            ],
        ],
        [
            'nomor' => 10,
            'kategori' => 'BOTANI • ADAPTASI',
            'emoji' => '🌵',
            'judul' => 'Kaktus Bernapas di Malam Hari',
            'fakta' => 'Banyak kaktus membuka pori-porinya di malam hari, bukan siang.',
            'sorotan' => ['angka' => 'Malam', 'label' => 'waktu pori-pori kaktus terbuka'],
            'poin' => [
                'Pori-pori dibuka saat sejuk supaya air tidak cepat menguap',
                'Memakai fotosintesis tipe CAM',
                'Air disimpan di batang yang berdaging',
            ],
            'pesan' => [
                'Siswa Sekolah' => 'Kamu lebih fokus pagi atau malam? Kenali jam terbaikmu untuk belajar.',
                'Mahasiswa Baru' => 'Kenali jam terbaikmu untuk belajar. Pagi atau malam, yang penting konsisten.',
                'Mahasiswa Aktif' => 'Taruh tugas paling berat di jam paling segarmu.',
                'Fresh Graduate' => 'Kerjakan hal berat saat energi penuh, yang ringan untuk sore.',
                'Pekerja Mapan' => 'Kerjaan berat saat energi lagi penuh, yang ringan buat sore.',
            ],
            'pesan_usia' => [
                'remaja' => 'Tidur cukup bikin otak jalan lebih lancar, serius.',
                'muda' => 'Kenali ritme tubuhmu biar tidak gampang burnout.',
                'dewasa' => 'Hidup yang seimbang bikin tenagamu awet.',
            ],
        ],
    ];

    protected $labelKelompok = [
        'remaja' => 'Remaja',
        'muda' => 'Dewasa muda',
        'dewasa' => 'Dewasa',
    ];

    protected $daftarFase = [
        ['nama' => 'Siswa Sekolah', 'singkat' => 'Siswa', 'aura' => 'Siswa Ceria'],
        ['nama' => 'Mahasiswa Baru', 'singkat' => 'Maba', 'aura' => 'Maba Semangat'],
        ['nama' => 'Mahasiswa Aktif', 'singkat' => 'Mahasiswa', 'aura' => 'Mahasiswa Fokus'],
        ['nama' => 'Fresh Graduate', 'singkat' => 'Fresh Graduate', 'aura' => 'Pejuang Pemula'],
        ['nama' => 'Pekerja Mapan', 'singkat' => 'Pekerja', 'aura' => 'Tenang dan Mantap'],
    ];

    protected $langkah = [
        ['judul' => 'Daftar dulu', 'isi' => 'Isi username, usia, dan peran. Orby bakal memilih pesan yang pas untukmu.'],
        ['judul' => 'Buka loker', 'isi' => 'Ada 10 loker rahasia. Klik pintunya, surat dari Orby langsung keluar.'],
        ['judul' => 'Simpan favorit', 'isi' => 'Suka dan simpan fakta yang paling seru, lalu selesaikan misi hari ini untuk mendapatkan kejutan.'],
    ];

    protected $teaser = [
        ['nomor' => 1, 'emoji' => '🍓'],
        ['nomor' => 2, 'emoji' => '🫐'],
        ['nomor' => 3, 'emoji' => '🍇'],
        ['nomor' => 4, 'emoji' => '🍒'],
    ];

    protected function keHomeJikaLogin(Request $request)
    {
        if ($request->session()->has('user')) {
            $user = $request->session()->get('user');
            
            // ⚠️ POIN UTS: Redirect membawa Request Parameter
            return redirect()->route('home', [
                'username' => $user['username'],
                'peran' => $user['peran']
            ]);
        }

        return null;
    }

    protected function normalisasiPeran(string $peran): string
    {
        $peranLama = [
            'Pelajar' => 'Siswa Sekolah',
            'Mahasiswa' => 'Mahasiswa Aktif',
            'Pekerja' => 'Pekerja Mapan',
        ];

        $peran = $peranLama[$peran] ?? $peran;

        return in_array($peran, self::PERAN, true) ? $peran : 'Siswa Sekolah';
    }

    protected function faseUntukPeran(string $peran): array
    {
        foreach ($this->daftarFase as $fase) {
            if ($fase['nama'] === $peran) {
                return $fase;
            }
        }

        return $this->daftarFase[0];
    }

    public function landing(Request $request)
    {
        if ($sudahLogin = $this->keHomeJikaLogin($request)) {
            return $sudahLogin;
        }

        $langkah = $this->langkah;
        $teaser = $this->teaser;

        return view('landing', compact('langkah', 'teaser'));
    }

    public function loginPage(Request $request)
    {
        if ($sudahLogin = $this->keHomeJikaLogin($request)) {
            return $sudahLogin;
        }

        return view('login');
    }

    public function registerPage()
    {
        $daftarPeran = self::PERAN;

        return view('register', compact('daftarPeran'));
    }

    public function index(Request $request)
    {
        $user = $request->session()->get('user');

        if (!$user) {
            return redirect('/login')->with('error', 'Silakan masuk dulu.');
        }

        $username = $request->query('username', $user['username']);
        $peranUrl = $request->query('peran', $user['peran']);

        if ($username !== $user['username']) {
            return redirect()->route('home', [
                'username' => $user['username'],
                'peran' => $user['peran']
            ]);
        }

        $peran = $this->normalisasiPeran($peranUrl);
        $usia = (int) $user['usia'];

        if ($usia <= 17) {
            $kelompok = 'remaja';
        } elseif ($usia <= 24) {
            $kelompok = 'muda';
        } else {
            $kelompok = 'dewasa';
        }

        $labelKelompok = $this->labelKelompok[$kelompok];

        $loreberries = [];
        foreach ($this->loreberries as $item) {
            $pesanPeran = $item['pesan'][$peran] ?? '';
            $pesanUsia = $item['pesan_usia'][$kelompok] ?? '';

            $loreberries[] = [
                'nomor' => $item['nomor'],
                'emoji' => $item['emoji'],
                'judul' => $item['judul'],
                'fakta' => $item['fakta'],
                'kategori' => $item['kategori'],
                'cari' => mb_strtolower(
                    $item['judul'] . ' ' .
                    $item['kategori'] . ' ' .
                    $item['fakta'] . ' ' .
                    $item['sorotan']['angka'] . ' ' .
                    $item['sorotan']['label'] . ' ' .
                    implode(' ', $item['poin']) . ' ' .
                    $pesanPeran . ' ' .
                    $pesanUsia
                ),
                'sorotan' => $item['sorotan'],
                'poin' => $item['poin'],
                'pesan' => $pesanPeran,
                'pesan_usia' => $pesanUsia,
            ];
        }

        $faseData = $this->faseUntukPeran($peran);
        $fase = $faseData['nama'];
        $faseSingkat = $faseData['singkat'];
        $aura = $faseData['aura'];

        $status = 'Pengamat Semesta';
        $daftarFase = $this->daftarFase;
        $bio = 'Pemburu fakta manis';

        $kejutan = [
            'kategori' => 'ZOOLOGI • GUINEA PIG',
            'judul' => 'Loker Rahasia Terbuka!',
            'fakta' => 'Guinea pig melompat-lompat kecil saat sangat senang. Kebiasaan ini disebut popcorning karena geraknya mirip jagung yang meletus di panci.',
            'pesan' => 'Hari ini kamu menyapa, membuka, dan menyimpan. Orby sampai popcorning nih!',
            'lencana' => 'Penjelajah Manis',
        ];

        $aktivitas = [
            ['kunci' => 'sapa', 'teks' => 'Sapa Orby'],
            ['kunci' => 'buka', 'teks' => 'Buka loker baru'],
            ['kunci' => 'simpan', 'teks' => 'Simpan satu fakta favorit'],
        ];

        return view('home', compact(
            'username',
            'peran',
            'usia',
            'labelKelompok',
            'loreberries',
            'fase',
            'faseSingkat',
            'aura',
            'status',
            'daftarFase',
            'bio',
            'aktivitas',
            'kejutan'
        ));
    }
}