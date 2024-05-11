<?php
namespace App\Mail;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBookNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function build()
    {
        return $this->markdown('emails.new_book')->with([
            'title' => $this->book->title,
            'author' => $this->book->author->name // Assuming a single primary author for simplicity
        ]);
    }
}
