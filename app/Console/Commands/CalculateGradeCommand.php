<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CalculateGradeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:grade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will calculate school grade';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Calculating...');
        $this->error('ERROR FOUND!');
    }
}
