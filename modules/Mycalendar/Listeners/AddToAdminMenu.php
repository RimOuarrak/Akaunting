<?php

namespace Modules\Mycalendar\Listeners;

use App\Events\Menu\AdminCreated as Event;

class AddToAdminMenu
{
    public function handle(Event $event): void
    {
        // Add child to existing menu item
        $item = $event->menu->whereTitle(trans_choice('general.mycalendar', 2));
        // $item->route('calendar.posts.index', trans('calendar::general.posts'), [], 4, ['icon' => '']);

        // Add new menu item
        $event->menu->add([
            'url' => route('mycalendar.index'),
            'title' => trans('Calendar'),
            'icon' => 'simple-icons-googlecalendar',
            'order' => 80,
        ]);

    }
} 
