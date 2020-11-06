<article class="mx-auto w-50">
    @foreach ($memos as $memo)
    <div class="card mb-4">
        <div class="p-3 inline">
            {{ $memo->id }} : {{ $memo->memo }}
            <a class="inline" href="{{ route('books.memos.edit', ['book' => $book, 'memo' => $memo]) }}">編集</a>

            <form action="{{ route('books.memos.destroy', ['book' => $book, 'memo' => $memo]) }}" method="post" id="delete_memo_{{ $memo->id }}">
                @csrf
                @method('DELETE')
                <a class="inline text-danger" data-id="{{ $memo->id }}" onclick="deleteMemo(this);">
                    <i class="fas fa-trash-alt pr-1"></i>
                    削除
                </a>
            </form>

        </div>
    </div>
    @endforeach
</article>
