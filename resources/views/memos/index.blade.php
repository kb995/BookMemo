<section>
    @foreach ($memos as $memo)
    <div class="card mb-4">
        <div class="card-header">
            {{ $memo->id }}
        </div>
        <div class="card-body">
            {{ $memo->memo }}
        </div>

        <div class="card-footer memo-info">
            <a class="inline" href="{{ route('books.memos.edit', ['book' => $book, 'memo' => $memo]) }}">編集</a>
            <form class="delete-form" action="{{ route('books.memos.destroy', ['book' => $book, 'memo' => $memo]) }}" method="post" id="delete_memo_{{ $memo->id }}">
                @csrf
                @method('DELETE')
                <a class="inline text-danger" data-id="{{ $memo->id }}" onclick="deleteMemo(this);">
                    <i class="fas fa-trash-alt"></i>
                    削除
                </a>
            </form>
            {{ $memo->created_at }}
        </div>
    </div>
    @endforeach

    <div class="text-center">
        {{ $memos->links() }}
    </div>

</section>
