<section>

    @if (Session::has('search_mtag'))
        <div class="card my-4 py-2 px-3 h3">
          「 {{ Session::get('search_mtag') }} 」を表示中 (1-12 / 100件中)
        </div>
    @endif
    <div class="card my-4 py-2 px-3">
        <div class="d-flex">
        <span class="pl-3">
            <a href="{{ route('books.show', ['book' => $book]) }}">メモ一覧</a>
        </span>
        <span class="pl-3">ストック一覧</span>

        {{-- <form action="" method="get" class="pl-3">
            @csrf
            <select onChange="location.href=value;">
                <option value="">default</option>
                @foreach($bookTags as $mtag)
                <option value="{{ route(books.show.mtag, ['book' => $book, 'mtag' =>$mtag]) }}">{{ $mtag->name }}</option>
                @endforeach
            </select>
        </form> --}}

        {{--  --}}
        <form action="" method="">
            @csrf
                <select onChange="location.href=value;">
                    @foreach($bookTags as $mtag)
                        @if ($loop->first)
                        <option selected>タグで検索</option>
                        @endif
                        <option value="{{ route('books.show.mtag', ['book' => $book, 'mtag' => $mtag]) }}">
                            {{ $mtag->name }}
                        </option>
                    @endforeach
                </select>
        </form>
        {{--  --}}

        <span class="pl-3">キーワード検索</span>
        <span class="pl-3"><a href="{{ route('books.index') }}">書籍一覧</a></span>
    </div>
    </div>

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

            @foreach($memo->tags as $tag)
                <a href=" {{ route('books.show.mtag', ['book' => $book, 'mtag' => $tag]) }}" class="border p-1 mr-1 mt-1 text-muted">
                {{ $tag->hashtag }}
                </a>
            @endforeach

        </div>
    </div>
    @endforeach

    <div class="text-center">
        {{ $memos->links() }}
    </div>

</section>
