@php
    $status = optional($document->review)->status ?? 'pending';
    $statusConfig = [
        'approved' => ['Approved', 'check-circle', 'success'],
        'rejected' => ['Rejected', 'times-circle', 'danger'],
        'assigned' => ['Assigned', 'user-check', 'primary'],
        'in_review' => ['In Review', 'eye', 'info'],
        'verdict_passed' => ['Verdict Passed', 'gavel', 'success'],
        'pending' => ['Pending', 'hourglass-half', 'warning']
    ][$status] ?? ['Pending', 'hourglass-half', 'warning'];
@endphp

<span class="badge bg-{{ $statusConfig[2] }}">
    <i class="fas fa-{{ $statusConfig[1] }}"></i> {{ $statusConfig[0] }}
</span>