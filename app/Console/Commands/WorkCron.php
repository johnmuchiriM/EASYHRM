<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Attendances\Entities\Attendance;
use Modules\Tasks\Entities\Task;

class WorkCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'work:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage Attedance And Task';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $todayDateTime = \Carbon\Carbon::now()->format('Y-m-d H:i');  
        Attendance::where('logged_out' == NUll)->update(['logged_out'=>$todayDateTime]);
        Task::where('status' == 'O')->update(['status'=>'S']);
    }
}
