# PokéCare - Pokémon Research & Training Center

## Data Diri
- **Nama:** [Windi Sulaiman Ismansa]
- **NIM:** [H1H024005]
- **Shift Awal:** [C]
- **Shift Akhir:** [D]

Deskripsi Aplikasi
PokéCare adalah sistem simulasi berbasis web untuk melatih dan mengembangkan Pokémon Victreebel. Aplikasi ini dikembangkan untuk memenuhi tugas Responsi Praktikum Pemrograman Berorientasi Objek (PBO) yang memungkinkan trainer untuk:
- Melihat informasi dasar Pokémon Victreebel
- Melakukan berbagai jenis latihan (Attack, Defense, Speed) dengan intensitas berbeda
- Memantau perkembangan statistik Pokémon
- Melihat riwayat lengkap sesi latihan
- Mengelola perkembangan Pokemon secara komprehensif

Fitur Utama yang ada pada aplikasi ini:
Halaman Beranda (index.php)
- Menampilkan informasi dasar Pokémon (nama, tipe, level, HP)
- Statistik Pokémon dalam bentuk kartu yang informatif
- Deskripsi jurus special Pokemon
- Navigasi ke halaman latihan dan riwayat

Halaman Latihan (training.php)
- Form pemilihan jenis latihan (Attack, Defense, Speed)
- Input intensitas latihan (skala 1-10)
- Simulasi peningkatan level dan HP
- Tampilan hasil latihan secara real-time
- Informasi terkait jurus special Pokemon

Halaman Riwayat (history.php)
- Daftar lengkap seluruh sesi latihan
- Detail setiap latihan (jenis, intensitas, perubahan statistik)
- Tombol reset riwayat latihan
- Tampilan perubahan level dan HP secara visual

1. Encapsulation
php
class Pokemon {
    protected $name;
    protected $type;
    protected $level;
    protected $hp;
    // Data disembunyikan dan diakses via getter methods
    public function getName() { return $this->name; }
}
2. Inheritance
php
class Victreebel extends Pokemon {
    // Victreebel mewarisi semua property dan method dari Pokemon
    public function __construct() {
        parent::__construct("Victreebel", "Grass/Poison", 5, 50, "...");
    }
}

3. Polymorphism
php
abstract class Pokemon {
    abstract public function train($trainingType, $intensity);
}
class Victreebel extends Pokemon {
    public function train($trainingType, $intensity) {
        // Implementasi spesifik untuk Victreebel
    }
}
4. Abstraction
php
abstract class Pokemon {
    abstract public function specialMove();
    // Method abstract harus diimplementasi oleh child class
}

Untuk menjalankan aplikasi ini yang pertama pastikan laragon atau sejenisnya sudah diaktifkan kemudian buka browser anda dan buka link http://localhost/pokecare/index.php untuk menampilkan beranda aplikasi, kemudian klik mulai latihan yang akan membawa anda ke tampilan training seteleh dilatih aplikasi akan menunjukkan hasil dari latihan, hasil latihan dapat dilihat kembali dengan mengklik button lihat riwayat latihan.

video penggunaan aplikasi
![aplikasi (1)](https://github.com/user-attachments/assets/04567098-e420-423e-b2e3-053ab9627128)
