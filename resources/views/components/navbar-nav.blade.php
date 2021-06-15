<{{ $tag }}
    class="navbar-nav @if ($scroll)navbar-nav-scroll @endif{{ $attributes->get('class') }}"
    {{ $attributes }}
>
    {{ $slot }}
</{{ $tag }}>
