@php
    $badgeClass = match ($loan->status) {
        'approved' => 'success',
        'rejected' => 'danger',
        'returned' => 'secondary',
        default => 'warning',
    };
@endphp
<span class="badge badge-{{ $badgeClass }}">{{ strtoupper($loan->status) }}</span>
