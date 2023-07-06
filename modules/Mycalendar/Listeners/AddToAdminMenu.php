<?php

namespace Modules\Mycalendar\Listeners;

use App\Events\Menu\AdminCreated as Event;
use Illuminate\Support\Facades\Route;
use App\Models\Module\Module;
use Illuminate\Support\Facades\Auth;

class AddToAdminMenu
{
    public function handle(Event $event): void
    {
         $module = Module::alias('mycalendar')->first();

         if (!$module) {
             return; 
         }
         // Check if the 'enabled' attribute is 1.
         if ($module->enabled == 1) {
             // If 'enabled' attribute is 1, add the item to the menu.
 
             // Add new menu item
             $event->menu->add([
                 'url' => route('mycalendar.index'),
                 'title' => trans('Calendar'),
                 'icon' => 'simple-icons-googlecalendar',
                 'order' => 80,
             ]);
         } else if ($module->enabled == 0) {
             // If 'enabled' attribute is 0, do nothing (i.e., don't add the menu item).
             return;
         }

    }
} 
