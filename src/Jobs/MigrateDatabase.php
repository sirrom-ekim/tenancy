<?php

declare(strict_types=1);

namespace Stancl\Tenancy\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Stancl\Tenancy\Database\Models\Tenant;

class MigrateDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var Tenant */
    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $migrationParameters = [
            // todo ...
        ];

        Artisan::call('tenants:migrate', [
            '--tenants' => [$this->tenant->id],
        ] + $migrationParameters);
    }
}