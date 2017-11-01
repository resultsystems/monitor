<?php

namespace ResultSystems\Monitor\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class QueriesLogCommand extends Command
{
    /**
     * @var null|string
     */
    private $logFile = null;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:queries {--stop : Stop log}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Log database queries.';

    /**
     * Create a new command instance.
     * @param string $filename
     */
    public function __construct()
    {
        parent::__construct();
        $this->logFile = storage_path('logs/queries.log');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->option('stop')) {
            return $this->start();
        }

        if (file_exists($this->logFile)) {
            exec("rm " . $this->logFile);
        }
    }

    public function start()
    {
        // create log file
        exec('touch '.$this->logFile);
        // run tail and send outputs to the user console.
        (new Process('clear && tail -f '.escapeshellarg($this->logFile)))
            ->setTimeout(null)
            ->run(function ($type, $line) {
                $this->output->write($line);
            });
    }
}
