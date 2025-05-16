<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    // Fetch all notifications for the authenticated user
    public function viewNotifications()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch all notifications for the user (both read and unread)
        $notifications = $user->notifications()->paginate(10); // Paginate for better performance

        // Fetch unread notifications for the user
        $unreadNotifications = $user->unreadNotifications;

        // Return the view with notifications
        return view('dashboard.notifications.index', compact('notifications', 'unreadNotifications'));
    }

    // Mark a notification as read
    public function markAsRead($id)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find the notification by ID
        $notification = $user->notifications()->findOrFail($id);

        // Mark the notification as read
        $notification->markAsRead();

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Notification marked as read.');
    }

    // Mark all notifications as read
    public function markAllAsRead()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Mark all unread notifications as read
        $user->unreadNotifications->markAsRead();

        // Redirect back with a success message
        return redirect()->back()->with('status', 'All notifications marked as read.');
    }

    // Delete a notification
    public function deleteNotification($id)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find the notification by ID
        $notification = $user->notifications()->findOrFail($id);

        // Delete the notification
        $notification->delete();

        // Redirect back with a success message
        return redirect()->back()->with('status', 'Notification deleted successfully.');
    }

    // Delete all notifications
    public function deleteAllNotifications()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Delete all notifications
        $user->notifications()->delete();

        // Redirect back with a success message
        return redirect()->back()->with('status', 'All notifications deleted successfully.');
    }
}