<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class TereLiyeBooksSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title'       => 'Nebula',
                'author'      => 'Tere Liye',
                'isbn'        => '978-602-03-8765-1',
                'cover_image' => 'tere-liye-1.jpg',
                'description' => 'Kisah epik ini menceritakan tentang asal-usul legenda di Klan Bulan. Nebula adalah bagian menarik dalam serial Bumi yang membawa pembaca pada petualangan para remaja ke wilayah misterius dan kuno, mengungkapkan masa lalu yang penuh intrik dan pertempuran besar.',
                'Category'    => 'Fantasy',
            ],
            [
                'title'       => 'Negeri di Ujung Tanduk',
                'author'      => 'Tere Liye',
                'isbn'        => '978-602-03-0512-8',
                'cover_image' => 'tere-liye-2.jpg',
                'description' => 'Melanjutkan petualangan Thomas dari "Negeri Para Bedebah". Di sini ia terlibat dalam konflik besar dengan jaringan mafia dan politisi kotor, menguji kecerdasan dan kekuatan fisiknya dalam pertarungan hidup atau mati.',
                'Category'    => 'Action',
            ],
            [
                'title'       => 'Cinta Antara Jakarta & Kuala Lumpur',
                'author'      => 'Tere Liye',
                'isbn'        => '978-602-03-9123-4',
                'cover_image' => 'tere-liye-3.jpg',
                'description' => 'Novel romansa dan kehidupan yang mengisahkan hubungan antara dua kota metropolitan. Membawa pembaca merenungi arti komitmen, cinta, dan perjuangan dalam mempertahankan ikatan meskipun dipisahkan jarak dan waktu.',
                'Category'    => 'Romance',
            ],
            [
                'title'       => 'Jengki',
                'author'      => 'Tere Liye',
                'isbn'        => '978-602-03-9456-7',
                'cover_image' => 'tere-liye-4.jpg',
                'description' => 'Sebuah kisah inspiratif tentang kehidupan sederhana di era 1960-an. Novel ini mengajarkan tentang pengabdian, cinta tanpa batas, dan arti keikhlasan dalam menghadapi kerasnya realitas.',
                'Category'    => 'Drama',
            ],
            [
                'title'       => 'Sebelas',
                'author'      => 'Tere Liye',
                'isbn'        => '978-602-03-9789-0',
                'cover_image' => 'tere-liye-5.jpg',
                'description' => 'Sebuah novel tentang perjalanan keras sebuah tim sepakbola yang tidak diunggulkan, mengajarkan nilai sportivitas, perjuangan pantang menyerah, dan kekuatan kerja sama tim.',
                'Category'    => 'Sports',
            ],
            [
                'title'       => 'Selamat Tinggal',
                'author'      => 'Tere Liye',
                'isbn'        => '978-602-03-8234-2',
                'cover_image' => 'selamat-tinggal.jpg',
                'description' => 'Novel yang ditulis oleh Tere Liye ini mengisahkan kisah seorang pemuda yang mencoba menemukan jati dirinya di tengah dunia yang penuh perubahan. Sebuah perjalanan emosional tentang kehilangan, kenangan, dan harapan yang tersisa.',
                'Category'    => 'Drama',
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(
                ['title' => $book['title'], 'author' => $book['author']],
                $book
            );
        }
    }
}
