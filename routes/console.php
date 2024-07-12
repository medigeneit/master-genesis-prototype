<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\ConsoleOutput;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('se', function () {

    Artisan::call('serve',[
        '--port'  =>  8009,
        '--host'  =>  env('APP_HOST', gethostbyname(trim(`hostname`)))
    ], new ConsoleOutput()  );

})->purpose('Running server on port=8009 host=' . env('APP_HOST', gethostbyname(trim(`hostname`))));
