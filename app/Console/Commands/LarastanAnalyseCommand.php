<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class LarastanAnalyseCommand extends Command
{
    protected $signature = 'larastan {args?* : Arguments to pass to PHPStan}';

    protected $description = 'Run Larastan PHPStan analysis';

    /**
     * handle
     *
     * @return int
     */
    public function handle(): int
    {
        $args = $this->argument('args') ?: [];

        $command = array_merge([base_path('vendor/bin/phpstan'), 'analyse'], $args);

        $process = new Process($command);
        $process->setTty(true);

        // Execute the process
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });

        // Check if the process was successful
        if ($process->isSuccessful()) {
            $this->info('Larastan analysis completed successfully.');
            return 0;
        } else {
            $this->error('Larastan analysis failed.');
            return 1;
        }
    }
}
