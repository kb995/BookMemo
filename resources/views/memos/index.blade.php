<article class="mx-auto w-50">
    @foreach ($memos as $memo)
        <div class="card my-5 p-3">
            {{ $memo->id }} : {{ $memo->memo }}
        </div>
    @endforeach
</article>
