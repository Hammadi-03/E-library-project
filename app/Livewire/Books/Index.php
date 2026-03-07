<?php

namespace App\Livewire\Books;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Book;


class Index extends Component
{

    use WithPagination;

    //for Property search & Filter
    public string $search = '';
    public string $category = ''; 

     //Property for Modal edit
    public bool $showModal = false;
    public bool $isEdit = false;
    public ?int $bookId = null;

    //Property For Form (wire:model)
    public string $title = '';
    public string $author = '';
    public string $isbn = '';
    public string $cover_image = '';
    public string $description = '';
    public string $Category = '';



    //Property for Delete Confirmation 🗑️
   public bool $showDeleteModal = false; 
   public ?int $deleteId = null;
   
   //Save serch/filter in URL so that can bookmarked 
   protected $queryString = ['search', 'category' ];

   //validation rules 
   protected function rules()
   {
     return[
        'title' => 'required|min:3|max:255',
        'author' => 'required|min:3|max:255',
        'isbn' => 'required|unique:books,isbn,' . $this->bookId,
        'description' => 'nullable',
        'Category' => 'nullable',
     ];

   }


   // Reset Page when the category bears diffrent
   public function updatedCategory()
   {
    $this->resetPage();
   }    

   public function openModal()
   {
     $this->showModal = true;
     $this->resetForm();
     $this->isEdit = false;
   }


   //


  //open modal edit - fill from with book data that is choosen
  public function editBook($id)
  {
    $book = Book::findOrFail($id);
    $this->bookId = $book->id;
    $this->title = $book->title;
    $this->author = $book->author;
    $this->isbn = $book->isbn;
    $this->description = $book->description;
    $this->cover_image = $book->cover_image;
    $this->Category = $book->Category;

    $this->showModal = true;
    $this->isEdit = true;     //mode: edit

  }

  public function save()
    {
        $this->validate();

        $data = [
            'title'       => $this->title,
            'author'      => $this->author,
            'isbn'        => $this->isbn,
            'cover_image' => $this->cover_image ?: '',
            'description' => $this->description,
            'Category'    => $this->Category,
        ];

        if ($this->isEdit && $this->bookId) {
            Book::find($this->bookId)->update($data);
            session()->flash('message', __('app.msg_book_updated'));
        } else {
            Book::create($data);
            session()->flash('message', __('app.msg_book_saved'));
        }

        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function deleteBook()
    {
        if ($this->deleteId) {
            Book::find($this->deleteId)->delete();
            session()->flash('message', __('app.msg_book_deleted'));
        }
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->bookId = null;
        $this->title = '';
        $this->author = '';
        $this->isbn = '';
        $this->cover_image = '';
        $this->description = '';
        $this->Category = '';
        $this->isEdit = false;
    }

    public function render()
    {
        $books = Book::query()
            ->when($this->search, fn($q) => $q->where(function($q2) {
                $q2->where('title', 'like', "%{$this->search}%")
                   ->orWhere('author', 'like', "%{$this->search}%");
            }))
            ->when($this->category && trim($this->category) !== '', fn($q) => $q->where('Category', $this->category))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categoriesList = Book::whereNotNull('Category')->distinct()->pluck('Category');

        return view('livewire.books.index', [
            'books' => $books,
            'categoriesList' => $categoriesList,
        ])->layout('layouts.app');
    }
}

