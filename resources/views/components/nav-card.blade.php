@props(['route', 'label'])

<a href="{{ route($route) }}" class="btn btn-outline-primary px-3 py-2 text-nowrap">
  {{ $label }}
</a>