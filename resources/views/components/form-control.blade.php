@unless ($type === 'textarea')
    <input 
@else
    <textarea 
@endunless
    class="form-control @error($name) is-invalid @enderror {{ $attributes->get('class') }}"
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    @unless ($type === 'textarea') type="{{ $type }}" @endunless
    @if (old($name) && $type !== 'textarea') value="{{ old($name) }}" @endif
    autocomplete="{{ $attributes->get('autocomplete') != 'on' ? 'off' : 'on' }}"
    {{ $attributes }}
>
@if ($type === 'textarea')@if (old($name)){{ old($name) }}@endif{{ $slot }}</textarea>@endif

@unless ($novalidate)
    <x-invalid-feedback name="{{ $name }}" />
@endunless
