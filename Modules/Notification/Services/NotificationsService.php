<?php

namespace Modules\Notification\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Auth\Entities\User;
use Modules\Notification\DataTransferObjects\NotificationDto;

class NotificationsService
{
    public static function create(NotificationDto $notificationDto)
    {
        DB::table('users')->orderBy('id')
            ->chunk(100, function ($users) use ($notificationDto) {
                $formattedNotifications = [];
                foreach ($users as $user) {

                    $formattedNotifications[] = [
                        'id' => Str::uuid(),
                        'type' => $notificationDto->type,
                        'notifiable_id' => $user->id,
                        'notifiable_type' => User::class,
                        'data' => \json_encode([
                            'title' =>  $notificationDto->title,
                            'body' =>  $notificationDto->body,
                        ]),
                        'locale' => $notificationDto->locale,
                        'created_at' => now()->toDateTimeString(),
                        'updated_at' => now()->toDateTimeString(),
                    ];
                }
                DB::table('notifications')->insert($formattedNotifications);
            });
    }
}