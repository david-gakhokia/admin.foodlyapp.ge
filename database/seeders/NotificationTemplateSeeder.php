<?php

namespace Database\Seeders;

use App\Models\NotificationTemplate;
use App\Models\NotificationRule;
use Illuminate\Database\Seeder;

class NotificationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        NotificationTemplate::truncate();
        NotificationRule::truncate();

        // Create notification templates
        $templates = [
            // Reservation Requested
            [
                'event_key' => 'reservation.requested',
                'recipient_type' => 'manager',
                'provider' => 'sendgrid',
                'provider_template_id' => 'd-xxxxx1', // Replace with actual SendGrid template ID
                'default_data' => [
                    'action_required' => true,
                    'action_url' => config('app.frontend_url') . '/admin/reservations',
                ],
                'is_active' => true,
            ],
            [
                'event_key' => 'reservation.requested',
                'recipient_type' => 'client',
                'provider' => 'sendgrid',
                'provider_template_id' => 'd-xxxxx2', // Replace with actual SendGrid template ID
                'default_data' => [
                    'message' => 'Your reservation request has been submitted and is pending approval.',
                ],
                'is_active' => true,
            ],

            // Reservation Confirmed
            [
                'event_key' => 'reservation.confirmed',
                'recipient_type' => 'client',
                'provider' => 'sendgrid',
                'provider_template_id' => 'd-xxxxx3', // Replace with actual SendGrid template ID
                'default_data' => [
                    'message' => 'Your reservation has been confirmed!',
                ],
                'is_active' => true,
            ],
            [
                'event_key' => 'reservation.confirmed',
                'recipient_type' => 'manager',
                'provider' => 'sendgrid',
                'provider_template_id' => 'd-xxxxx4', // Replace with actual SendGrid template ID
                'default_data' => [
                    'message' => 'Reservation confirmed - prepare for guest arrival.',
                ],
                'is_active' => true,
            ],

            // Reservation Declined
            [
                'event_key' => 'reservation.declined',
                'recipient_type' => 'client',
                'provider' => 'sendgrid',
                'provider_template_id' => 'd-xxxxx5', // Replace with actual SendGrid template ID
                'default_data' => [
                    'message' => 'Unfortunately, your reservation could not be confirmed.',
                ],
                'is_active' => true,
            ],
            [
                'event_key' => 'reservation.declined',
                'recipient_type' => 'manager',
                'provider' => 'sendgrid',
                'provider_template_id' => 'd-xxxxx6', // Replace with actual SendGrid template ID
                'default_data' => [
                    'message' => 'Reservation has been declined.',
                ],
                'is_active' => true,
            ],

            // Pre-arrival Reminder
            [
                'event_key' => 'reservation.prearrival',
                'recipient_type' => 'client',
                'provider' => 'sendgrid',
                'provider_template_id' => 'd-xxxxx7', // Replace with actual SendGrid template ID
                'default_data' => [
                    'message' => 'Your reservation is coming up soon!',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($templates as $template) {
            NotificationTemplate::create($template);
        }

        // Create notification rules
        $rules = [
            // Reservation Requested - Notify Manager immediately
            [
                'event_key' => 'reservation.requested',
                'recipient_type' => 'manager',
                'delay_minutes' => 0,
                'is_active' => true,
            ],
            // Reservation Requested - Notify Client immediately
            [
                'event_key' => 'reservation.requested',
                'recipient_type' => 'client',
                'delay_minutes' => 0,
                'is_active' => true,
            ],

            // Reservation Confirmed - Notify Client immediately
            [
                'event_key' => 'reservation.confirmed',
                'recipient_type' => 'client',
                'delay_minutes' => 0,
                'is_active' => true,
            ],
            // Reservation Confirmed - Notify Manager after 2 minutes
            [
                'event_key' => 'reservation.confirmed',
                'recipient_type' => 'manager',
                'delay_minutes' => 2,
                'is_active' => true,
            ],

            // Reservation Declined - Notify Client immediately
            [
                'event_key' => 'reservation.declined',
                'recipient_type' => 'client',
                'delay_minutes' => 0,
                'is_active' => true,
            ],
            // Reservation Declined - Notify Manager after 1 minute
            [
                'event_key' => 'reservation.declined',
                'recipient_type' => 'manager',
                'delay_minutes' => 1,
                'is_active' => true,
            ],

            // Pre-arrival - Notify Client only
            [
                'event_key' => 'reservation.prearrival',
                'recipient_type' => 'client',
                'delay_minutes' => 0,
                'is_active' => true,
            ],
        ];

        foreach ($rules as $rule) {
            NotificationRule::create($rule);
        }

        $this->command->info('Created ' . count($templates) . ' notification templates');
        $this->command->info('Created ' . count($rules) . ' notification rules');
    }
}
