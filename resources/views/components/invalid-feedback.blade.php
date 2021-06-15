@error($name)
    <span class="invalid-feedback" role="alert">
        @if ($slot->isEmpty())
            {{ $message }}
        @else
            {{ $slot }}
        @endif
    </span>
@enderror
