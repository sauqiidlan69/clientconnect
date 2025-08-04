@props(['status'])

@if ($status)
    <div class="mb-4 font-medium text-sm text-success">
        {{ $status }}
    </div>
@endif
@if ($errors->any())
    <div class="mb-4 font-medium text-sm text-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif