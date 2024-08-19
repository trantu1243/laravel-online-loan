<?php

namespace App\Console\Commands;

use App\Models\CustomerInfo;
use Illuminate\Console\Command;

class ResetReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $day = now()->day;

        $customers = CustomerInfo::with(['loan'])->where('day', $day)->where('month_num', '>', 0)->get();

        foreach ($customers as $customer){
            $rate = $customer->loan->rate / 1200;
            $pv = $customer->loan->amount * 1000000;
            $nper = $customer->loan->duration;

            $m = $pv / $nper;

            $pvif = pow(1 + $rate, $nper);
            $m = ($rate * $pv * ($pvif)) / ($pvif - 1);

            $m = round($m, -3);

            if ($customer->debt != null && $customer->debt > 0){
                $customer->debt += $m;
                $customer->month_debt += 1;
            } else {
                $customer->paid = false;
                $customer->month_debt = 0;
                $customer->num_reminder = 0;
                $customer->debt += $m;

            }
            $customer->month_num -= 1;
            $customer->save();
        }
    }


}
