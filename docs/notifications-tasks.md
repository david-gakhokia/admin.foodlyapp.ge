# Notifications: Admin reservation emails — Tasks and Implementation

This document lists the tasks to implement the admin reservation-email flow and marks completed items.

Tasks:

- [x] Add `ReservationStatusChanged` event (carries reservation, oldStatus, newStatus).
- [x] Add `QueueAdminReservationEmails` listener that maps statuses to Mailables and dispatches job(s).
- [x] Add `SendAdminReservationEmail` job which actually queues the Mailable to recipients.
- [x] Register mapping in `app/Providers/EventServiceProvider.php`.
- [x] Fix `AdminConfirmedEmail` to use `emails.admin.confirmed` view (was pointing to `completed`).
- [ ] Add unit tests: listener mapping and job dispatch (suggested: use Mail::fake()).
- [ ] Add integration test: dispatch event -> assert mail queued.
- [ ] Configure queue worker in deployment (supervisor/systemd) and ensure `QUEUE_CONNECTION` in `.env`.
- [ ] Add logging for failed/missing recipients.
- [ ] (Optional) Support multiple admin recipients per restaurant (relation `restaurant->admins`).

Planned / tasks I will implement next (checked = I will implement):

- [x] Add unit tests: listener mapping and job dispatch (use Mail::fake()).
- [x] Add integration test: dispatch event -> assert mail queued.
- [x] Add logging for failed/missing recipients.
- [ ] Configure queue worker in deployment (needs infra access)  
- [x] Support multiple admin recipients per restaurant (implement recipient resolution to use `reservation->restaurant->admins`).

Notes:
- Assumptions made: the `reservation` object has either `restaurant->admin_email` or `admin_email` property; adapt in your app to use real relation `reservation->restaurant->admins` if present.
- The Queueable job uses `Mail::to(...)->queue($mailable);` which keeps Mailables queueable.

Completed by: automated patch in repository (files added/updated).

Next steps I can take if you want:
- Implement tests and add a tiny README with how to run queue worker and run tests.
- Expand recipients resolution to use restaurant admin relations.
