@unless ($breadcrumbs->isEmpty())
<div class="breadcrumbs">
    <p class="breadcrumbs__text">
        @foreach ($breadcrumbs as $breadcrumb)
        @if (!is_null($breadcrumb->url) && !$loop->last)
        <a href="{{ $breadcrumb->url }}" class="breadcrumbs__link">{{ $breadcrumb->title }}</a>
        <span class="breadcrumbs__arrow">»</span>
        @else
        {{ $breadcrumb->title }}
        @endif
        @endforeach
    </p>
</div>
@endunless