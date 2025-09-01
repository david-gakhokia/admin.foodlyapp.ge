<?php

<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\AnalyticsReport;
use App\Models\BOGTransaction;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class AnalyticsApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user);
    }

    /** @test */
    public function it_can_get_dashboard_overview()
    {
        // Create some test data
        BOGTransaction::factory()->count(10)->create();
        Reservation::factory()->count(15)->create();

        $response = $this->getJson('/api/admin/analytics/dashboard');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'reservations' => [
                            'total',
                            'confirmed',
                            'cancelled',
                            'pending',
                            'conversion_rate',
                            'growth_percentage'
                        ],
                        'payments' => [
                            'total_transactions',
                            'successful_transactions',
                            'failed_transactions',
                            'success_rate',
                            'total_revenue'
                        ],
                        'revenue' => [
                            'total',
                            'average_per_reservation',
                            'growth_percentage'
                        ]
                    ]
                ]);
    }

    /** @test */
    public function it_can_get_bog_payment_analytics()
    {
        BOGTransaction::factory()->count(20)->create();

        $response = $this->getJson('/api/admin/analytics/bog-payments', [
            'from_date' => now()->startOfMonth()->toDateString(),
            'to_date' => now()->endOfMonth()->toDateString(),
            'period' => 'day'
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'time_series',
                        'status_breakdown',
                        'payment_methods',
                        'error_analysis',
                        'summary' => [
                            'total_transactions',
                            'success_rate',
                            'total_revenue',
                            'average_transaction_amount'
                        ]
                    ]
                ]);
    }

    /** @test */
    public function it_can_get_reservation_analytics()
    {
        Reservation::factory()->count(25)->create();

        $response = $this->getJson('/api/admin/analytics/reservations', [
            'from_date' => now()->startOfWeek()->toDateString(),
            'to_date' => now()->endOfWeek()->toDateString(),
            'period' => 'day'
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'time_series',
                        'status_distribution',
                        'guest_analysis',
                        'peak_hours',
                        'day_of_week_analysis',
                        'summary'
                    ]
                ]);
    }

    /** @test */
    public function it_can_get_revenue_analytics()
    {
        BOGTransaction::factory()->count(15)->create();

        $response = $this->getJson('/api/admin/analytics/revenue', [
            'from_date' => now()->startOfMonth()->toDateString(),
            'to_date' => now()->toDateString(),
            'period' => 'day',
            'include_projections' => true
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'time_series',
                        'revenue_by_restaurant',
                        'summary',
                        'projections'
                    ]
                ]);
    }

    /** @test */
    public function it_can_get_conversion_funnel()
    {
        // Create related data
        Reservation::factory()->count(10)->create();
        BOGTransaction::factory()->count(8)->create();

        $response = $this->getJson('/api/admin/analytics/conversion-funnel');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'steps' => [
                            '*' => [
                                'name',
                                'count',
                                'percentage',
                                'drop_off'
                            ]
                        ],
                        'overall_conversion_rate',
                        'payment_conversion_rate'
                    ]
                ]);
    }

    /** @test */
    public function it_can_get_real_time_analytics()
    {
        // Create recent data
        Reservation::factory()->count(5)->create(['created_at' => now()->subHours(2)]);
        BOGTransaction::factory()->count(4)->create(['created_at' => now()->subHour()]);

        $response = $this->getJson('/api/admin/analytics/real-time', [
            'hours' => 12
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'current_hour',
                        'last_24_hours',
                        'hourly_breakdown'
                    ]
                ]);
    }

    /** @test */
    public function it_can_export_analytics()
    {
        $response = $this->postJson('/api/admin/analytics/export', [
            'type' => 'bog_payments',
            'from_date' => now()->startOfMonth()->toDateString(),
            'to_date' => now()->toDateString(),
            'format' => 'csv'
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => [
                        'estimated_completion'
                    ]
                ]);
    }

    /** @test */
    public function it_validates_export_request()
    {
        $response = $this->postJson('/api/admin/analytics/export', [
            'type' => 'invalid_type',
            'format' => 'invalid_format'
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['type', 'format']);
    }

    /** @test */
    public function it_can_list_analytics_reports()
    {
        AnalyticsReport::factory()->count(5)->create(['generated_by' => $this->user->id]);

        $response = $this->getJson('/api/admin/analytics/reports');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'reports',
                        'pagination' => [
                            'current_page',
                            'last_page',
                            'per_page',
                            'total'
                        ]
                    ]
                ]);
    }

    /** @test */
    public function it_can_show_analytics_report()
    {
        $report = AnalyticsReport::factory()->create(['generated_by' => $this->user->id]);

        $response = $this->getJson("/api/admin/analytics/reports/{$report->id}");

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data' => [
                        'id',
                        'type',
                        'name',
                        'description',
                        'filters',
                        'generated_at',
                        'generated_by',
                        'expires_at',
                        'is_expired'
                    ]
                ]);
    }

    /** @test */
    public function it_can_delete_analytics_report()
    {
        $report = AnalyticsReport::factory()->create(['generated_by' => $this->user->id]);

        $response = $this->deleteJson("/api/admin/analytics/reports/{$report->id}");

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Analytics report deleted successfully'
                ]);

        $this->assertDatabaseMissing('analytics_reports', ['id' => $report->id]);
    }

    /** @test */
    public function it_requires_authentication()
    {
        auth()->logout();

        $response = $this->getJson('/api/admin/analytics/dashboard');

        $response->assertStatus(401);
    }

    /** @test */
    public function it_validates_date_ranges()
    {
        $response = $this->getJson('/api/admin/analytics/dashboard', [
            'from_date' => '2024-12-01',
            'to_date' => '2024-11-01' // to_date before from_date
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['to_date']);
    }

    /** @test */
    public function it_filters_by_restaurant_id()
    {
        BOGTransaction::factory()->count(10)->create();

        $response = $this->getJson('/api/admin/analytics/bog-payments', [
            'restaurant_id' => 1
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_handles_invalid_restaurant_id()
    {
        $response = $this->getJson('/api/admin/analytics/dashboard', [
            'restaurant_id' => 9999 // Non-existent restaurant
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['restaurant_id']);
    }

    /** @test */
    public function it_can_filter_reports_by_type()
    {
        AnalyticsReport::factory()->count(3)->create(['type' => 'bog_payments']);
        AnalyticsReport::factory()->count(2)->create(['type' => 'reservations']);

        $response = $this->getJson('/api/admin/analytics/reports', [
            'type' => 'bog_payments'
        ]);

        $response->assertStatus(200);
        $data = $response->json('data.reports');
        
        $this->assertCount(3, $data);
        foreach ($data as $report) {
            $this->assertEquals('bog_payments', $report['type']);
        }
    }

    /** @test */
    public function it_paginates_reports_correctly()
    {
        AnalyticsReport::factory()->count(20)->create();

        $response = $this->getJson('/api/admin/analytics/reports', [
            'per_page' => 5
        ]);

        $response->assertStatus(200);
        $pagination = $response->json('data.pagination');
        
        $this->assertEquals(5, $pagination['per_page']);
        $this->assertEquals(4, $pagination['last_page']); // 20 reports / 5 per page
        $this->assertEquals(20, $pagination['total']);
    }
}
