<?php

namespace App\Policies;

use App\Models\Book;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Book $book)
    {
        return $user->id == $book->user_id;
    }

    public function update(User $user, Book $book)
    {
        return $user->id == $book->user_id;
    }

    public function delete(User $user, Book $book)
    {
        return $user->id == $book->user_id;
    }

}
