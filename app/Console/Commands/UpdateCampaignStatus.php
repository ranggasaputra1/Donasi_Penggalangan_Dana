<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Campaign;
use Illuminate\Support\Carbon;

class UpdateCampaignStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaign:status:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update campaign status based on end date';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $campaigns = Campaign::where('tgl_akhir_campaign', '<', Carbon::now()->toDateString())->get();

        foreach ($campaigns as $campaign) {
            $campaign->status_campaign = '3';
            $campaign->save();
        }

        $this->info('Campaign statuses updated successfully.');
    }
}
