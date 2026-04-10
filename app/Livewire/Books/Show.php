<?php

namespace App\Livewire\Books;

use App\Models\Book;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Show extends Component
{
    public $book;

    public function mount($id)
    {
        // For debugging/demo purposes
        if (is_numeric($id)) {
            $this->book = Book::findOrFail($id);
        } else {
            // Mock data for demo if not in DB
            $mockData = [
                'j-book1' => [
                    'title' => 'At Night All Blood Is Black', 'author' => 'David Diop', 
                    'desc' => 'Alfa Ndiaye is a Senegalese man who, never before having left his village, finds himself fighting as a so-called "Chocolat" for France in World War I. When his friend Mademba Diop is killed, Alfa descends into a spiral of violence and madness. Winner of the 2021 International Booker Prize.', 
                    'subjects' => ['Fiction', 'Historical Fiction', 'War'], 'lang' => 'English (Translated from French)'
                ],
                'j-book2' => [
                    'title' => 'I Live in the Slums', 'author' => 'Can Xue', 
                    'desc' => 'A collection of haunting and dreamlike short stories from one of China\'s most celebrated avant-garde writers. The stories explore metamorphosis, paranoia, and the boundaries between human and animal realms.', 
                    'subjects' => ['Short Stories', 'Surrealism', 'Asian Literature'], 'lang' => 'English (Translated from Chinese)'
                ],
                'j-book3' => [
                    'title' => 'Minor Detail', 'author' => 'Adania Shibli', 
                    'desc' => 'A searing, beautiful novel exploring Palestinian memory and the erasure of history. It traces two stories connecting a traumatic event in 1949 with a modern-day woman obsessed with uncovering the truth.', 
                    'subjects' => ['Fiction', 'Historical Fiction', 'Middle East'], 'lang' => 'English (Translated from Arabic)'
                ],
                'j-book4' => [
                    'title' => 'When We Cease to Understand the World', 'author' => 'Benjamin Labatut', 
                    'desc' => 'A dizzying, thrilling novel about the dark side of science and the brilliant, tormented minds of history\'s greatest geniuses, exploring the fine line between genius and madness.', 
                    'subjects' => ['Historical Fiction', 'Science Fiction', 'Philosophy'], 'lang' => 'English (Translated from Spanish)'
                ],
                'j-book5' => [
                    'title' => 'The Power of Focus', 'author' => 'Brian Tracy', 
                    'desc' => 'Practical and profound strategies to hit your personal, financial, and business targets. An insightful guide to achieving ultimate success by mastering the power of concentration.', 
                    'subjects' => ['Self-Help', 'Business', 'Personal Development'], 'lang' => 'Arabic Edition'
                ],
                'm-book1' => [
                    'title' => 'Stop Letting Everything Affect You', 'author' => 'Daniel Chidiac', 
                    'desc' => 'A robust guide designed to help readers break free from overthinking, emotional chaos, and self-sabotage by offering actionable steps to regain mental clarity and peace.', 
                    'subjects' => ['Mental Health', 'Self-Help', 'Psychology'], 'lang' => 'English'
                ],
                'm-book2' => [
                    'title' => 'Afraid: Understanding the Purpose of Fear', 'author' => 'Arash Javanbakht, MD', 
                    'desc' => 'A medical doctor and psychiatrist explains the evolutionary purpose of fear, how it manifests in the brain, and how we can harness the power of anxiety instead of being paralyzed by it.', 
                    'subjects' => ['Psychology', 'Neuroscience', 'Mental Health'], 'lang' => 'English'
                ],
                'm-book3' => [
                    'title' => 'The Body Keeps the Score', 'author' => 'Bessel van der Kolk, M.D.', 
                    'desc' => 'A pioneering researcher transforms our understanding of trauma and offers a bold new paradigm for healing by exploring how trauma literally reshapes both body and brain.', 
                    'subjects' => ['Psychology', 'Trauma', 'Science'], 'lang' => 'English'
                ],
                'm-book4' => [
                    'title' => 'The Body Keeps the Score', 'author' => 'Bessel van der Kolk, M.D.', 
                    'desc' => 'A pioneering researcher transforms our understanding of trauma and offers a bold new paradigm for healing by exploring how trauma literally reshapes both body and brain.', 
                    'subjects' => ['Psychology', 'Trauma', 'Science'], 'lang' => 'English'
                ],
                'm-book5' => [
                    'title' => 'Unwinding Anxiety', 'author' => 'Judson Brewer, MD, PhD', 
                    'desc' => 'New science shows how to break the cycles of worry and fear to heal your mind. A step-by-step, clinically proven program aimed at hacking our brains to stop endless worrying.', 
                    'subjects' => ['Mental Health', 'Psychology', 'Self-Help'], 'lang' => 'English'
                ],
                'k-book1' => [
                    'title' => 'Kim Jiyoung, Born 1982', 'author' => 'Cho Nam-joo', 
                    'desc' => 'A fiercely international bestseller that ignited a conversation about modern feminism. It follows a young woman experiencing the deeply entrenched gender discrimination of contemporary South Korean society.', 
                    'subjects' => ['Contemporary Fiction', 'Feminism', 'Korean Literature'], 'lang' => 'English (Translated from Korean)'
                ],
                'k-book2' => [
                    'title' => 'Eligible', 'author' => 'Curtis Sittenfeld', 
                    'desc' => 'A modern retelling of Pride and Prejudice set in Cincinnati, updating the classic story of the Bennet sisters for the 21st century.', 
                    'subjects' => ['Romance', 'Contemporary Fiction', 'Humor'], 'lang' => 'English'
                ],
                'k-book3' => [
                    'title' => 'At Dusk', 'author' => 'Hwang Sok-yong', 
                    'desc' => 'An aging, successful architect reflects on his life and the rapid modernization of Seoul, coming to terms with the memories and people he left behind in his pursuit of success.', 
                    'subjects' => ['Literary Fiction', 'Korean Literature', 'Social Commentary'], 'lang' => 'English (Translated from Korean)'
                ],
                'k-book4' => [
                    'title' => 'Beasts of a Little Land', 'author' => 'Juhea Kim', 
                    'desc' => 'An epic story of love, war, and redemption set against the backdrop of the Korean independence movement, weaving together the fates of a young courtesan and an impoverished hunter.', 
                    'subjects' => ['Historical Fiction', 'Epic', 'Korean Literature'], 'lang' => 'English'
                ],
                'k-book5' => [
                    'title' => 'Kim Jiyoung, Born 1982', 'author' => 'Cho Nam-joo', 
                    'desc' => 'A fiercely international bestseller that ignited a conversation about modern feminism. It follows a young woman experiencing the deeply entrenched gender discrimination of contemporary South Korean society.', 
                    'subjects' => ['Contemporary Fiction', 'Feminism', 'Korean Literature'], 'lang' => 'English (Translated from Korean)'
                ],
                'book-extra1' => [
                    'title' => 'Arsus (رواية آرسس)', 'author' => 'Ahmed Al Hamdan', 
                    'desc' => 'A gripping Arabic novel full of suspense, intense emotions, and thrilling storytelling that takes the reader on a psychological and breathtaking journey.', 
                    'subjects' => ['Arabic Literature', 'Thriller', 'Fiction'], 'lang' => 'Arabic'
                ],
                'book-extra2' => [
                    'title' => 'The Cabinet', 'author' => 'Un-Su Kim', 
                    'desc' => 'A bizarre and deeply engaging Korean science fiction novel about an office worker discovering a filing cabinet filled with files on "symptomers"—mutants exhibiting strange new evolutionary traits.', 
                    'subjects' => ['Science Fiction', 'Korean Literature', 'Surrealism'], 'lang' => 'English (Translated from Korean)'
                ],
                'rec-1' => [
                    'title' => 'Nebula', 'author' => 'Tere Liye', 'cover' => 'tere-liye-1.jpg',
                    'desc' => 'Kisah epik ini menceritakan tentang asal-usul legenda di Klan Bulan. Nebula adalah bagian menarik dalam serial Bumi yang membawa pembaca pada petualangan para remaja ke wilayah misterius dan kuno, mengungkapkan masa lalu yang penuh intrik dan pertempuran besar.', 
                    'subjects' => ['Fantasy', 'Teen Fiction', 'Indonesian Literature'], 'lang' => 'Indonesian'
                ],
                'rec-2' => [
                    'title' => 'Negeri di Ujung Tanduk', 'author' => 'Tere Liye', 'cover' => 'tere-liye-2.jpg',
                    'desc' => 'Melanjutkan petualangan Thomas dari "Negeri Para Bedebah". Di sini ia terlibat dalam konflik besar dengan jaringan mafia dan politisi kotor, menguji kecerdasan dan kekuatan fisiknya dalam pertarungan hidup atau mati.', 
                    'subjects' => ['Action', 'Thriller', 'Indonesian Literature'], 'lang' => 'Indonesian'
                ],
                'rec-3' => [
                    'title' => 'Cinta Antara Jakarta & Kuala Lumpur', 'author' => 'Tere Liye', 'cover' => 'tere-liye-3.jpg',
                    'desc' => 'Novel romansa dan kehidupan yang mengisahkan hubungan antara dua kota metropolitan. Membawa pembaca merenungi arti komitmen, cinta, dan perjuangan dalam mempertahankan ikatan meskipun dipisahkan jarak dan waktu.', 
                    'subjects' => ['Romance', 'Drama', 'Indonesian Literature'], 'lang' => 'Indonesian'
                ],
                'rec-4' => [
                    'title' => 'Jengki', 'author' => 'Tere Liye', 'cover' => 'tere-liye-4.jpg',
                    'desc' => 'Sebuah kisah inspiratif tentang kehidupan sederhana. Novel ini mengajarkan tentang pengabdian, cinta tanpa batas, dan arti keikhlasan dalam menghadapi kerasnya realitas.', 
                    'subjects' => ['Drama', 'Slice of Life', 'Indonesian Literature'], 'lang' => 'Indonesian'
                ],
                'rec-5' => [
                    'title' => 'Sebelas', 'author' => 'Tere Liye', 'cover' => 'tere-liye-5.jpg',
                    'desc' => 'Sebuah novel tentang perjalanan keras sebuah tim sepakbola yang tidak diunggulkan, mengajarkan nilai sportivitas, perjuangan pantang menyerah, dan kekuatan kerja sama.', 
                    'subjects' => ['Sports', 'Drama', 'Indonesian Literature'], 'lang' => 'Indonesian'
                ],
                'rec-6' => [
                    'title' => 'Selamat Tinggal', 'author' => 'Tere Liye', 'cover' => 'selamat-tinggal.jpg',
                    'desc' => 'Novel yang ditulis oleh Tere Liye ini mengisahkan kisah seorang pemuda yang mencoba menemukan jati dirinya di tengah dunia yang penuh perubahan. Sebuah perjalanan emosional tentang kehilangan, kenangan, dan harapan yang tersisa.', 
                    'subjects' => ['Drama', 'Coming of Age', 'Indonesian Literature'], 'lang' => 'Indonesian'
                ],
            ];

            $found = $mockData[$id] ?? [
                'title' => 'Unknown Book', 'author' => 'Unknown Author', 
                'desc' => 'Details currently unavailable.', 
                'subjects' => ['General'], 'lang' => 'English'
            ];

            $this->book = (object)[
                'id' => $id,
                'title' => $found['title'],
                'author' => $found['author'],
                'description' => $found['desc'],
                'cover_image' => $found['cover'] ?? ($id . '.jpg'),
                'Category' => 'Fiction',
                'isbn' => '978-0000000000',
                'isAvailable' => true,
                'subjects' => $found['subjects'],
                'lang' => $found['lang'],
            ];
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.books.show');
    }
}
