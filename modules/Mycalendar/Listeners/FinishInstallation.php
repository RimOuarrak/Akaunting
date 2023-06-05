<?php

namespace Modules\Mycalendar\Listeners;

use App\Events\Module\Installed as Event;
use App\Events\Menu\AdminCreated as Event2;
use App\Traits\Permissions;
use Artisan;

class FinishInstallation
{
    use Permissions;

    public $alias = 'mycalendar';

    /**
     * Handle the event.
     *
     * @param  Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        if ($event->alias != $this->alias) {
            return;
        }

        $this->updatePermissions();

        //$this->callSeeds();
    }

    protected function updatePermissions()
    {
        // c=create, r=read, u=update, d=delete
        $this->attachPermissionsToAdminRoles([
            $this->alias . '-posts' => 'c,r,u,d',
            $this->alias . '-comments' => 'c,r,u,d',
        ]);    
    }

    protected function callSeeds()
    {
        Artisan::call('company:seed', [
            'company' => company_id(),
            '--class' => 'Modules\Mycalendar\Database\Seeds\MycalendarDatabaseSeeder',
        ]);
    }
}