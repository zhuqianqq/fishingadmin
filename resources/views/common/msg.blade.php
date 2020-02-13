@foreach (['success', 'warning', 'danger', 'info'] as $item)
@if (session($item))
<div class="alert alert-{{ $item }}">
    <ul>
        <li>{{ session($item) }}</li>
    </ul>
</div>
@endif
@endforeach