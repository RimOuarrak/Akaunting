<?php

namespace Modules\Calendar\Listeners;

use App\Events\Menu\AdminCreated as Event;

class AddToAdminMenu
{
    public function handle(Event $event): void
    {
        // Add child to existing menu item
        $item = $event->menu->whereTitle(trans_choice('general.calendar', 2));
        // $item->route('calendar.posts.index', trans('calendar::general.posts'), [], 4, ['icon' => '']);

        // Add new menu item
        $event->menu->add([
            'url' => route('calendar.index'),
            'title' => trans('calendar::general.name'),
            'icon' => 'simple-icons-googlecalendar',
            'order' => 80,
        ]);

    }
} 
