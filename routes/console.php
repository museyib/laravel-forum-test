<?php

use Illuminate\Foundation\Inspiring;

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
})->describe('Display an inspiring quote');

Artisan::command('customer:company-clean', function () {
    $this->info('cleaning');

    \App\Company::whereDoesntHave('customers')->get()->each(function ($company) {
        $company->delete();

        $this->warn('Deleted: ' . $company->name);
    });
})->describe('Cleans up unused companies');
