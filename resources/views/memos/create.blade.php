<form method="POST" action="{{ route('books.memos.store', ['book' => $book]) }}" class="card p-4 my-4">
    @csrf
    <div class="form-group">
        <label for="memo"></label>
        <textarea class="form-control" id="memo" name="memo" value="{{ old('memo') }}" rows="4" cols="40" placeholder="読書メモ"></textarea>
        <input type="submit" class="btn btn-primary my-4">
    </div>
</form>
