<?php

namespace Modules\Modulescon\Listeners;

use App\Events\Menu\SettingsCreated as Event;

class AddToSettingsMenu
{
    public function handle(Event $event): void
    {
        $event->menu->route('modulescon.settings.edit', trans('modulescon::general.name'), [], 180, [
            'icon' => 'edit',
            'search_keywords' => trans('modulescon::general.description'),
        ]);
    }
}