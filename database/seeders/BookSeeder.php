<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            // Just Added Section
            [
                'title' => 'At Night All Blood Is Black',
                'author' => 'David Diop',
                'isbn' => '9781250774931',
                'cover_image' => 'j-book1.jpg',
                'description' => 'A haunting and powerful story of a young Senegalese soldier on the front lines of World War I.',
                'Category' => 'Just Added'
            ],
            [
                'title' => 'I Live in the Slums',
                'author' => 'Can Xue',
                'isbn' => '9780300246112',
                'cover_image' => 'j-book2.jpg',
                'description' => 'A collection of surreal stories by one of the most original voices in contemporary Chinese literature.',
                'Category' => 'Just Added'
            ],
            [
                'title' => 'Minor Detail',
                'author' => 'Adania Shibli',
                'isbn' => '9780811229074',
                'cover_image' => 'j-book3.jpg',
                'description' => 'A meditation on war, violence, and the burden of memory in the Israeli-Palestinian conflict.',
                'Category' => 'Just Added'
            ],
            [
                'title' => 'When We Cease to Understand the World',
                'author' => 'Benjamin Labatut',
                'isbn' => '9781681375632',
                'cover_image' => 'j-book4.jpg',
                'description' => 'A fascinating dive into the lives of some of the most brilliant scientists and mathematicians in history.',
                'Category' => 'Just Added'
            ],
            [
                'title' => 'The Power of Focus',
                'author' => 'Brian Tracy',
                'isbn' => '9781558747524',
                'cover_image' => 'j-book5.jpg',
                'description' => 'Practical advice for achieving success by focusing on what truly matters.',
                'Category' => 'Just Added'
            ],
            [
                'title' => 'Arsus',
                'author' => 'Ahmed Al Hamdan',
                'isbn' => '9786030366651',
                'cover_image' => 'book-extra1.jpg',
                'description' => 'An Arabic literature title by Ahmed Al Hamdan.',
                'Category' => 'Just Added'
            ],

            // Mental Health Section
            [
                'title' => 'Stop Letting Everything Affect You',
                'author' => 'Daniel Chidiac',
                'isbn' => '9781732646209',
                'cover_image' => 'm-book1.jpg',
                'description' => 'A guide to psychological resilience and personal development.',
                'Category' => 'Mental Health'
            ],
            [
                'title' => 'Afraid',
                'author' => 'Arash Javanbakht, MD',
                'isbn' => '9781538161746',
                'cover_image' => 'm-book2.jpg',
                'description' => 'An exploration of fear, anxiety, and the modern world.',
                'Category' => 'Mental Health'
            ],
            [
                'title' => 'The Body Keeps the Score',
                'author' => 'Bessel van der Kolk, M.D.',
                'isbn' => '9780143127741',
                'cover_image' => 'm-book3.jpg',
                'description' => 'Brain, mind, and body in the healing of trauma.',
                'Category' => 'Mental Health'
            ],
            [
                'title' => 'The Body Keeps the Score Edition 2',
                'author' => 'Bessel van der Kolk, M.D.',
                'isbn' => '978014312774x',
                'cover_image' => 'm-book4.jpg',
                'description' => 'Alternative edition exploring brain, mind, and body in the healing of trauma.',
                'Category' => 'Mental Health'
            ],
            [
                'title' => 'Unwinding Anxiety',
                'author' => 'Judson Brewer, MD, PhD',
                'isbn' => '9780593330449',
                'cover_image' => 'm-book5.jpg',
                'description' => 'New science shows how to break the cycles of worry and fear to heal your mind.',
                'Category' => 'Mental Health'
            ],
            [
                'title' => 'The Cabinet',
                'author' => 'Un-Su Kim',
                'isbn' => '9781911284598',
                'cover_image' => 'book-extra2.jpg',
                'description' => 'A quirky, surreal novel from Korea that won the Munhakdongne Novel Award.',
                'Category' => 'Mental Health'
            ],

            // Korean Literature Section
            [
                'title' => 'Kim Jiyoung, Born 1982',
                'author' => 'Cho Nam-joo',
                'isbn' => '9781631496707',
                'cover_image' => 'k-book1.jpg',
                'description' => 'A powerful novel that sparked a conversation about women in contemporary Korea.',
                'Category' => 'Korean Literature'
            ],
            [
                'title' => 'Eligible',
                'author' => 'Curtis Sittenfeld',
                'isbn' => '9781400068326',
                'cover_image' => 'k-book2.jpg',
                'description' => 'A modern retelling of Pride and Prejudice.',
                'Category' => 'Korean Literature'
            ],
            [
                'title' => 'At Dusk',
                'author' => 'Hwang Sok-yong',
                'isbn' => '9781911284246',
                'cover_image' => 'k-book3.jpg',
                'description' => 'A thoughtful exploration of architectural memory and social change in Korea.',
                'Category' => 'Korean Literature'
            ],
            [
                'title' => 'Beasts of a Little Land',
                'author' => 'Juhea Kim',
                'isbn' => '9780063094093',
                'cover_image' => 'k-book4.jpg',
                'description' => 'An epic tale of love, war, and redemption set in 20th-century Korea.',
                'Category' => 'Korean Literature'
            ],
            [
                'title' => 'Kim Jiyoung, Born 1982 Edition 2',
                'author' => 'Cho Nam-joo',
                'isbn' => '978163149670x',
                'cover_image' => 'k-book5.jpg',
                'description' => 'Alternative edition of Kim Jiyoung, Born 1982.',
                'Category' => 'Korean Literature'
            ],
        ];

        foreach ($books as $bookData) {
            Book::updateOrCreate(
                ['isbn' => $bookData['isbn']],
                $bookData
            );
        }
    }
}

