<?php

namespace App\Jobs;

use App\Models\Announcement;
use App\Models\User;
use App\Notifications\AnnouncementNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAnnouncementNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $announcementId;

    public function __construct($announcementId)
    {
        $this->announcementId = $announcementId;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $announcement = Announcement::find($this->announcementId);

        if ($announcement) {
            $usersWithFCMToken = User::whereNotNull('fcm_token')->get();
            foreach ($usersWithFCMToken as $user) {
                $user->notify(new AnnouncementNotification(
                    $announcement->id,
                    $announcement->title,
                    $announcement->description
                ));
            }
        }
    }
}
