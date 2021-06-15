<{{ $tag }}
    class="navbar @if ($type)navbar-{{ $type }} bg-{{ $type }}@endif @if ($expand)navbar-expand-{{ $expand }}@endif {{ $attributes->get('class') }}"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $tag }}>
