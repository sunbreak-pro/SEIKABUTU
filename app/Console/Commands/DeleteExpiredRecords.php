<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TodoList;
use Carbon\Carbon;

class DeleteExpiredRecords extends Command
{
    protected $signature = 'records:delete-expired';
    protected $description = 'Delete records that have expired';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $deletedRecords = TodoList::where('expired_at', '<', Carbon::now())->where('archievement', 0)->delete();
        $this->info("Deleted {$deletedRecords} expired records.");
    }
}
