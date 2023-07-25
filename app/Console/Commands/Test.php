<?php

namespace App\Console\Commands;

use App\Models\Contract;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:Test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $contracts=Contract::get();
        if($contracts){
            foreach ($contracts as $contract){
                if($contract->end_date == date('Y-m-d') || $contract->end_date < date('Y-m-d')){
                    $contract_status            =   Contract::find($contract->id);
                    $contract_status->status    =   'Expired';
                    $contract_status->save();
                }
            }
        }

    }
}
