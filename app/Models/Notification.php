<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_number',
        'msg',
        'graduate_id',
        'send_id',
        'deliver_code'
    ];

    public function graduates()
    {
        return $this->belongsTo(Graduate::class);
    }

    public static function getSummary($user_id)
    {
        $notifications = auth()->user()->unreadNotifications;
        $count = count($notifications);
        
        $lastNotifications = $notifications->take(10);
        $lastNotifications->markAsRead();

        return [
            'count' => $count,
            'notifications' => $lastNotifications,
        ];
    }
}
