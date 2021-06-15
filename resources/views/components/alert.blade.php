<div class="alert alert-{{ $type }} d-flex align-items-center fade show" role="alert" {{ $attributes }}>
    @unless($noicon)
        <i class="bi
        @switch($type)
            @case('success')
                bi-check-circle-fill
                @break
            @case('info')
                bi-info-circle-fill
                @break
            @case('warning')
            @case('danger')
                bi-exclamation-triangle-fill
            @default
                @break
        @endswitch
        flex-shrink-0 me-3 fs-4 lh-1"></i>
    @endunless

    <div>{{ $slot }}</div>
</div>
