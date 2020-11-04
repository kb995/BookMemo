<article class="mx-auto w-50">
    @foreach ($memos as $memo)
    <div class="card mb-4">
        <div class="p-3 inline">
            {{ $memo->id }} : {{ $memo->memo }}
            <a class="inline" href="{{ route('books.memos.edit', ['book' => $book, 'memo' => $memo]) }}">編集</a>
            <a class="inline text-danger" href="{{ route('books.memos.destroy') }}">削除</a>
        </div>
    </div>
    @endforeach
</article>
