<?php

namespace App\Console\Commands;

use App\Models\DetailIklan;
use Illuminate\Console\Command;

class UpdateStatusIklan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status-iklan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status iklan berdasarkan tanggal mulai dan tanggal akhir';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         // Update status iklan menjadi aktif dimana tanggal mulai sama dengan tanggal saat ini
         DetailIklan::where('tanggal_mulai', date('Y-m-d'))->update(['status_iklan' => 'aktif']);

         // Update status iklan menjadi selesai dimana tanggal akhir tidak sama atau lebih kecil dari hari ini
         DetailIklan::where('tanggal_akhir', '<', date('Y-m-d'))->update(['status_iklan' => 'selesai']);

         $this->info('Status iklan telah diperbarui.');
    }
}
