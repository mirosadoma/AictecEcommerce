<?php

namespace App\Jobs;

use App\Support\SMS;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $msg;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $msg)
    {
        $this->user = $user;
        $this->msg = $msg;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            (new SMS)->setPhone($this->user->full_phone)->SetMessage($this->msg)->build();
        } catch (\Exception $th) {
            Log::info($th->getMessage());
        }
    }
}
