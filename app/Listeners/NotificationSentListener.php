<?php

namespace App\Listeners;

use App\Models\DeviceToken;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use NotificationChannels\Fcm\FcmChannel;

class NotificationSentListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        if ($event->channel === FcmChannel::class) {
            if ($event->response && (count($event->response[0]->unknownTokens()) > 0 || count($event->response[0]->invalidTokens()) > 0)) {
                Log::info('Invalid or unknown FCM token');
                Log::debug(array_merge($event->response[0]->unknownTokens(), $event->response[0]->invalidTokens()));
            }
        }
    }
}
