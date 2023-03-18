<?php

namespace App\Jobs;

use App\Notifications\vacancyNotification;
use App\Models\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class VacancyNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The notification instance.
     *
     * @var \App\Models\notification
     */
    protected $notification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(VacancyNotification $vacancyNotification)
    {
        $this->vacancyNotification = $vacancyNotification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Notifications $notification)
    {
        
    }
}
