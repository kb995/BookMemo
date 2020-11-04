@if ($errors->any())
    <div class="alert alert-danger w-50 mx-auto">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
