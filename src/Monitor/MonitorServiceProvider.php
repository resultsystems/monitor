<?php

namespace ResultSystems\Monitor;

use DB;
use Illuminate\Support\ServiceProvider;
use ResultSystems\Monitor\Routes\Console;
use ResultSystems\Monitor\Console\QueriesLogCommand;
use ResultSystems\Monitor\Console\LaravelLogCommand;

class MonitorServiceProvider extends ServiceProvider
{
    protected $providers = [
        RouteServiceProvider::class
    ];

    public function boot()
    {
        $file = storage_path('/logs/queries.log');
        if (!file_exists($file)) {
            return;
        }

        DB::listen(function ($query) use ($file) {
            $data = $query->sql."\n";
            $data .= print_r($query->bindings, true);
            $data .= 'TIME: '.$query->time."\n";
            $data .= "----\n";
            $data .= "\n";
            file_put_contents($file, $data, FILE_APPEND);
        });
    }

    public function register()
    {
        $this->commands([
            QueriesLogCommand::class,
            LaravelLogCommand::class,
        ]);
    }
}
