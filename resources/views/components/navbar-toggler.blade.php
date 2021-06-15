<button
    {{ $attributes->class('navbar-toggler') }}
    data-bs-toggle="collapse"
    data-bs-target="{{ $target }}"
>
    @if ($slot->isEmpty())
        <span class="navbar-toggler-icon"></span>
    @else
        {{ $slot }}
    @endif
</button>
