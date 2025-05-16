@extends("layouts.dashboard")

@section('content')
<main id="main" class="main">
    <div class="card-header">
        <strong class="card-title user-pg">Notifications Page</strong>
    </div><br>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <!-- Mark All as Read Button -->
                <div class="mb-3">
                    <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Mark All as Read</button>
                    </form>
                </div>

                <!-- Notifications List -->
                <div class="list-group">
                    @forelse ($notifications as $notification)
                        <div class="list-group-item {{ $notification->unread() ? 'unread-notification' : '' }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">{{ $notification->data['title'] }}</h5>
                                    <p class="mb-1">{{ $notification->data['message'] }}</p>
                                    <small class="text-muted">
                                        {{ $notification->data['user'] }} | {{ $notification->data['department'] }} | {{ $notification->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <div>
                                    @if ($notification->unread())
                                        <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Mark as Read</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item">
                            <p class="mb-0">No notifications found.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination Links -->
                <div class="mt-3">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Optional: Add some CSS for unread notifications -->
<style>
    .unread-notification {
        background-color: #f8f9fa;
        border-left: 4px solid #007bff;
    }
</style>
@endsection