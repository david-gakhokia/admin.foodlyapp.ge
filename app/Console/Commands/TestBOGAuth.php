<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BOG\BOGAuthService;

class TestBOGAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bog:test-auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test BOG API authentication';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔐 Testing BOG Authentication...');
        $this->newLine();

        try {
            $authService = new BOGAuthService();
            $result = $authService->testAuthentication();

            if ($result['success']) {
                $this->info('✅ ' . $result['message']);
                $this->line('🔑 Token Preview: ' . $result['token_preview']);
                $this->line('🌍 Environment: ' . $result['environment']);
            } else {
                $this->error('❌ ' . $result['message']);
                $this->line('🌍 Environment: ' . $result['environment']);
            }

        } catch (\Exception $e) {
            $this->error('❌ Exception: ' . $e->getMessage());
        }

        $this->newLine();
    }
}
