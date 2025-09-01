<?php

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/_debugbar/open' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.openhandler',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets/stylesheets' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets.css',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/assets/javascript' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.assets.js',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_debugbar/queries/explain' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.queries.explain',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/stats' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.stats.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/workload' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.workload.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/masters' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.masters.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/monitoring' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.monitoring.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.monitoring.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/metrics/jobs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.jobs-metrics.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/metrics/queues' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.queues-metrics.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/batches' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.jobs-batches.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/jobs/pending' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.pending-jobs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/jobs/completed' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.completed-jobs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/jobs/silenced' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.silenced-jobs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/horizon/api/jobs/failed' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.failed-jobs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/flux/flux.js' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WMvrqbvOms7XfvbO',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/flux/flux.min.js' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pmcUSSAw6MAewKr0',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/flux/editor.css' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NmuTnDvM1xp7tdpL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/flux/editor.js' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yfQp0qQyltEQQ3OI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/flux/editor.min.js' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PM6TJsSpbO2hz7Wz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/update' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/livewire.js' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SQV9nA6VkojFUVqW',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/livewire.min.js.map' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QbkcwgWGuEIGIwL7',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/livewire/upload-file' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.upload-file',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hWTrkSsMVBIhVH9C',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jKoFtWSsGpvhoNiB',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::B8f4n7IgY6vZ52az',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/phone/send-otp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AkGNSMHCdBcRrcsv',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/phone/verify-otp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kLrs9rcdE4otRY6a',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webapp/spaces' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.spaces.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webapp/cuisines' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.cuisines.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webapp/regions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.regions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webapp/cities' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.cities.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webapp/restaurants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.restaurants.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webapp/dishes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.dishes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webapp/spots' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.spots.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webapp/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.categories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/software/spaces' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.spaces.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'software.spaces.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/software/spots' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.spots.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'software.spots.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/software/places' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.places.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'software.places.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/baro' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'kiosk.baro',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'kiosk.login',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/heartbeat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'kiosk.heartbeat',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::c7IZdEBQtqdL2SY2',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UJGWppPCafBjNAFH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'kiosk.logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/restaurants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/places' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'places.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/spaces' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'spaces.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/cuisines' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cuisines.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/regions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'regions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/cities' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cities.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/dishes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dishes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/spots' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'spots.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/kiosk/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/android/test' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'android.test',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/webhooks/sendgrid' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webhooks.sendgrid',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin/notifications/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.notifications.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin/notifications/events' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.notifications.events',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin/notifications/deliveries' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.notifications.deliveries',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin/notifications/templates' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.notifications.templates',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/reservations/events/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reservations.events.all',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/reservations/statistics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'reservations.statistics',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin/reservations/events/all' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reservations.events.all',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/admin/reservations/statistics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reservations.statistics',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/up' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ov6Er4hm14UKWpo7',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/docs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'docs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/docs/api' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'docs.api',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/docs/kiosk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'docs.kiosk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/docs/webapp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'docs.webapp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/roles-demo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PbAu96OQ3dCpWE2B',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/clear' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yU4iOJNFYxIRutwf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/test-notification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'test.notification',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/users/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/roles' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/roles/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/permissions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.permissions.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.permissions.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/permissions/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.permissions.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/kiosks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.kiosks.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.kiosks.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/kiosks/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.kiosks.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/spots' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/spots/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/cuisines' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/cuisines/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dishes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dishes/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/dishes-menu-categories-overview' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.menu-categories.overview',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/spaces' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/spaces/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/notification-logs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.notification-logs.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/cities' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cities.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cities.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/cities/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cities.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu/categories' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.categories.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.categories.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu/categories/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.categories.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu/items' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.items.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.items.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/menu/items/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.items.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/restaurants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/restaurants/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reservations/list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reservations.list',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/reservation/calendar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.reservation.calendar',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/queue/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.queue.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/queue/jobs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.queue.jobs',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/queue/failed' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.queue.failed',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/queue/clear-failed' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.queue.clear-failed',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/queue/restart' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.queue.restart',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/queue/api' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.queue.api',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/monitoring' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.monitoring.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/monitoring/api' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.monitoring.api',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/monitoring/reservations-feed' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.monitoring.reservations-feed',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/monitoring/email-activities' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.monitoring.email-activities',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/monitoring/system-health' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.monitoring.system-health',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/monitoring/performance-metrics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.monitoring.performance-metrics',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/bog-analytics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.bog-analytics.dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/bog-analytics/transactions' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.bog-analytics.transactions',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/admin/bog-analytics/revenue' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.bog-analytics.revenue',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/settings' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::g5G6DB5m69kkA2Kg',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
            'POST' => 2,
            'PUT' => 3,
            'PATCH' => 4,
            'DELETE' => 5,
            'OPTIONS' => 6,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/settings/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'settings.profile',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/settings/password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'settings.password',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/settings/appearance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'settings.appearance',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bog/payment/success' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bog.payment.success',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bog/payment/fail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bog.payment.fail',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bog/webhook/payment-status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bog.webhook.payment-status',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/forgot-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/verify-email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/confirm-password' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/_debugbar/c(?|lockwork/([^/]++)(*:39)|ache/([^/]++)(?:/([^/]++))?(*:73))|/horizon(?|/api/(?|m(?|onitoring/(?|([^/]++)(*:125)|(.*)(*:137))|etrics/(?|jobs/([^/]++)(*:169)|queues/([^/]++)(*:192)))|batches/(?|([^/]++)(*:221)|retry/([^/]++)(*:243))|jobs/(?|failed/([^/]++)(*:275)|retry/([^/]++)(*:297)|([^/]++)(*:313)))|(?:/((?:.*)))?(*:337))|/livewire/preview\\-file/([^/]++)(*:378)|/a(?|pi/(?|webapp/(?|sp(?|aces/([^/]++)(?|(*:428)|/(?|restaurants(*:451)|top\\-10\\-restaurants(*:479)))|ots/([^/]++)(?|(*:504)|/(?|restaurants(*:527)|top\\-10\\-restaurants(*:555))))|c(?|uisines/([^/]++)(?|(*:589)|/(?|restaurants(*:612)|top\\-10\\-restaurants(*:640)))|ities/([^/]++)(?|(*:667)|/(?|restaurants(*:690)|top\\-10\\-restaurants(*:718)))|ategories/([^/]++)(*:746))|re(?|gions/([^/]++)(?|(*:777)|/([^/]++)/restaurants(*:806))|staurants/([^/]++)(?|(*:836)|/(?|places(*:854)|tables(*:868)|details(*:883))))|dishes/([^/]++)(?|(*:912)|/(?|restaurants(*:935)|top\\-10\\-restaurants(*:963))))|software/(?|sp(?|aces/([^/]++)(?|(*:1007)|(*:1016))|ots/([^/]++)(?|(*:1041)|(*:1050)|/restaurants(?|(*:1074)|/([^/]++)(?|(*:1095)))))|cuisines/([^/]++)/restaurants(?|(*:1140)|/([^/]++)(?|(*:1161)))|places/([^/]++)(?|(*:1190)))|kiosk/(?|re(?|staurants/([^/]++)(?|(*:1236)|/(?|details(*:1256)|place(?|s(*:1274)|/([^/]++)(?|(*:1295)|/table(?|s(*:1314)|/([^/]++)(*:1332))))|([^/]++)/([^/]++)(*:1361)|table(?|s(*:1379)|/([^/]++)(*:1397))|menu(?|/(?|categories(*:1428)|items(*:1442))|(*:1452))|full\\-menu(*:1472)))|gions/([^/]++)(?|(*:1500)|/(?|restaurants(*:1524)|top\\-10\\-restaurants(*:1553))))|places/([^/]++)(?|(*:1583)|/(?|restaurants(*:1607)|top\\-10\\-restaurants(*:1636)))|sp(?|aces/([^/]++)(?|(*:1668)|/(?|restaurants(*:1692)|top\\-10\\-restaurants(*:1721)))|ots/([^/]++)(?|(*:1747)|/(?|restaurants(*:1771)|top\\-10\\-restaurants(*:1800))))|c(?|uisines/([^/]++)(?|(*:1835)|/(?|restaurants(*:1859)|top\\-10\\-restaurants(*:1888)))|ities/([^/]++)(?|(*:1916)|/(?|restaurants(*:1940)|top\\-10\\-restaurants(*:1969)))|ategories/([^/]++)(*:1998))|dishes/([^/]++)(?|(*:2026)|/(?|top\\-10\\-restaurants(*:2059)|categories\\-items\\-restaurants(*:2098)|([^/]++)(*:2115)))|availability/restaurant/([^/]++)(?|(*:2161)|/(?|place/([^/]++)(?|(*:2191)|/table/([^/]++)(*:2215))|t(?|able(?|/([^/]++)(*:2245)|s\\-by\\-time(*:2265))|imes(*:2279))|([^/]++)/tables\\-by\\-time(*:2314)|tables\\-overview(*:2339)))|booking/(?|restaurant/([^/]++)/reserve(*:2388)|([^/]++)/(?|place/([^/]++)/reserve(*:2431)|([^/]++)/table/([^/]++)/reserve(*:2471))|restaurant/([^/]++)/(?|table/([^/]++)/reserve(*:2526)|otp(*:2538)|s(?|ms(*:2553)|end\\-sms(*:2570))|verify\\-otp(*:2591))|([^/]++)/([^/]++)/(?|available\\-slots(*:2638)|create(*:2653))))|admin/notifications/events/([^/]++)(?|(*:2703)|/retry(*:2718)))|dmin/(?|users/([^/]++)(?|(*:2754)|/edit(*:2768)|(*:2777))|r(?|oles/([^/]++)(?|(*:2807)|/edit(*:2821)|(*:2830))|estaurants/([^/]++)(?|(*:2862)|/(?|edit(*:2879)|s(?|paces(?|(*:2900)|/(?|create(*:2919)|([^/]++)(?|/edit(*:2944)|(*:2953)))|(*:2964))|lots(?|(*:2981)|/(?|create(*:3000)|([^/]++)(?|(*:3020)|/edit(*:3034)|(*:3043)))|(*:3054)))|dishes(?|(*:3074)|/(?|create(*:3093)|([^/]++)(?|/edit(*:3118)|(*:3127)))|(*:3138))|cuisines(?|(*:3159)|/(?|create(*:3178)|([^/]++)(?|/edit(*:3203)|(*:3212)))|(*:3223))|reservations(?|/(?|calendar(*:3260)|events(*:3275)|([^/]++)(?|/(?|status(*:3305)|edit(*:3318))|(*:3328)))|(*:3339))|menu(?|/categor(?|ies(?|(*:3373)|/(?|create(*:3392)|level/([^/]++)(?|(*:3418)|/(?|create(*:3437)|sub/([^/]++)(?|(*:3461)|/create(*:3477)|(*:3486)))|(*:3497))|([^/]++)(?|(*:3518)|/(?|edit(*:3535)|items(?|(*:3552)|/(?|create(*:3571)|([^/]++)(?|(*:3591)|/(?|edit(*:3608)|image(*:3622))|(*:3632))|sort(*:3646))|(*:3656)))|(*:3667)))|(*:3678))|y/([^/]++)/parents(*:3706))|\\-categories(*:3728))|p(?|laces(?|(*:3750)|/(?|create(*:3769)|([^/]++)(?|(*:3789)|/(?|edit(*:3806)|delete\\-image(*:3828)|slots(?|(*:3845)|/(?|create(*:3864)|([^/]++)(?|(*:3884)|/edit(*:3898)|(*:3907)))|(*:3918))|tables(?|(*:3937)|/(?|create(*:3956)|([^/]++)(?|(*:3976)|/(?|edit(*:3993)|delete\\-image(*:4015)|slots(?|(*:4032)|/(?|create(*:4051)|([^/]++)(?|(*:4071)|/edit(*:4085)|(*:4094)))|(*:4105)))|(*:4116)))|(*:4127)))|(*:4138)))|(*:4149)|\\-ajax(*:4164))|arent\\-categories(*:4191)))|(*:4202)))|permissions/([^/]++)(?|(*:4236)|/edit(*:4250)|(*:4259))|kiosks/([^/]++)(?|(*:4287)|/edit(*:4301)|(*:4310))|sp(?|ots/([^/]++)(?|(*:4340)|/(?|edit(*:4357)|image(*:4371)|restaurants(?|(*:4394)|/(?|create(*:4413)|([^/]++)(?|/edit(*:4438)|(*:4447)))|(*:4458)))|(*:4469))|aces/([^/]++)(?|(*:4495)|/(?|edit(*:4512)|image(*:4526)|restaurants(?|(*:4549)|/(?|create(*:4568)|([^/]++)(?|/edit(*:4593)|(*:4602)))|(*:4613)))|(*:4624)))|c(?|uisines/([^/]++)(?|(*:4658)|/(?|edit(*:4675)|restaurants(?|(*:4698)|/(?|create(*:4717)|([^/]++)(?|/edit(*:4742)|(*:4751)))|(*:4762)))|(*:4773))|ities/([^/]++)(?|(*:4800)|/(?|edit(*:4817)|image(*:4831))|(*:4841)))|dishes/([^/]++)(?|(*:4870)|/(?|edit(*:4887)|image(*:4901)|restaurants(?|(*:4924)|/(?|create(*:4943)|([^/]++)(?|/edit(*:4968)|(*:4977)))|(*:4988))|menu\\-categories(?|(*:5017)|/(?|create(*:5036)|([^/]++)(?|/edit(*:5061)|(*:5070)))|(*:5081)))|(*:5092))|notification\\-logs/(?|([^/]++)(*:5132)|sample(*:5147))|menu/(?|categories/([^/]++)(?|(*:5187)|/edit(*:5201)|(*:5210))|items/(?|([^/]++)(?|/(?|edit(*:5248)|image(*:5262))|(*:5272))|sort(*:5286)))|queue/(?|retry\\-failed/([^/]++)(*:5328)|delete\\-failed/([^/]++)(*:5360))))|/bo(?|oking\\-form/(?|restaurant/([^/]++)(*:5412)|([^/]++)/(?|place/([^/]++)(*:5447)|([^/]++)/table/([^/]++)(*:5479))|restaurant/([^/]++)/table/([^/]++)(*:5523))|g/payments/(?|initiate/([^/]++)(*:5564)|status/([^/]++)(*:5588)|history/([^/]++)(*:5613)|refund/([^/]++)(*:5637)))|/manager/slots/(?|restaurant/([^/]++)/slots(?|(*:5694)|/(?|create(*:5713)|([^/]++)(?|(*:5733)|/edit(*:5747)|(*:5756)))|(*:5767))|place/([^/]++)/slots(?|(*:5800)|/(?|create(*:5819)|([^/]++)(?|(*:5839)|/edit(*:5853)|(*:5862)))|(*:5873))|table/([^/]++)/slots(?|(*:5906)|/(?|create(*:5925)|([^/]++)(?|(*:5945)|/edit(*:5959)|(*:5968)))|(*:5979)))|/reset\\-password/([^/]++)(*:6015)|/verify\\-email/([^/]++)/([^/]++)(*:6056)|/storage/(.*)(*:6078))/?$}sDu',
    ),
    3 => 
    array (
      39 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.clockwork',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      73 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'debugbar.cache.delete',
            'tags' => NULL,
          ),
          1 => 
          array (
            0 => 'key',
            1 => 'tags',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      125 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.monitoring-tag.paginate',
          ),
          1 => 
          array (
            0 => 'tag',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      137 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.monitoring-tag.destroy',
          ),
          1 => 
          array (
            0 => 'tag',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      169 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.jobs-metrics.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      192 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.queues-metrics.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      221 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.jobs-batches.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      243 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.jobs-batches.retry',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      275 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.failed-jobs.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      297 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.retry-jobs.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      313 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.jobs.show',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      337 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'horizon.index',
            'view' => NULL,
          ),
          1 => 
          array (
            0 => 'view',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      378 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'livewire.preview-file',
          ),
          1 => 
          array (
            0 => 'filename',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      428 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.spaces.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      451 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.spaces.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      479 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.spaces.top',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      504 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.spots.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      527 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.spots.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      555 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.spots.top',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      589 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.cuisines.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      612 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.cuisines.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      640 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.cuisines.top',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      667 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.cities.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      690 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.cities.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      718 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.cities.top',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      746 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.categories.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      777 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.regions.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      806 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.regions.category.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
            1 => 'categorySlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      836 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.restaurants.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      854 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.restaurants.places',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      868 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.restaurants.tables',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      883 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.restaurants.details',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      912 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.dishes.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      935 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.dishes.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      963 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'webapp.dishes.top',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1007 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.spaces.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1016 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.spaces.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'software.spaces.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1041 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.spots.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1050 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.spots.update',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'software.spots.destroy',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1074 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.spots.restaurants.attach',
          ),
          1 => 
          array (
            0 => 'spot',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1095 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.spots.restaurants.update',
          ),
          1 => 
          array (
            0 => 'spot',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'software.spots.restaurants.detach',
          ),
          1 => 
          array (
            0 => 'spot',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1140 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.cuisines.restaurants.attach',
          ),
          1 => 
          array (
            0 => 'cuisine',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1161 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.cuisines.restaurants.update',
          ),
          1 => 
          array (
            0 => 'cuisine',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'software.cuisines.restaurants.detach',
          ),
          1 => 
          array (
            0 => 'cuisine',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1190 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'software.places.show',
          ),
          1 => 
          array (
            0 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'software.places.update',
          ),
          1 => 
          array (
            0 => 'place',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'software.places.destroy',
          ),
          1 => 
          array (
            0 => 'place',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1236 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1256 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.details',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1274 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.places',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1295 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.place.show',
          ),
          1 => 
          array (
            0 => 'slug',
            1 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1314 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.place.tables',
          ),
          1 => 
          array (
            0 => 'slug',
            1 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1332 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.place.table.show',
          ),
          1 => 
          array (
            0 => 'slug',
            1 => 'place',
            2 => 'table',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1361 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.place.table.show.short',
          ),
          1 => 
          array (
            0 => 'slug',
            1 => 'place',
            2 => 'table',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1379 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.tables',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1397 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.table.show',
          ),
          1 => 
          array (
            0 => 'slug',
            1 => 'table',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1428 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.menu.categories',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1442 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.menu.items',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1452 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.menu',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1472 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'restaurants.full-menu',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1500 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'regions.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1524 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'regions.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1553 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'regions.top-10-restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1583 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'places.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1607 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'places.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1636 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'places.top-10-restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1668 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'spaces.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1692 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'spaces.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1721 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'spaces.top-10-restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1747 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'spots.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1771 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'spots.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1800 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'spots.top-10-restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1835 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cuisines.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1859 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cuisines.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1888 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cuisines.top-10-restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1916 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cities.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      1940 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cities.restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1969 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'cities.top-10-restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      1998 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'categories.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2026 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dishes.show',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2059 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dishes.top-10-restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2098 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dishes.categories-items-restaurants',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2115 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dishes.category',
          ),
          1 => 
          array (
            0 => 'slug',
            1 => 'categorySlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2161 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'availability.restaurant',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2191 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'availability.place',
          ),
          1 => 
          array (
            0 => 'restaurantSlug',
            1 => 'placeSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2215 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'availability.table',
          ),
          1 => 
          array (
            0 => 'restaurantSlug',
            1 => 'placeSlug',
            2 => 'tableSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2245 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'availability.table.direct',
          ),
          1 => 
          array (
            0 => 'restaurantSlug',
            1 => 'tableSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2265 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'availability.tables-by-time',
          ),
          1 => 
          array (
            0 => 'restaurantSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2279 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'availability.times',
          ),
          1 => 
          array (
            0 => 'restaurantSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2314 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'availability.tables-by-time.place',
          ),
          1 => 
          array (
            0 => 'restaurantSlug',
            1 => 'placeSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2339 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'availability.tables-overview',
          ),
          1 => 
          array (
            0 => 'restaurantSlug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2388 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-api.restaurant.reserve',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2431 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-api.place.reserve',
          ),
          1 => 
          array (
            0 => 'restaurant_slug',
            1 => 'slug',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2471 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-api.table.reserve',
          ),
          1 => 
          array (
            0 => 'restaurant_slug',
            1 => 'place_slug',
            2 => 'slug',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2526 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-api.table.direct.reserve',
          ),
          1 => 
          array (
            0 => 'restaurant_slug',
            1 => 'slug',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2538 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-api.restaurant.otp.form',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2553 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-api.restaurant.sms.form',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2570 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-api.restaurant.send-sms',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2591 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-api.restaurant.verify-otp',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2638 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-api.available-slots',
          ),
          1 => 
          array (
            0 => 'type',
            1 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2653 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-api.create-reservation',
          ),
          1 => 
          array (
            0 => 'type',
            1 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2703 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.notifications.events.show',
          ),
          1 => 
          array (
            0 => 'event',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2718 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.notifications.events.retry',
          ),
          1 => 
          array (
            0 => 'event',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2754 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.show',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2768 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.edit',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2777 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.update',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.users.destroy',
          ),
          1 => 
          array (
            0 => 'user',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2807 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.show',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2821 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.edit',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2830 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.update',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.roles.destroy',
          ),
          1 => 
          array (
            0 => 'role',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2862 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.show',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2879 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2900 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.spaces.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2919 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.spaces.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2944 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.spaces.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'space',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2953 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.spaces.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'space',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.spaces.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'space',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      2964 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.spaces.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.spaces.bulk-update',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      2981 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.slots.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3000 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.slots.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3020 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.slots.show',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3034 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.slots.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3043 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.slots.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'slot',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.slots.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'slot',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3054 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.slots.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3074 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.dishes.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3093 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.dishes.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3118 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.dishes.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'dish',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3127 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.dishes.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'dish',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.dishes.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'dish',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3138 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.dishes.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.dishes.bulk-update',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3159 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.cuisines.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3178 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.cuisines.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3203 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.cuisines.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'cuisine',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3212 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.cuisines.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'cuisine',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.cuisines.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'cuisine',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3223 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.cuisines.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.cuisines.bulk-update',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3260 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.reservations.calendar',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3275 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.reservations.events',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3305 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.reservations.status',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'reservation',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3318 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.reservations.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'reservation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3328 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.reservations.show',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'reservation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.reservations.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'reservation',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.reservations.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'reservation',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3339 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.reservations.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3373 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3392 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3418 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.children',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'parent',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3437 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.children.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'parent',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3461 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.subchildren',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'parent',
            2 => 'child',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3477 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.subchildren.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'parent',
            2 => 'child',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3486 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.subchildren.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'parent',
            2 => 'child',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3497 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.children.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'parent',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3518 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.show',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'menuCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3535 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'menuCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3552 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.items.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'category',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3571 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.items.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'category',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3591 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.items.show',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'category',
            2 => 'item',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3608 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.items.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'category',
            2 => 'item',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3622 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.items.image.delete',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'category',
            2 => 'item',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3632 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.items.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'category',
            2 => 'item',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.items.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'category',
            2 => 'item',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3646 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.items.sort',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'category',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3656 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.items.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'category',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3667 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'menuCategory',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'menuCategory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3678 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.categories.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3706 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu.category.parents',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'menuCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3728 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.menu-categories',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3750 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3769 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3789 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.show',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3806 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3828 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.delete-image',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3845 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.slots.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3864 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.slots.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3884 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.slots.show',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3898 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.slots.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3907 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.slots.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'slot',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.slots.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'slot',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3918 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.slots.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3937 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3956 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      3976 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.show',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      3993 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4015 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.delete-image',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4032 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.slots.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4051 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.slots.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4071 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.slots.show',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
            3 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4085 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.slots.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
            3 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4094 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.slots.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
            3 => 'slot',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.slots.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
            3 => 'slot',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4105 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.slots.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4116 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
            2 => 'table',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4127 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.tables.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4138 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'place',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4149 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4164 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.places-ajax',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4191 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.parent-categories',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4202 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.restaurants.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4236 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.permissions.show',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4250 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.permissions.edit',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4259 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.permissions.update',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.permissions.destroy',
          ),
          1 => 
          array (
            0 => 'permission',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4287 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.kiosks.show',
          ),
          1 => 
          array (
            0 => 'kiosk',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4301 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.kiosks.edit',
          ),
          1 => 
          array (
            0 => 'kiosk',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4310 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.kiosks.update',
          ),
          1 => 
          array (
            0 => 'kiosk',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.kiosks.destroy',
          ),
          1 => 
          array (
            0 => 'kiosk',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4340 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.show',
          ),
          1 => 
          array (
            0 => 'spot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4357 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.edit',
          ),
          1 => 
          array (
            0 => 'spot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4371 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.image.delete',
          ),
          1 => 
          array (
            0 => 'spot',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4394 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.restaurants.index',
          ),
          1 => 
          array (
            0 => 'spot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4413 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.restaurants.create',
          ),
          1 => 
          array (
            0 => 'spot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4438 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.restaurants.edit',
          ),
          1 => 
          array (
            0 => 'spot',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4447 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.restaurants.update',
          ),
          1 => 
          array (
            0 => 'spot',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.restaurants.destroy',
          ),
          1 => 
          array (
            0 => 'spot',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4458 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.restaurants.store',
          ),
          1 => 
          array (
            0 => 'spot',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.restaurants.bulk-update',
          ),
          1 => 
          array (
            0 => 'spot',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4469 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.update',
          ),
          1 => 
          array (
            0 => 'spot',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spots.destroy',
          ),
          1 => 
          array (
            0 => 'spot',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4495 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.show',
          ),
          1 => 
          array (
            0 => 'space',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4512 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.edit',
          ),
          1 => 
          array (
            0 => 'space',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4526 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.image.delete',
          ),
          1 => 
          array (
            0 => 'space',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4549 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.restaurants.index',
          ),
          1 => 
          array (
            0 => 'space',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4568 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.restaurants.create',
          ),
          1 => 
          array (
            0 => 'space',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4593 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.restaurants.edit',
          ),
          1 => 
          array (
            0 => 'space',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4602 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.restaurants.update',
          ),
          1 => 
          array (
            0 => 'space',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.restaurants.destroy',
          ),
          1 => 
          array (
            0 => 'space',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4613 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.restaurants.store',
          ),
          1 => 
          array (
            0 => 'space',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.restaurants.bulk-update',
          ),
          1 => 
          array (
            0 => 'space',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4624 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.update',
          ),
          1 => 
          array (
            0 => 'space',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.spaces.destroy',
          ),
          1 => 
          array (
            0 => 'space',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4658 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.show',
          ),
          1 => 
          array (
            0 => 'cuisine',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4675 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.edit',
          ),
          1 => 
          array (
            0 => 'cuisine',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4698 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.restaurants.index',
          ),
          1 => 
          array (
            0 => 'cuisine',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4717 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.restaurants.create',
          ),
          1 => 
          array (
            0 => 'cuisine',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4742 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.restaurants.edit',
          ),
          1 => 
          array (
            0 => 'cuisine',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4751 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.restaurants.update',
          ),
          1 => 
          array (
            0 => 'cuisine',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.restaurants.destroy',
          ),
          1 => 
          array (
            0 => 'cuisine',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4762 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.restaurants.store',
          ),
          1 => 
          array (
            0 => 'cuisine',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.restaurants.bulk-update',
          ),
          1 => 
          array (
            0 => 'cuisine',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4773 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.update',
          ),
          1 => 
          array (
            0 => 'cuisine',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cuisines.destroy',
          ),
          1 => 
          array (
            0 => 'cuisine',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4800 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cities.show',
          ),
          1 => 
          array (
            0 => 'city',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4817 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cities.edit',
          ),
          1 => 
          array (
            0 => 'city',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4831 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cities.image.delete',
          ),
          1 => 
          array (
            0 => 'city',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4841 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cities.update',
          ),
          1 => 
          array (
            0 => 'city',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.cities.destroy',
          ),
          1 => 
          array (
            0 => 'city',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4870 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.show',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4887 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.edit',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4901 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.image.delete',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4924 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.restaurants.index',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4943 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.restaurants.create',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4968 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.restaurants.edit',
          ),
          1 => 
          array (
            0 => 'dish',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      4977 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.restaurants.update',
          ),
          1 => 
          array (
            0 => 'dish',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.restaurants.destroy',
          ),
          1 => 
          array (
            0 => 'dish',
            1 => 'restaurant',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      4988 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.restaurants.store',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.restaurants.bulk-update',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5017 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.menu-categories.index',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5036 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.menu-categories.create',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5061 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.menu-categories.edit',
          ),
          1 => 
          array (
            0 => 'dish',
            1 => 'menuCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5070 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.menu-categories.update',
          ),
          1 => 
          array (
            0 => 'dish',
            1 => 'menuCategory',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.menu-categories.destroy',
          ),
          1 => 
          array (
            0 => 'dish',
            1 => 'menuCategory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5081 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.menu-categories.store',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.menu-categories.bulk-update',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5092 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.update',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.dishes.destroy',
          ),
          1 => 
          array (
            0 => 'dish',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5132 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.notification-logs.show',
          ),
          1 => 
          array (
            0 => 'notificationLog',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5147 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.notification-logs.sample',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5187 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.categories.show',
          ),
          1 => 
          array (
            0 => 'menuCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5201 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.categories.edit',
          ),
          1 => 
          array (
            0 => 'menuCategory',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5210 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.categories.update',
          ),
          1 => 
          array (
            0 => 'menuCategory',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.categories.destroy',
          ),
          1 => 
          array (
            0 => 'menuCategory',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5248 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.items.edit',
          ),
          1 => 
          array (
            0 => 'menuItem',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5262 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.items.image.delete',
          ),
          1 => 
          array (
            0 => 'menuItem',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5272 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.items.update',
          ),
          1 => 
          array (
            0 => 'menuItem',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.items.destroy',
          ),
          1 => 
          array (
            0 => 'menuItem',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5286 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.menu.items.sort',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5328 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.queue.retry-failed',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5360 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'admin.queue.delete-failed',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5412 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-form.restaurant.form',
          ),
          1 => 
          array (
            0 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5447 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-form.place.form',
          ),
          1 => 
          array (
            0 => 'restaurant_slug',
            1 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5479 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-form.table.form',
          ),
          1 => 
          array (
            0 => 'restaurant_slug',
            1 => 'place_slug',
            2 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5523 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'booking-form.table.direct.form',
          ),
          1 => 
          array (
            0 => 'restaurant_slug',
            1 => 'slug',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5564 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bog.payments.initiate',
          ),
          1 => 
          array (
            0 => 'reservation',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5588 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bog.payments.status',
          ),
          1 => 
          array (
            0 => 'transaction',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5613 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bog.payments.history',
          ),
          1 => 
          array (
            0 => 'reservation',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5637 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bog.payments.refund',
          ),
          1 => 
          array (
            0 => 'transaction',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5694 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.restaurant.slots.index',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5713 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.restaurant.slots.create',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5733 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.restaurant.slots.show',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5747 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.restaurant.slots.edit',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5756 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.restaurant.slots.update',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'slot',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.restaurant.slots.destroy',
          ),
          1 => 
          array (
            0 => 'restaurant',
            1 => 'slot',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5767 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.restaurant.slots.store',
          ),
          1 => 
          array (
            0 => 'restaurant',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5800 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.place.slots.index',
          ),
          1 => 
          array (
            0 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5819 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.place.slots.create',
          ),
          1 => 
          array (
            0 => 'place',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5839 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.place.slots.show',
          ),
          1 => 
          array (
            0 => 'place',
            1 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5853 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.place.slots.edit',
          ),
          1 => 
          array (
            0 => 'place',
            1 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5862 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.place.slots.update',
          ),
          1 => 
          array (
            0 => 'place',
            1 => 'slot',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.place.slots.destroy',
          ),
          1 => 
          array (
            0 => 'place',
            1 => 'slot',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5873 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.place.slots.store',
          ),
          1 => 
          array (
            0 => 'place',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5906 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.table.slots.index',
          ),
          1 => 
          array (
            0 => 'table',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5925 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.table.slots.create',
          ),
          1 => 
          array (
            0 => 'table',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5945 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.table.slots.show',
          ),
          1 => 
          array (
            0 => 'table',
            1 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5959 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.table.slots.edit',
          ),
          1 => 
          array (
            0 => 'table',
            1 => 'slot',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      5968 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.table.slots.update',
          ),
          1 => 
          array (
            0 => 'table',
            1 => 'slot',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.table.slots.destroy',
          ),
          1 => 
          array (
            0 => 'table',
            1 => 'slot',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      5979 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manager.slots.table.slots.store',
          ),
          1 => 
          array (
            0 => 'table',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      6015 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6056 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.verify',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'hash',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      6078 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'storage.local',
          ),
          1 => 
          array (
            0 => 'path',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'debugbar.openhandler' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/open',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@handle',
        'as' => 'debugbar.openhandler',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@handle',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.clockwork' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/clockwork/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@clockwork',
        'as' => 'debugbar.clockwork',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\OpenHandlerController@clockwork',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets.css' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets/stylesheets',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@css',
        'as' => 'debugbar.assets.css',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@css',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.assets.js' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_debugbar/assets/javascript',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@js',
        'as' => 'debugbar.assets.js',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\AssetController@js',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.cache.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => '_debugbar/cache/{key}/{tags?}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\CacheController@delete',
        'as' => 'debugbar.cache.delete',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\CacheController@delete',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'debugbar.queries.explain' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_debugbar/queries/explain',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'Barryvdh\\Debugbar\\Middleware\\DebugbarEnabled',
        ),
        'uses' => 'Barryvdh\\Debugbar\\Controllers\\QueriesController@explain',
        'as' => 'debugbar.queries.explain',
        'controller' => 'Barryvdh\\Debugbar\\Controllers\\QueriesController@explain',
        'namespace' => 'Barryvdh\\Debugbar\\Controllers',
        'prefix' => '_debugbar',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.stats.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/stats',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\DashboardStatsController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\DashboardStatsController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.stats.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.workload.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/workload',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\WorkloadController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\WorkloadController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.workload.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.masters.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/masters',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\MasterSupervisorController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\MasterSupervisorController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.masters.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.monitoring.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/monitoring',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\MonitoringController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\MonitoringController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.monitoring.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.monitoring.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'horizon/api/monitoring',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\MonitoringController@store',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\MonitoringController@store',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.monitoring.store',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.monitoring-tag.paginate' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/monitoring/{tag}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\MonitoringController@paginate',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\MonitoringController@paginate',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.monitoring-tag.paginate',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.monitoring-tag.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'horizon/api/monitoring/{tag}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\MonitoringController@destroy',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\MonitoringController@destroy',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.monitoring-tag.destroy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'tag' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.jobs-metrics.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/metrics/jobs',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\JobMetricsController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\JobMetricsController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.jobs-metrics.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.jobs-metrics.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/metrics/jobs/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\JobMetricsController@show',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\JobMetricsController@show',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.jobs-metrics.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.queues-metrics.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/metrics/queues',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\QueueMetricsController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\QueueMetricsController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.queues-metrics.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.queues-metrics.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/metrics/queues/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\QueueMetricsController@show',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\QueueMetricsController@show',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.queues-metrics.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.jobs-batches.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/batches',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\BatchesController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\BatchesController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.jobs-batches.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.jobs-batches.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/batches/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\BatchesController@show',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\BatchesController@show',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.jobs-batches.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.jobs-batches.retry' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'horizon/api/batches/retry/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\BatchesController@retry',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\BatchesController@retry',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.jobs-batches.retry',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.pending-jobs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/jobs/pending',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\PendingJobsController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\PendingJobsController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.pending-jobs.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.completed-jobs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/jobs/completed',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\CompletedJobsController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\CompletedJobsController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.completed-jobs.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.silenced-jobs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/jobs/silenced',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\SilencedJobsController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\SilencedJobsController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.silenced-jobs.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.failed-jobs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/jobs/failed',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\FailedJobsController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\FailedJobsController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.failed-jobs.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.failed-jobs.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/jobs/failed/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\FailedJobsController@show',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\FailedJobsController@show',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.failed-jobs.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.retry-jobs.show' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'horizon/api/jobs/retry/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\RetryController@store',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\RetryController@store',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.retry-jobs.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.jobs.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/api/jobs/{id}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\JobsController@show',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\JobsController@show',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon/api',
        'where' => 
        array (
        ),
        'as' => 'horizon.jobs.show',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'horizon.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'horizon/{view?}',
      'action' => 
      array (
        'domain' => NULL,
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'Laravel\\Horizon\\Http\\Controllers\\HomeController@index',
        'controller' => 'Laravel\\Horizon\\Http\\Controllers\\HomeController@index',
        'namespace' => 'Laravel\\Horizon\\Http\\Controllers',
        'prefix' => 'horizon',
        'where' => 
        array (
        ),
        'as' => 'horizon.index',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'view' => '(.*)',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WMvrqbvOms7XfvbO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'flux/flux.js',
      'action' => 
      array (
        'uses' => 'Flux\\AssetManager@fluxJs',
        'controller' => 'Flux\\AssetManager@fluxJs',
        'as' => 'generated::WMvrqbvOms7XfvbO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pmcUSSAw6MAewKr0' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'flux/flux.min.js',
      'action' => 
      array (
        'uses' => 'Flux\\AssetManager@fluxMinJs',
        'controller' => 'Flux\\AssetManager@fluxMinJs',
        'as' => 'generated::pmcUSSAw6MAewKr0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NmuTnDvM1xp7tdpL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'flux/editor.css',
      'action' => 
      array (
        'uses' => 'Flux\\AssetManager@editorCss',
        'controller' => 'Flux\\AssetManager@editorCss',
        'as' => 'generated::NmuTnDvM1xp7tdpL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yfQp0qQyltEQQ3OI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'flux/editor.js',
      'action' => 
      array (
        'uses' => 'Flux\\AssetManager@editorJs',
        'controller' => 'Flux\\AssetManager@editorJs',
        'as' => 'generated::yfQp0qQyltEQQ3OI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PM6TJsSpbO2hz7Wz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'flux/editor.min.js',
      'action' => 
      array (
        'uses' => 'Flux\\AssetManager@editorMinJs',
        'controller' => 'Flux\\AssetManager@editorMinJs',
        'as' => 'generated::PM6TJsSpbO2hz7Wz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'livewire/update',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\HandleRequests\\HandleRequests@handleUpdate',
        'controller' => 'Livewire\\Mechanisms\\HandleRequests\\HandleRequests@handleUpdate',
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'livewire.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SQV9nA6VkojFUVqW' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/livewire.js',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@returnJavaScriptAsFile',
        'controller' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@returnJavaScriptAsFile',
        'as' => 'generated::SQV9nA6VkojFUVqW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QbkcwgWGuEIGIwL7' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/livewire.min.js.map',
      'action' => 
      array (
        'uses' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@maps',
        'controller' => 'Livewire\\Mechanisms\\FrontendAssets\\FrontendAssets@maps',
        'as' => 'generated::QbkcwgWGuEIGIwL7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.upload-file' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'livewire/upload-file',
      'action' => 
      array (
        'uses' => 'Livewire\\Features\\SupportFileUploads\\FileUploadController@handle',
        'controller' => 'Livewire\\Features\\SupportFileUploads\\FileUploadController@handle',
        'as' => 'livewire.upload-file',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'livewire.preview-file' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'livewire/preview-file/{filename}',
      'action' => 
      array (
        'uses' => 'Livewire\\Features\\SupportFileUploads\\FilePreviewController@handle',
        'controller' => 'Livewire\\Features\\SupportFileUploads\\FilePreviewController@handle',
        'as' => 'livewire.preview-file',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hWTrkSsMVBIhVH9C' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\AuthController@login',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::hWTrkSsMVBIhVH9C',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jKoFtWSsGpvhoNiB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => '\\App\\Http\\Controllers\\Api\\UserController@index',
        'controller' => '\\App\\Http\\Controllers\\Api\\UserController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::jKoFtWSsGpvhoNiB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::B8f4n7IgY6vZ52az' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => '\\App\\Http\\Controllers\\Api\\AuthController@logout',
        'controller' => '\\App\\Http\\Controllers\\Api\\AuthController@logout',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::B8f4n7IgY6vZ52az',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AkGNSMHCdBcRrcsv' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/phone/send-otp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\PhoneVerificationController@send',
        'controller' => 'App\\Http\\Controllers\\Api\\PhoneVerificationController@send',
        'namespace' => NULL,
        'prefix' => 'api/phone',
        'where' => 
        array (
        ),
        'as' => 'generated::AkGNSMHCdBcRrcsv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kLrs9rcdE4otRY6a' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/phone/verify-otp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\PhoneVerificationController@verify',
        'controller' => 'App\\Http\\Controllers\\Api\\PhoneVerificationController@verify',
        'namespace' => NULL,
        'prefix' => 'api/phone',
        'where' => 
        array (
        ),
        'as' => 'generated::kLrs9rcdE4otRY6a',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.spaces.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/spaces',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpaceController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\SpaceController@index',
        'as' => 'webapp.spaces.index',
        'namespace' => NULL,
        'prefix' => 'api/webapp/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.spaces.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/spaces/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpaceController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Api\\SpaceController@showBySlug',
        'as' => 'webapp.spaces.show',
        'namespace' => NULL,
        'prefix' => 'api/webapp/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.spaces.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/spaces/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpaceController@restaurantsBySpace',
        'controller' => 'App\\Http\\Controllers\\Api\\SpaceController@restaurantsBySpace',
        'as' => 'webapp.spaces.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/webapp/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.spaces.top' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/spaces/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpaceController@top10RestaurantsBySpace',
        'controller' => 'App\\Http\\Controllers\\Api\\SpaceController@top10RestaurantsBySpace',
        'as' => 'webapp.spaces.top',
        'namespace' => NULL,
        'prefix' => 'api/webapp/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.cuisines.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/cuisines',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CuisineController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\CuisineController@index',
        'as' => 'webapp.cuisines.index',
        'namespace' => NULL,
        'prefix' => 'api/webapp/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.cuisines.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/cuisines/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CuisineController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Api\\CuisineController@showBySlug',
        'as' => 'webapp.cuisines.show',
        'namespace' => NULL,
        'prefix' => 'api/webapp/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.cuisines.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/cuisines/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CuisineController@restaurantsByCuisine',
        'controller' => 'App\\Http\\Controllers\\Api\\CuisineController@restaurantsByCuisine',
        'as' => 'webapp.cuisines.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/webapp/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.cuisines.top' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/cuisines/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CuisineController@top10RestaurantsByCuisine',
        'controller' => 'App\\Http\\Controllers\\Api\\CuisineController@top10RestaurantsByCuisine',
        'as' => 'webapp.cuisines.top',
        'namespace' => NULL,
        'prefix' => 'api/webapp/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.regions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/regions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RegionController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\RegionController@index',
        'as' => 'webapp.regions.index',
        'namespace' => NULL,
        'prefix' => 'api/webapp/regions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.regions.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/regions/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RegionController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Api\\RegionController@showBySlug',
        'as' => 'webapp.regions.show',
        'namespace' => NULL,
        'prefix' => 'api/webapp/regions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.regions.category.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/regions/{slug}/{categorySlug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RegionController@restaurantsByCategory',
        'controller' => 'App\\Http\\Controllers\\Api\\RegionController@restaurantsByCategory',
        'as' => 'webapp.regions.category.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/webapp/regions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.cities.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/cities',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CityController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\CityController@index',
        'as' => 'webapp.cities.index',
        'namespace' => NULL,
        'prefix' => 'api/webapp/cities',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.cities.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/cities/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CityController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Api\\CityController@showBySlug',
        'as' => 'webapp.cities.show',
        'namespace' => NULL,
        'prefix' => 'api/webapp/cities',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.cities.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/cities/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CityController@restaurantsByCity',
        'controller' => 'App\\Http\\Controllers\\Api\\CityController@restaurantsByCity',
        'as' => 'webapp.cities.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/webapp/cities',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.cities.top' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/cities/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CityController@top10RestaurantsByCity',
        'controller' => 'App\\Http\\Controllers\\Api\\CityController@top10RestaurantsByCity',
        'as' => 'webapp.cities.top',
        'namespace' => NULL,
        'prefix' => 'api/webapp/cities',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.restaurants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RestaurantController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\RestaurantController@index',
        'as' => 'webapp.restaurants.index',
        'namespace' => NULL,
        'prefix' => 'api/webapp/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.restaurants.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/restaurants/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RestaurantController@show',
        'controller' => 'App\\Http\\Controllers\\Api\\RestaurantController@show',
        'as' => 'webapp.restaurants.show',
        'namespace' => NULL,
        'prefix' => 'api/webapp/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.restaurants.places' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/restaurants/{slug}/places',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RestaurantController@showByPlaces',
        'controller' => 'App\\Http\\Controllers\\Api\\RestaurantController@showByPlaces',
        'as' => 'webapp.restaurants.places',
        'namespace' => NULL,
        'prefix' => 'api/webapp/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.restaurants.tables' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/restaurants/{slug}/tables',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RestaurantController@showByTables',
        'controller' => 'App\\Http\\Controllers\\Api\\RestaurantController@showByTables',
        'as' => 'webapp.restaurants.tables',
        'namespace' => NULL,
        'prefix' => 'api/webapp/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.restaurants.details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/restaurants/{slug}/details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RestaurantController@showDetails',
        'controller' => 'App\\Http\\Controllers\\Api\\RestaurantController@showDetails',
        'as' => 'webapp.restaurants.details',
        'namespace' => NULL,
        'prefix' => 'api/webapp/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.dishes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/dishes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DishController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\DishController@index',
        'as' => 'webapp.dishes.index',
        'namespace' => NULL,
        'prefix' => 'api/webapp/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.dishes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/dishes/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DishController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Api\\DishController@showBySlug',
        'as' => 'webapp.dishes.show',
        'namespace' => NULL,
        'prefix' => 'api/webapp/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.dishes.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/dishes/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DishController@restaurantsByDish',
        'controller' => 'App\\Http\\Controllers\\Api\\DishController@restaurantsByDish',
        'as' => 'webapp.dishes.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/webapp/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.dishes.top' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/dishes/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\DishController@top10RestaurantsByDish',
        'controller' => 'App\\Http\\Controllers\\Api\\DishController@top10RestaurantsByDish',
        'as' => 'webapp.dishes.top',
        'namespace' => NULL,
        'prefix' => 'api/webapp/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.spots.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/spots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpotController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\SpotController@index',
        'as' => 'webapp.spots.index',
        'namespace' => NULL,
        'prefix' => 'api/webapp/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.spots.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/spots/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpotController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Api\\SpotController@showBySlug',
        'as' => 'webapp.spots.show',
        'namespace' => NULL,
        'prefix' => 'api/webapp/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.spots.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/spots/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpotController@restaurantsBySpot',
        'controller' => 'App\\Http\\Controllers\\Api\\SpotController@restaurantsBySpot',
        'as' => 'webapp.spots.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/webapp/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.spots.top' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/spots/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpotController@top10RestaurantsBySpot',
        'controller' => 'App\\Http\\Controllers\\Api\\SpotController@top10RestaurantsBySpot',
        'as' => 'webapp.spots.top',
        'namespace' => NULL,
        'prefix' => 'api/webapp/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.categories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\CategoryController@index',
        'as' => 'webapp.categories.index',
        'namespace' => NULL,
        'prefix' => 'api/webapp/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webapp.categories.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/webapp/categories/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CategoryController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Api\\CategoryController@showBySlug',
        'as' => 'webapp.categories.show',
        'namespace' => NULL,
        'prefix' => 'api/webapp/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spaces.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/software/spaces',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpaceController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\SpaceController@index',
        'as' => 'software.spaces.index',
        'namespace' => NULL,
        'prefix' => 'api/software/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spaces.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/software/spaces/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpaceController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Api\\SpaceController@showBySlug',
        'as' => 'software.spaces.show',
        'namespace' => NULL,
        'prefix' => 'api/software/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spaces.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/software/spaces',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpaceController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\SpaceController@store',
        'as' => 'software.spaces.store',
        'namespace' => NULL,
        'prefix' => 'api/software/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spaces.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/software/spaces/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpaceController@update',
        'controller' => 'App\\Http\\Controllers\\Api\\SpaceController@update',
        'as' => 'software.spaces.update',
        'namespace' => NULL,
        'prefix' => 'api/software/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spaces.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/software/spaces/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpaceController@destroy',
        'controller' => 'App\\Http\\Controllers\\Api\\SpaceController@destroy',
        'as' => 'software.spaces.destroy',
        'namespace' => NULL,
        'prefix' => 'api/software/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.cuisines.restaurants.attach' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/software/cuisines/{cuisine}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CuisineRestaurantController@attach',
        'controller' => 'App\\Http\\Controllers\\Api\\CuisineRestaurantController@attach',
        'as' => 'software.cuisines.restaurants.attach',
        'namespace' => NULL,
        'prefix' => 'api/software/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.cuisines.restaurants.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/software/cuisines/{cuisine}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CuisineRestaurantController@updatePivot',
        'controller' => 'App\\Http\\Controllers\\Api\\CuisineRestaurantController@updatePivot',
        'as' => 'software.cuisines.restaurants.update',
        'namespace' => NULL,
        'prefix' => 'api/software/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.cuisines.restaurants.detach' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/software/cuisines/{cuisine}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CuisineRestaurantController@detach',
        'controller' => 'App\\Http\\Controllers\\Api\\CuisineRestaurantController@detach',
        'as' => 'software.cuisines.restaurants.detach',
        'namespace' => NULL,
        'prefix' => 'api/software/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spots.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/software/spots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@index',
        'as' => 'software.spots.index',
        'namespace' => NULL,
        'prefix' => 'api/software/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spots.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/software/spots/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@showBySlug',
        'as' => 'software.spots.show',
        'namespace' => NULL,
        'prefix' => 'api/software/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spots.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/software/spots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@store',
        'as' => 'software.spots.store',
        'namespace' => NULL,
        'prefix' => 'api/software/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spots.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/software/spots/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@update',
        'as' => 'software.spots.update',
        'namespace' => NULL,
        'prefix' => 'api/software/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spots.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/software/spots/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@destroy',
        'as' => 'software.spots.destroy',
        'namespace' => NULL,
        'prefix' => 'api/software/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spots.restaurants.attach' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/software/spots/{spot}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpotRestaurantController@attach',
        'controller' => 'App\\Http\\Controllers\\Api\\SpotRestaurantController@attach',
        'as' => 'software.spots.restaurants.attach',
        'namespace' => NULL,
        'prefix' => 'api/software/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spots.restaurants.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/software/spots/{spot}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpotRestaurantController@updatePivot',
        'controller' => 'App\\Http\\Controllers\\Api\\SpotRestaurantController@updatePivot',
        'as' => 'software.spots.restaurants.update',
        'namespace' => NULL,
        'prefix' => 'api/software/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.spots.restaurants.detach' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/software/spots/{spot}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\SpotRestaurantController@detach',
        'controller' => 'App\\Http\\Controllers\\Api\\SpotRestaurantController@detach',
        'as' => 'software.spots.restaurants.detach',
        'namespace' => NULL,
        'prefix' => 'api/software/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.places.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/software/places',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@index',
        'as' => 'software.places.index',
        'namespace' => NULL,
        'prefix' => 'api/software/places',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.places.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/software/places/{place}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@show',
        'as' => 'software.places.show',
        'namespace' => NULL,
        'prefix' => 'api/software/places',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
        'place' => 'slug',
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.places.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/software/places',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@store',
        'as' => 'software.places.store',
        'namespace' => NULL,
        'prefix' => 'api/software/places',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.places.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/software/places/{place}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@update',
        'as' => 'software.places.update',
        'namespace' => NULL,
        'prefix' => 'api/software/places',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'software.places.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/software/places/{place}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'App\\Http\\Middleware\\SetLocale',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@destroy',
        'as' => 'software.places.destroy',
        'namespace' => NULL,
        'prefix' => 'api/software/places',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'kiosk.baro' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/baro',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:82:"function () {
        return \\response()->json([\'message\' => \'Baro Baro!\']);
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000b480000000000000000";}}',
        'namespace' => NULL,
        'prefix' => 'api/kiosk',
        'where' => 
        array (
        ),
        'as' => 'kiosk.baro',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'kiosk.login' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/kiosk/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAuthController@login',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAuthController@login',
        'namespace' => NULL,
        'prefix' => 'api/kiosk',
        'where' => 
        array (
        ),
        'as' => 'kiosk.login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'kiosk.heartbeat' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/kiosk/heartbeat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAuthController@heartbeat',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAuthController@heartbeat',
        'namespace' => NULL,
        'prefix' => 'api/kiosk',
        'where' => 
        array (
        ),
        'as' => 'kiosk.heartbeat',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::c7IZdEBQtqdL2SY2' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAuthController@status',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAuthController@status',
        'namespace' => NULL,
        'prefix' => 'api/kiosk',
        'where' => 
        array (
        ),
        'as' => 'generated::c7IZdEBQtqdL2SY2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UJGWppPCafBjNAFH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAuthController@config',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAuthController@config',
        'namespace' => NULL,
        'prefix' => 'api/kiosk',
        'where' => 
        array (
        ),
        'as' => 'generated::UJGWppPCafBjNAFH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'kiosk.logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/kiosk/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAuthController@logout',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAuthController@logout',
        'namespace' => NULL,
        'prefix' => 'api/kiosk',
        'where' => 
        array (
        ),
        'as' => 'kiosk.logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@index',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@index',
        'as' => 'restaurants.index',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showBySlug',
        'as' => 'restaurants.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.details' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showDetails',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showDetails',
        'as' => 'restaurants.details',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.places' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/places',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showByPlaces',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showByPlaces',
        'as' => 'restaurants.places',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.place.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/place/{place}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showByPlace',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showByPlace',
        'as' => 'restaurants.place.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.place.tables' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/place/{place}/tables',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showTablesInPlace',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showTablesInPlace',
        'as' => 'restaurants.place.tables',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.place.table.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/place/{place}/table/{table}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showTableInPlace',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showTableInPlace',
        'as' => 'restaurants.place.table.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.place.table.show.short' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/{place}/{table}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showTableInPlace',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showTableInPlace',
        'as' => 'restaurants.place.table.show.short',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.tables' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/tables',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showByTables',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showByTables',
        'as' => 'restaurants.tables',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.table.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/table/{table}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showTable',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showTable',
        'as' => 'restaurants.table.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.menu.categories' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/menu/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@menuCategories',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@menuCategories',
        'as' => 'restaurants.menu.categories',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.menu.items' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/menu/items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@menuItems',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@menuItems',
        'as' => 'restaurants.menu.items',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.menu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/menu',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showMenu',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showMenu',
        'as' => 'restaurants.menu',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'restaurants.full-menu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/restaurants/{slug}/full-menu',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showFullMenu',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showFullMenu',
        'as' => 'restaurants.full-menu',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'places.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/places',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@index',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@index',
        'as' => 'places.index',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/places',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'places.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/places/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@showBySlug',
        'as' => 'places.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/places',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'places.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/places/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@restaurantsByPlace',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@restaurantsByPlace',
        'as' => 'places.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/places',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'places.top-10-restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/places/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@top10RestaurantsByPlace',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskRestaurantController@top10RestaurantsByPlace',
        'as' => 'places.top-10-restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/places',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'spaces.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/spaces',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskSpaceController@index',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskSpaceController@index',
        'as' => 'spaces.index',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'spaces.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/spaces/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskSpaceController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskSpaceController@showBySlug',
        'as' => 'spaces.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'spaces.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/spaces/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskSpaceController@restaurantsBySpace',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskSpaceController@restaurantsBySpace',
        'as' => 'spaces.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'spaces.top-10-restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/spaces/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskSpaceController@top10RestaurantsBySpace',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskSpaceController@top10RestaurantsBySpace',
        'as' => 'spaces.top-10-restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cuisines.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/cuisines',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskCuisineController@index',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskCuisineController@index',
        'as' => 'cuisines.index',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cuisines.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/cuisines/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskCuisineController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskCuisineController@showBySlug',
        'as' => 'cuisines.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cuisines.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/cuisines/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskCuisineController@restaurantsByCuisine',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskCuisineController@restaurantsByCuisine',
        'as' => 'cuisines.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cuisines.top-10-restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/cuisines/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskCuisineController@top10RestaurantsByCuisine',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskCuisineController@top10RestaurantsByCuisine',
        'as' => 'cuisines.top-10-restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'regions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/regions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RegionController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\RegionController@index',
        'as' => 'regions.index',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/regions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'regions.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/regions/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RegionController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Api\\RegionController@showBySlug',
        'as' => 'regions.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/regions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'regions.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/regions/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RegionController@restaurantsByRegion',
        'controller' => 'App\\Http\\Controllers\\Api\\RegionController@restaurantsByRegion',
        'as' => 'regions.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/regions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'regions.top-10-restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/regions/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\RegionController@top10RestaurantsByRegion',
        'controller' => 'App\\Http\\Controllers\\Api\\RegionController@top10RestaurantsByRegion',
        'as' => 'regions.top-10-restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/regions',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cities.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/cities',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CityController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\CityController@index',
        'as' => 'cities.index',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/cities',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cities.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/cities/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CityController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Api\\CityController@showBySlug',
        'as' => 'cities.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/cities',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cities.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/cities/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CityController@restaurantsByCity',
        'controller' => 'App\\Http\\Controllers\\Api\\CityController@restaurantsByCity',
        'as' => 'cities.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/cities',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'cities.top-10-restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/cities/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CityController@top10RestaurantsByCity',
        'controller' => 'App\\Http\\Controllers\\Api\\CityController@top10RestaurantsByCity',
        'as' => 'cities.top-10-restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/cities',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dishes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/dishes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskDishController@index',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskDishController@index',
        'as' => 'dishes.index',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dishes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/dishes/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskDishController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskDishController@showBySlug',
        'as' => 'dishes.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dishes.top-10-restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/dishes/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskDishController@top10RestaurantsByDish',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskDishController@top10RestaurantsByDish',
        'as' => 'dishes.top-10-restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dishes.categories-items-restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/dishes/{slug}/categories-items-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskDishController@categoriesItemsRestaurantsByDish',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskDishController@categoriesItemsRestaurantsByDish',
        'as' => 'dishes.categories-items-restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dishes.category' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/dishes/{slug}/{categorySlug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskDishController@restaurantsByCategory',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskDishController@restaurantsByCategory',
        'as' => 'dishes.category',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'spots.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/spots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskSpotController@index',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskSpotController@index',
        'as' => 'spots.index',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'spots.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/spots/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskSpotController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskSpotController@showBySlug',
        'as' => 'spots.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'spots.restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/spots/{slug}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskSpotController@restaurantsBySpot',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskSpotController@restaurantsBySpot',
        'as' => 'spots.restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'spots.top-10-restaurants' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/spots/{slug}/top-10-restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskSpotController@top10RestaurantsBySpot',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskSpotController@top10RestaurantsBySpot',
        'as' => 'spots.top-10-restaurants',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/spots',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskCategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskCategoryController@index',
        'as' => 'categories.index',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'categories.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/categories/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskCategoryController@showBySlug',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskCategoryController@showBySlug',
        'as' => 'categories.show',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'availability.restaurant' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/availability/restaurant/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@restaurantAvailability',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@restaurantAvailability',
        'as' => 'availability.restaurant',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/availability',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'availability.place' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@placeAvailability',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@placeAvailability',
        'as' => 'availability.place',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/availability',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'availability.table' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/availability/restaurant/{restaurantSlug}/place/{placeSlug}/table/{tableSlug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@tableAvailability',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@tableAvailability',
        'as' => 'availability.table',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/availability',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'availability.table.direct' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/availability/restaurant/{restaurantSlug}/table/{tableSlug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@directTableAvailability',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@directTableAvailability',
        'as' => 'availability.table.direct',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/availability',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'availability.times' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/availability/restaurant/{restaurantSlug}/times',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@availableTimes',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@availableTimes',
        'as' => 'availability.times',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/availability',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'availability.tables-by-time' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/availability/restaurant/{restaurantSlug}/tables-by-time',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@tablesByTime',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@tablesByTime',
        'as' => 'availability.tables-by-time',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/availability',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'availability.tables-by-time.place' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/availability/restaurant/{restaurantSlug}/{placeSlug}/tables-by-time',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@tablesByTimeInPlace',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@tablesByTimeInPlace',
        'as' => 'availability.tables-by-time.place',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/availability',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'availability.tables-overview' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/availability/restaurant/{restaurantSlug}/tables-overview',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:sanctum',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@tablesOverview',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\KioskAvailabilityController@tablesOverview',
        'as' => 'availability.tables-overview',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/availability',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-api.restaurant.reserve' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/kiosk/booking/restaurant/{slug}/reserve',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'throttle:60,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@restaurantReserve',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@restaurantReserve',
        'as' => 'booking-api.restaurant.reserve',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/booking',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-api.place.reserve' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/kiosk/booking/{restaurant_slug}/place/{slug}/reserve',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'throttle:60,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@placeReserve',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@placeReserve',
        'as' => 'booking-api.place.reserve',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/booking',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-api.table.reserve' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/kiosk/booking/{restaurant_slug}/{place_slug}/table/{slug}/reserve',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'throttle:60,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@tableReserve',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@tableReserve',
        'as' => 'booking-api.table.reserve',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/booking',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-api.table.direct.reserve' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/kiosk/booking/restaurant/{restaurant_slug}/table/{slug}/reserve',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'throttle:60,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@tableReserveDirect',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@tableReserveDirect',
        'as' => 'booking-api.table.direct.reserve',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/booking',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-api.restaurant.otp.form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/booking/restaurant/{slug}/otp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'throttle:60,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@restaurantOTPForm',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@restaurantOTPForm',
        'as' => 'booking-api.restaurant.otp.form',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/booking',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-api.restaurant.sms.form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/booking/restaurant/{slug}/sms',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'throttle:60,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@restaurantSMSForm',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@restaurantSMSForm',
        'as' => 'booking-api.restaurant.sms.form',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/booking',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-api.restaurant.verify-otp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/kiosk/booking/restaurant/{slug}/verify-otp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'throttle:60,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@verifyOTP',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@verifyOTP',
        'as' => 'booking-api.restaurant.verify-otp',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/booking',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-api.restaurant.send-sms' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/kiosk/booking/restaurant/{slug}/send-sms',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'throttle:60,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@sendSMS',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@sendSMS',
        'as' => 'booking-api.restaurant.send-sms',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/booking',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-api.available-slots' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/kiosk/booking/{type}/{id}/available-slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'throttle:60,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingController@availableSlots',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingController@availableSlots',
        'as' => 'booking-api.available-slots',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/booking',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-api.create-reservation' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/kiosk/booking/{type}/{id}/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'throttle:60,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingController@createReservation',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingController@createReservation',
        'as' => 'booking-api.create-reservation',
        'namespace' => NULL,
        'prefix' => 'api/kiosk/booking',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'android.test' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/android/test',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:117:"function () {
        return \\response()->json([\'message\' => \'Android API Working!\', \'platform\' => \'android\']);
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000b7e0000000000000000";}}',
        'as' => 'android.test',
        'namespace' => NULL,
        'prefix' => 'api/android',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'webhooks.sendgrid' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/webhooks/sendgrid',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Webhooks\\SendGridWebhookController@handle',
        'controller' => 'App\\Http\\Controllers\\Webhooks\\SendGridWebhookController@handle',
        'as' => 'webhooks.sendgrid',
        'namespace' => NULL,
        'prefix' => 'api/webhooks',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.notifications.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin/notifications/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NotificationController@dashboard',
        'controller' => 'App\\Http\\Controllers\\Admin\\NotificationController@dashboard',
        'as' => 'admin.notifications.dashboard',
        'namespace' => NULL,
        'prefix' => 'api/admin/notifications',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.notifications.events' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin/notifications/events',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NotificationController@events',
        'controller' => 'App\\Http\\Controllers\\Admin\\NotificationController@events',
        'as' => 'admin.notifications.events',
        'namespace' => NULL,
        'prefix' => 'api/admin/notifications',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.notifications.events.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin/notifications/events/{event}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NotificationController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\NotificationController@show',
        'as' => 'admin.notifications.events.show',
        'namespace' => NULL,
        'prefix' => 'api/admin/notifications',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.notifications.events.retry' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/admin/notifications/events/{event}/retry',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NotificationController@retry',
        'controller' => 'App\\Http\\Controllers\\Admin\\NotificationController@retry',
        'as' => 'admin.notifications.events.retry',
        'namespace' => NULL,
        'prefix' => 'api/admin/notifications',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.notifications.deliveries' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin/notifications/deliveries',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NotificationController@deliveries',
        'controller' => 'App\\Http\\Controllers\\Admin\\NotificationController@deliveries',
        'as' => 'admin.notifications.deliveries',
        'namespace' => NULL,
        'prefix' => 'api/admin/notifications',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.notifications.templates' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin/notifications/templates',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NotificationController@templates',
        'controller' => 'App\\Http\\Controllers\\Admin\\NotificationController@templates',
        'as' => 'admin.notifications.templates',
        'namespace' => NULL,
        'prefix' => 'api/admin/notifications',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reservations.events.all' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/reservations/events/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@eventsAll',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@eventsAll',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'reservations.events.all',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'reservations.statistics' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/reservations/statistics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@getStatistics',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@getStatistics',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'reservations.statistics',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reservations.events.all' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin/reservations/events/all',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@eventsAll',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@eventsAll',
        'as' => 'admin.reservations.events.all',
        'namespace' => NULL,
        'prefix' => 'api/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reservations.statistics' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/admin/reservations/statistics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@getStatistics',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@getStatistics',
        'as' => 'admin.reservations.statistics',
        'namespace' => NULL,
        'prefix' => 'api/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ov6Er4hm14UKWpo7' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'up',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:841:"function () {
                    $exception = null;

                    try {
                        \\Illuminate\\Support\\Facades\\Event::dispatch(new \\Illuminate\\Foundation\\Events\\DiagnosingHealth);
                    } catch (\\Throwable $e) {
                        if (app()->hasDebugModeEnabled()) {
                            throw $e;
                        }

                        report($e);

                        $exception = $e->getMessage();
                    }

                    return response(\\Illuminate\\Support\\Facades\\View::file(\'C:\\\\Users\\\\David\\\\Herd\\\\api.foodlyapp.ge\\\\vendor\\\\laravel\\\\framework\\\\src\\\\Illuminate\\\\Foundation\\\\Configuration\'.\'/../resources/health-up.blade.php\', [
                        \'exception\' => $exception,
                    ]), status: $exception ? 500 : 200);
                }";s:5:"scope";s:54:"Illuminate\\Foundation\\Configuration\\ApplicationBuilder";s:4:"this";N;s:4:"self";s:32:"0000000000000b470000000000000000";}}',
        'as' => 'generated::ov6Er4hm14UKWpo7',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentationController@index',
        'controller' => 'App\\Http\\Controllers\\DocumentationController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'docs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'docs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentationController@index',
        'controller' => 'App\\Http\\Controllers\\DocumentationController@index',
        'as' => 'docs.index',
        'namespace' => NULL,
        'prefix' => '/docs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'docs.api' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'docs/api',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentationController@api',
        'controller' => 'App\\Http\\Controllers\\DocumentationController@api',
        'as' => 'docs.api',
        'namespace' => NULL,
        'prefix' => '/docs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'docs.kiosk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'docs/kiosk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:55:"function () {
        return \\view(\'docs.kiosk\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000bd40000000000000000";}}',
        'as' => 'docs.kiosk',
        'namespace' => NULL,
        'prefix' => '/docs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'docs.webapp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'docs/webapp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DocumentationController@webapp',
        'controller' => 'App\\Http\\Controllers\\DocumentationController@webapp',
        'as' => 'docs.webapp',
        'namespace' => NULL,
        'prefix' => '/docs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PbAu96OQ3dCpWE2B' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'roles-demo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:53:"function () {
    return \\view(\'admin.roles-demo\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000bd00000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::PbAu96OQ3dCpWE2B',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yU4iOJNFYxIRutwf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'clear',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:330:"function () {
    \\Illuminate\\Support\\Facades\\Artisan::call(\'config:clear\');
    \\Illuminate\\Support\\Facades\\Artisan::call(\'cache:clear\');
    \\Illuminate\\Support\\Facades\\Artisan::call(\'view:clear\');
    \\Illuminate\\Support\\Facades\\Artisan::call(\'route:clear\');
    return \\response()->json([\'message\' => \'All caches cleared\']);
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000bd70000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::yU4iOJNFYxIRutwf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-form.restaurant.form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'booking-form/restaurant/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@restaurantForm',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@restaurantForm',
        'as' => 'booking-form.restaurant.form',
        'namespace' => NULL,
        'prefix' => '/booking-form',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-form.place.form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'booking-form/{restaurant_slug}/place/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@placeForm',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@placeForm',
        'as' => 'booking-form.place.form',
        'namespace' => NULL,
        'prefix' => '/booking-form',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-form.table.form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'booking-form/{restaurant_slug}/{place_slug}/table/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@tableForm',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@tableForm',
        'as' => 'booking-form.table.form',
        'namespace' => NULL,
        'prefix' => '/booking-form',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'booking-form.table.direct.form' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'booking-form/restaurant/{restaurant_slug}/table/{slug}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@tableFormDirect',
        'controller' => 'App\\Http\\Controllers\\Kiosk\\BookingFormController@tableFormDirect',
        'as' => 'booking-form.table.direct.form',
        'namespace' => NULL,
        'prefix' => '/booking-form',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.restaurant.slots.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/restaurant/{restaurant}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.restaurant.slots.index',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@index',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@index',
        'namespace' => NULL,
        'prefix' => 'manager/slots/restaurant/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.restaurant.slots.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/restaurant/{restaurant}/slots/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.restaurant.slots.create',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@create',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@create',
        'namespace' => NULL,
        'prefix' => 'manager/slots/restaurant/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.restaurant.slots.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'manager/slots/restaurant/{restaurant}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.restaurant.slots.store',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@store',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@store',
        'namespace' => NULL,
        'prefix' => 'manager/slots/restaurant/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.restaurant.slots.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/restaurant/{restaurant}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.restaurant.slots.show',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@show',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@show',
        'namespace' => NULL,
        'prefix' => 'manager/slots/restaurant/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.restaurant.slots.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/restaurant/{restaurant}/slots/{slot}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.restaurant.slots.edit',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@edit',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@edit',
        'namespace' => NULL,
        'prefix' => 'manager/slots/restaurant/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.restaurant.slots.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'manager/slots/restaurant/{restaurant}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.restaurant.slots.update',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@update',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@update',
        'namespace' => NULL,
        'prefix' => 'manager/slots/restaurant/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.restaurant.slots.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'manager/slots/restaurant/{restaurant}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.restaurant.slots.destroy',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@destroy',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\RestaurantSlotController@destroy',
        'namespace' => NULL,
        'prefix' => 'manager/slots/restaurant/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.place.slots.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/place/{place}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.place.slots.index',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@index',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@index',
        'namespace' => NULL,
        'prefix' => 'manager/slots/place/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.place.slots.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/place/{place}/slots/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.place.slots.create',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@create',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@create',
        'namespace' => NULL,
        'prefix' => 'manager/slots/place/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.place.slots.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'manager/slots/place/{place}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.place.slots.store',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@store',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@store',
        'namespace' => NULL,
        'prefix' => 'manager/slots/place/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.place.slots.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/place/{place}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.place.slots.show',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@show',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@show',
        'namespace' => NULL,
        'prefix' => 'manager/slots/place/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.place.slots.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/place/{place}/slots/{slot}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.place.slots.edit',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@edit',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@edit',
        'namespace' => NULL,
        'prefix' => 'manager/slots/place/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.place.slots.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'manager/slots/place/{place}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.place.slots.update',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@update',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@update',
        'namespace' => NULL,
        'prefix' => 'manager/slots/place/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.place.slots.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'manager/slots/place/{place}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.place.slots.destroy',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@destroy',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\PlaceSlotController@destroy',
        'namespace' => NULL,
        'prefix' => 'manager/slots/place/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.table.slots.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/table/{table}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.table.slots.index',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@index',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@index',
        'namespace' => NULL,
        'prefix' => 'manager/slots/table/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.table.slots.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/table/{table}/slots/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.table.slots.create',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@create',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@create',
        'namespace' => NULL,
        'prefix' => 'manager/slots/table/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.table.slots.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'manager/slots/table/{table}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.table.slots.store',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@store',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@store',
        'namespace' => NULL,
        'prefix' => 'manager/slots/table/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.table.slots.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/table/{table}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.table.slots.show',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@show',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@show',
        'namespace' => NULL,
        'prefix' => 'manager/slots/table/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.table.slots.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'manager/slots/table/{table}/slots/{slot}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.table.slots.edit',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@edit',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@edit',
        'namespace' => NULL,
        'prefix' => 'manager/slots/table/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.table.slots.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'manager/slots/table/{table}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.table.slots.update',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@update',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@update',
        'namespace' => NULL,
        'prefix' => 'manager/slots/table/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manager.slots.table.slots.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'manager/slots/table/{table}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'manager.slots.table.slots.destroy',
        'uses' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@destroy',
        'controller' => 'App\\Http\\Controllers\\Manager\\Slot\\TableSlotController@destroy',
        'namespace' => NULL,
        'prefix' => 'manager/slots/table/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'test.notification' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'test-notification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Test\\NotificationTestController@testNotification',
        'controller' => 'App\\Http\\Controllers\\Test\\NotificationTestController@testNotification',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'test.notification',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.users.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.users.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.users.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.users.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/users/{user}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.users.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.users.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.users.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/users/{user}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.users.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\UserController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\UserController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.roles.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\RoleController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\RoleController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.roles.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\RoleController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\RoleController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/roles',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.roles.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\RoleController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\RoleController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.roles.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\RoleController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\RoleController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/roles/{role}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.roles.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\RoleController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\RoleController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.roles.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\RoleController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\RoleController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.roles.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/roles/{role}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.roles.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\RoleController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\RoleController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.permissions.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.permissions.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\PermissionController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\PermissionController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.permissions.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/permissions/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.permissions.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\PermissionController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\PermissionController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.permissions.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/permissions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.permissions.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\PermissionController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\PermissionController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.permissions.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/permissions/{permission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.permissions.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\PermissionController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\PermissionController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.permissions.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/permissions/{permission}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.permissions.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\PermissionController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\PermissionController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.permissions.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/permissions/{permission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.permissions.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\PermissionController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\PermissionController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.permissions.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/permissions/{permission}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.permissions.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\PermissionController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\PermissionController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.kiosks.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/kiosks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.kiosks.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\KioskController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\KioskController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.kiosks.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/kiosks/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.kiosks.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\KioskController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\KioskController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.kiosks.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/kiosks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.kiosks.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\KioskController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\KioskController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.kiosks.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/kiosks/{kiosk}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.kiosks.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\KioskController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\KioskController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.kiosks.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/kiosks/{kiosk}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.kiosks.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\KioskController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\KioskController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.kiosks.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/kiosks/{kiosk}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.kiosks.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\KioskController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\KioskController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.kiosks.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/kiosks/{kiosk}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.kiosks.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\KioskController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\KioskController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spots.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spots/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spots.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/spots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spots.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spots/{spot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spots.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spots/{spot}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spots.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/spots/{spot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spots.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/spots/{spot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spots.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.image.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/spots/{spot}/image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotController@deleteImage',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotController@deleteImage',
        'as' => 'admin.spots.image.delete',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.restaurants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spots/{spot}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@index',
        'as' => 'admin.spots.restaurants.index',
        'namespace' => NULL,
        'prefix' => 'admin/spots/{spot}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.restaurants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spots/{spot}/restaurants/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@create',
        'as' => 'admin.spots.restaurants.create',
        'namespace' => NULL,
        'prefix' => 'admin/spots/{spot}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.restaurants.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/spots/{spot}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@store',
        'as' => 'admin.spots.restaurants.store',
        'namespace' => NULL,
        'prefix' => 'admin/spots/{spot}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.restaurants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spots/{spot}/restaurants/{restaurant}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@edit',
        'as' => 'admin.spots.restaurants.edit',
        'namespace' => NULL,
        'prefix' => 'admin/spots/{spot}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.restaurants.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/spots/{spot}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@update',
        'as' => 'admin.spots.restaurants.update',
        'namespace' => NULL,
        'prefix' => 'admin/spots/{spot}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.restaurants.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/spots/{spot}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@destroy',
        'as' => 'admin.spots.restaurants.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/spots/{spot}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spots.restaurants.bulk-update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/spots/{spot}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@bulkUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpotRestaurantController@bulkUpdate',
        'as' => 'admin.spots.restaurants.bulk-update',
        'namespace' => NULL,
        'prefix' => 'admin/spots/{spot}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cuisines',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cuisines.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cuisines/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cuisines.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/cuisines',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cuisines.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cuisines/{cuisine}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cuisines.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cuisines/{cuisine}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cuisines.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/cuisines/{cuisine}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cuisines.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/cuisines/{cuisine}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cuisines.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.restaurants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cuisines/{cuisine}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@index',
        'as' => 'admin.cuisines.restaurants.index',
        'namespace' => NULL,
        'prefix' => 'admin/cuisines/{cuisine}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.restaurants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cuisines/{cuisine}/restaurants/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@create',
        'as' => 'admin.cuisines.restaurants.create',
        'namespace' => NULL,
        'prefix' => 'admin/cuisines/{cuisine}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.restaurants.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/cuisines/{cuisine}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@store',
        'as' => 'admin.cuisines.restaurants.store',
        'namespace' => NULL,
        'prefix' => 'admin/cuisines/{cuisine}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.restaurants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cuisines/{cuisine}/restaurants/{restaurant}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@edit',
        'as' => 'admin.cuisines.restaurants.edit',
        'namespace' => NULL,
        'prefix' => 'admin/cuisines/{cuisine}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.restaurants.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/cuisines/{cuisine}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@update',
        'as' => 'admin.cuisines.restaurants.update',
        'namespace' => NULL,
        'prefix' => 'admin/cuisines/{cuisine}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.restaurants.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/cuisines/{cuisine}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@destroy',
        'as' => 'admin.cuisines.restaurants.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/cuisines/{cuisine}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cuisines.restaurants.bulk-update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/cuisines/{cuisine}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@bulkUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\CuisineRestaurantController@bulkUpdate',
        'as' => 'admin.cuisines.restaurants.bulk-update',
        'namespace' => NULL,
        'prefix' => 'admin/cuisines/{cuisine}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.dishes.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\DishController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.dishes.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\DishController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/dishes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.dishes.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\DishController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes/{dish}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.dishes.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\DishController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes/{dish}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.dishes.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\DishController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/dishes/{dish}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.dishes.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\DishController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/dishes/{dish}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.dishes.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\DishController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.image.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/dishes/{dish}/image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishController@deleteOnlyImage',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishController@deleteOnlyImage',
        'as' => 'admin.dishes.image.delete',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.restaurants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes/{dish}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@index',
        'as' => 'admin.dishes.restaurants.index',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.restaurants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes/{dish}/restaurants/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@create',
        'as' => 'admin.dishes.restaurants.create',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.restaurants.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/dishes/{dish}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@store',
        'as' => 'admin.dishes.restaurants.store',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.restaurants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes/{dish}/restaurants/{restaurant}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@edit',
        'as' => 'admin.dishes.restaurants.edit',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.restaurants.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/dishes/{dish}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@update',
        'as' => 'admin.dishes.restaurants.update',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.restaurants.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/dishes/{dish}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@destroy',
        'as' => 'admin.dishes.restaurants.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.restaurants.bulk-update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/dishes/{dish}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@bulkUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishRestaurantController@bulkUpdate',
        'as' => 'admin.dishes.restaurants.bulk-update',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.menu-categories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes/{dish}/menu-categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@index',
        'as' => 'admin.dishes.menu-categories.index',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/menu-categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.menu-categories.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes/{dish}/menu-categories/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@create',
        'as' => 'admin.dishes.menu-categories.create',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/menu-categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.menu-categories.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/dishes/{dish}/menu-categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@store',
        'as' => 'admin.dishes.menu-categories.store',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/menu-categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.menu-categories.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes/{dish}/menu-categories/{menuCategory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@edit',
        'as' => 'admin.dishes.menu-categories.edit',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/menu-categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.menu-categories.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/dishes/{dish}/menu-categories/{menuCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@update',
        'as' => 'admin.dishes.menu-categories.update',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/menu-categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.menu-categories.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/dishes/{dish}/menu-categories/{menuCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@destroy',
        'as' => 'admin.dishes.menu-categories.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/menu-categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.menu-categories.bulk-update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/dishes/{dish}/menu-categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@bulkUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@bulkUpdate',
        'as' => 'admin.dishes.menu-categories.bulk-update',
        'namespace' => NULL,
        'prefix' => 'admin/dishes/{dish}/menu-categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.dishes.menu-categories.overview' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/dishes-menu-categories-overview',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@overview',
        'controller' => 'App\\Http\\Controllers\\Admin\\DishMenuCategoryController@overview',
        'as' => 'admin.dishes.menu-categories.overview',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spaces',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spaces.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spaces/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spaces.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/spaces',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spaces.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spaces/{space}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spaces.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spaces/{space}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spaces.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/spaces/{space}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spaces.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/spaces/{space}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.spaces.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.image.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/spaces/{space}/image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceController@deleteImage',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceController@deleteImage',
        'as' => 'admin.spaces.image.delete',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.notification-logs.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/notification-logs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NotificationLogController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\NotificationLogController@index',
        'as' => 'admin.notification-logs.index',
        'namespace' => NULL,
        'prefix' => 'admin/notification-logs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.notification-logs.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/notification-logs/{notificationLog}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NotificationLogController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\NotificationLogController@show',
        'as' => 'admin.notification-logs.show',
        'namespace' => NULL,
        'prefix' => 'admin/notification-logs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.notification-logs.sample' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/notification-logs/sample',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\NotificationLogController@sample',
        'controller' => 'App\\Http\\Controllers\\Admin\\NotificationLogController@sample',
        'as' => 'admin.notification-logs.sample',
        'namespace' => NULL,
        'prefix' => 'admin/notification-logs',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.restaurants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spaces/{space}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@index',
        'as' => 'admin.spaces.restaurants.index',
        'namespace' => NULL,
        'prefix' => 'admin/spaces/{space}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.restaurants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spaces/{space}/restaurants/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@create',
        'as' => 'admin.spaces.restaurants.create',
        'namespace' => NULL,
        'prefix' => 'admin/spaces/{space}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.restaurants.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/spaces/{space}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@store',
        'as' => 'admin.spaces.restaurants.store',
        'namespace' => NULL,
        'prefix' => 'admin/spaces/{space}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.restaurants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/spaces/{space}/restaurants/{restaurant}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@edit',
        'as' => 'admin.spaces.restaurants.edit',
        'namespace' => NULL,
        'prefix' => 'admin/spaces/{space}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.restaurants.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/spaces/{space}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@update',
        'as' => 'admin.spaces.restaurants.update',
        'namespace' => NULL,
        'prefix' => 'admin/spaces/{space}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.restaurants.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/spaces/{space}/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@destroy',
        'as' => 'admin.spaces.restaurants.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/spaces/{space}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.spaces.restaurants.bulk-update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/spaces/{space}/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@bulkUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\SpaceRestaurantController@bulkUpdate',
        'as' => 'admin.spaces.restaurants.bulk-update',
        'namespace' => NULL,
        'prefix' => 'admin/spaces/{space}/restaurants',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cities.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cities',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cities.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\CityController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\CityController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cities.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cities/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cities.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\CityController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\CityController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cities.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/cities',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cities.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\CityController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\CityController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cities.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cities/{city}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cities.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\CityController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\CityController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cities.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/cities/{city}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cities.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\CityController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\CityController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cities.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/cities/{city}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cities.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\CityController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\CityController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cities.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/cities/{city}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.cities.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\CityController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\CityController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.cities.image.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/cities/{city}/image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\CityController@deleteImage',
        'controller' => 'App\\Http\\Controllers\\Admin\\CityController@deleteImage',
        'as' => 'admin.cities.image.delete',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.categories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menu/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.menu.categories.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@index',
        'namespace' => NULL,
        'prefix' => 'admin/menu/categories/',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.categories.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menu/categories/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.menu.categories.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@create',
        'namespace' => NULL,
        'prefix' => 'admin/menu/categories/',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.categories.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.menu.categories.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@store',
        'namespace' => NULL,
        'prefix' => 'admin/menu/categories/',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.categories.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menu/categories/{menuCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.menu.categories.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@show',
        'namespace' => NULL,
        'prefix' => 'admin/menu/categories/',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.categories.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menu/categories/{menuCategory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.menu.categories.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/menu/categories/',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.categories.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/menu/categories/{menuCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.menu.categories.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@update',
        'namespace' => NULL,
        'prefix' => 'admin/menu/categories/',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.categories.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/menu/categories/{menuCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.menu.categories.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin/menu/categories/',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.items.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menu/items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@index',
        'as' => 'admin.menu.items.index',
        'namespace' => NULL,
        'prefix' => 'admin/menu/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.items.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menu/items/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@create',
        'as' => 'admin.menu.items.create',
        'namespace' => NULL,
        'prefix' => 'admin/menu/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.items.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu/items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@store',
        'as' => 'admin.menu.items.store',
        'namespace' => NULL,
        'prefix' => 'admin/menu/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.items.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/menu/items/{menuItem}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@edit',
        'as' => 'admin.menu.items.edit',
        'namespace' => NULL,
        'prefix' => 'admin/menu/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.items.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/menu/items/{menuItem}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@update',
        'as' => 'admin.menu.items.update',
        'namespace' => NULL,
        'prefix' => 'admin/menu/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.items.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/menu/items/{menuItem}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@destroy',
        'as' => 'admin.menu.items.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/menu/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.items.image.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/menu/items/{menuItem}/image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@deleteImage',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@deleteImage',
        'as' => 'admin.menu.items.image.delete',
        'namespace' => NULL,
        'prefix' => 'admin/menu/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.menu.items.sort' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/menu/items/sort',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@sort',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@sort',
        'as' => 'admin.menu.items.sort',
        'namespace' => NULL,
        'prefix' => 'admin/menu/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantController@index',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantController@create',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantController@store',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantController@show',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantController@edit',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantController@update',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantController@destroy',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.spaces.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/spaces',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@index',
        'as' => 'admin.restaurants.spaces.index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.spaces.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/spaces/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@create',
        'as' => 'admin.restaurants.spaces.create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.spaces.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/spaces',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@store',
        'as' => 'admin.restaurants.spaces.store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.spaces.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/spaces/{space}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@edit',
        'as' => 'admin.restaurants.spaces.edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.spaces.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/restaurants/{restaurant}/spaces/{space}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@update',
        'as' => 'admin.restaurants.spaces.update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.spaces.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/spaces/{space}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@destroy',
        'as' => 'admin.restaurants.spaces.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.spaces.bulk-update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/restaurants/{restaurant}/spaces',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@bulkUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantSpaceController@bulkUpdate',
        'as' => 'admin.restaurants.spaces.bulk-update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/spaces',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.dishes.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/dishes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@index',
        'as' => 'admin.restaurants.dishes.index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.dishes.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/dishes/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@create',
        'as' => 'admin.restaurants.dishes.create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.dishes.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/dishes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@store',
        'as' => 'admin.restaurants.dishes.store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.dishes.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/dishes/{dish}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@edit',
        'as' => 'admin.restaurants.dishes.edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.dishes.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/restaurants/{restaurant}/dishes/{dish}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@update',
        'as' => 'admin.restaurants.dishes.update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.dishes.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/dishes/{dish}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@destroy',
        'as' => 'admin.restaurants.dishes.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.dishes.bulk-update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/restaurants/{restaurant}/dishes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@bulkUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantDishController@bulkUpdate',
        'as' => 'admin.restaurants.dishes.bulk-update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/dishes',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.cuisines.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/cuisines',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@index',
        'as' => 'admin.restaurants.cuisines.index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.cuisines.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/cuisines/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@create',
        'as' => 'admin.restaurants.cuisines.create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.cuisines.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/cuisines',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@store',
        'as' => 'admin.restaurants.cuisines.store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.cuisines.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/cuisines/{cuisine}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@edit',
        'as' => 'admin.restaurants.cuisines.edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.cuisines.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/restaurants/{restaurant}/cuisines/{cuisine}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@update',
        'as' => 'admin.restaurants.cuisines.update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.cuisines.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/cuisines/{cuisine}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@destroy',
        'as' => 'admin.restaurants.cuisines.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.cuisines.bulk-update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/restaurants/{restaurant}/cuisines',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@bulkUpdate',
        'controller' => 'App\\Http\\Controllers\\Admin\\RestaurantCuisineController@bulkUpdate',
        'as' => 'admin.restaurants.cuisines.bulk-update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/cuisines',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.slots.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.slots.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.slots.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/slots/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.slots.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.slots.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.slots.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.slots.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.slots.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@show',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.slots.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/slots/{slot}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.slots.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.slots.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/restaurants/{restaurant}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.slots.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.slots.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.slots.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\RestaurantSlotController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.reservations.calendar' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/reservations/calendar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@calendar',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@calendar',
        'as' => 'admin.restaurants.reservations.calendar',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.reservations.events' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/reservations/events',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@events',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@events',
        'as' => 'admin.restaurants.reservations.events',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.reservations.status' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'admin/restaurants/{restaurant}/reservations/{reservation}/status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@updateStatus',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@updateStatus',
        'as' => 'admin.restaurants.reservations.status',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.reservations.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/reservations',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.reservations.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.reservations.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/reservations/{reservation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.reservations.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@show',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.reservations.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/reservations/{reservation}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.reservations.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.reservations.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/restaurants/{restaurant}/reservations/{reservation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.reservations.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.reservations.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/reservations/{reservation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.reservations.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@indexByRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@indexByRestaurant',
        'as' => 'admin.restaurants.menu.categories.index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@createForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@createForRestaurant',
        'as' => 'admin.restaurants.menu.categories.create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@storeForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@storeForRestaurant',
        'as' => 'admin.restaurants.menu.categories.store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.children' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/level/{parent}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@showChildren',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@showChildren',
        'as' => 'admin.restaurants.menu.categories.children',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.children.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/level/{parent}/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@createChildForParent',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@createChildForParent',
        'as' => 'admin.restaurants.menu.categories.children.create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.children.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/level/{parent}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@storeChildForParent',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@storeChildForParent',
        'as' => 'admin.restaurants.menu.categories.children.store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.subchildren' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/level/{parent}/sub/{child}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@showSubChildren',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@showSubChildren',
        'as' => 'admin.restaurants.menu.categories.subchildren',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.subchildren.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/level/{parent}/sub/{child}/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@createSubChildForChild',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@createSubChildForChild',
        'as' => 'admin.restaurants.menu.categories.subchildren.create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.subchildren.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/level/{parent}/sub/{child}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@storeSubChildForChild',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@storeSubChildForChild',
        'as' => 'admin.restaurants.menu.categories.subchildren.store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{menuCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@showForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@showForRestaurant',
        'as' => 'admin.restaurants.menu.categories.show',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{menuCategory}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@editForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@editForRestaurant',
        'as' => 'admin.restaurants.menu.categories.edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{menuCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@updateForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@updateForRestaurant',
        'as' => 'admin.restaurants.menu.categories.update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{menuCategory}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@destroyForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@destroyForRestaurant',
        'as' => 'admin.restaurants.menu.categories.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.items.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@indexByCategory',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@indexByCategory',
        'as' => 'admin.restaurants.menu.categories.items.index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.items.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@createForCategory',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@createForCategory',
        'as' => 'admin.restaurants.menu.categories.items.create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.items.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@storeForCategory',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@storeForCategory',
        'as' => 'admin.restaurants.menu.categories.items.store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.items.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items/{item}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@showForCategory',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@showForCategory',
        'as' => 'admin.restaurants.menu.categories.items.show',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.items.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items/{item}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@editForCategory',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@editForCategory',
        'as' => 'admin.restaurants.menu.categories.items.edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.items.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items/{item}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@updateForCategory',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@updateForCategory',
        'as' => 'admin.restaurants.menu.categories.items.update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.items.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items/{item}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@destroyForCategory',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@destroyForCategory',
        'as' => 'admin.restaurants.menu.categories.items.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.items.image.delete' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items/{item}/image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@deleteImageForCategory',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@deleteImageForCategory',
        'as' => 'admin.restaurants.menu.categories.items.image.delete',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.categories.items.sort' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items/sort',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@sortForCategory',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@sortForCategory',
        'as' => 'admin.restaurants.menu.categories.items.sort',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/menu/categories/{category}/items',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu.category.parents' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu/category/{menuCategory}/parents',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@showParents',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@showParents',
        'as' => 'admin.restaurants.menu.category.parents',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@indexByRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@indexByRestaurant',
        'as' => 'admin.restaurants.places.index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@createForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@createForRestaurant',
        'as' => 'admin.restaurants.places.create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@storeForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@storeForRestaurant',
        'as' => 'admin.restaurants.places.store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@showForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@showForRestaurant',
        'as' => 'admin.restaurants.places.show',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@editForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@editForRestaurant',
        'as' => 'admin.restaurants.places.edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@updateForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@updateForRestaurant',
        'as' => 'admin.restaurants.places.update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@destroyForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@destroyForRestaurant',
        'as' => 'admin.restaurants.places.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.delete-image' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/delete-image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\PlaceController@deleteOnlyImageForRestaurant',
        'controller' => 'App\\Http\\Controllers\\Admin\\PlaceController@deleteOnlyImageForRestaurant',
        'as' => 'admin.restaurants.places.delete-image',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.slots.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.slots.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.slots.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/slots/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.slots.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.slots.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.slots.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.slots.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.slots.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@show',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.slots.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/slots/{slot}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.slots.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.slots.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.slots.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.slots.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.slots.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\PlaceSlotController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TableController@indexByPlace',
        'controller' => 'App\\Http\\Controllers\\Admin\\TableController@indexByPlace',
        'as' => 'admin.restaurants.places.tables.index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TableController@createForPlace',
        'controller' => 'App\\Http\\Controllers\\Admin\\TableController@createForPlace',
        'as' => 'admin.restaurants.places.tables.create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TableController@storeForPlace',
        'controller' => 'App\\Http\\Controllers\\Admin\\TableController@storeForPlace',
        'as' => 'admin.restaurants.places.tables.store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TableController@showForPlace',
        'controller' => 'App\\Http\\Controllers\\Admin\\TableController@showForPlace',
        'as' => 'admin.restaurants.places.tables.show',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TableController@editForPlace',
        'controller' => 'App\\Http\\Controllers\\Admin\\TableController@editForPlace',
        'as' => 'admin.restaurants.places.tables.edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TableController@updateForPlace',
        'controller' => 'App\\Http\\Controllers\\Admin\\TableController@updateForPlace',
        'as' => 'admin.restaurants.places.tables.update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TableController@destroyForPlace',
        'controller' => 'App\\Http\\Controllers\\Admin\\TableController@destroyForPlace',
        'as' => 'admin.restaurants.places.tables.destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.delete-image' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}/delete-image',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TableController@deleteOnlyImageForPlace',
        'controller' => 'App\\Http\\Controllers\\Admin\\TableController@deleteOnlyImageForPlace',
        'as' => 'admin.restaurants.places.tables.delete-image',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.slots.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.tables.slots.index',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@index',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@index',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.slots.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}/slots/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.tables.slots.create',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@create',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@create',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.slots.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}/slots',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.tables.slots.store',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@store',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@store',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.slots.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.tables.slots.show',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@show',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@show',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.slots.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}/slots/{slot}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.tables.slots.edit',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@edit',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.slots.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.tables.slots.update',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@update',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@update',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places.tables.slots.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}/slots/{slot}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'as' => 'admin.restaurants.places.tables.slots.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin\\Slot\\TableSlotController@destroy',
        'namespace' => NULL,
        'prefix' => 'admin/restaurants/{restaurant}/places/{place}/tables/{table}',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.menu-categories' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/menu-categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuItemController@getRestaurantCategories',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuItemController@getRestaurantCategories',
        'as' => 'admin.restaurants.menu-categories',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.parent-categories' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/parent-categories',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@getRestaurantParentCategories',
        'controller' => 'App\\Http\\Controllers\\Admin\\MenuCategoryController@getRestaurantParentCategories',
        'as' => 'admin.restaurants.parent-categories',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.restaurants.places-ajax' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/restaurants/{restaurant}/places-ajax',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\TableController@getRestaurantPlaces',
        'controller' => 'App\\Http\\Controllers\\Admin\\TableController@getRestaurantPlaces',
        'as' => 'admin.restaurants.places-ajax',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reservations.list' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reservations/list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@list',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@list',
        'as' => 'admin.reservations.list',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.reservation.calendar' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/reservation/calendar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\ReservationController@calendarAll',
        'controller' => 'App\\Http\\Controllers\\Admin\\ReservationController@calendarAll',
        'as' => 'admin.reservation.calendar',
        'namespace' => NULL,
        'prefix' => '/admin',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.queue.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/queue/dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QueueController@dashboard',
        'controller' => 'App\\Http\\Controllers\\Admin\\QueueController@dashboard',
        'as' => 'admin.queue.dashboard',
        'namespace' => NULL,
        'prefix' => 'admin/queue',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.queue.jobs' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/queue/jobs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QueueController@jobs',
        'controller' => 'App\\Http\\Controllers\\Admin\\QueueController@jobs',
        'as' => 'admin.queue.jobs',
        'namespace' => NULL,
        'prefix' => 'admin/queue',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.queue.failed' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/queue/failed',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QueueController@failed',
        'controller' => 'App\\Http\\Controllers\\Admin\\QueueController@failed',
        'as' => 'admin.queue.failed',
        'namespace' => NULL,
        'prefix' => 'admin/queue',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.queue.retry-failed' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/queue/retry-failed/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QueueController@retryFailed',
        'controller' => 'App\\Http\\Controllers\\Admin\\QueueController@retryFailed',
        'as' => 'admin.queue.retry-failed',
        'namespace' => NULL,
        'prefix' => 'admin/queue',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.queue.delete-failed' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'admin/queue/delete-failed/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QueueController@deleteFailed',
        'controller' => 'App\\Http\\Controllers\\Admin\\QueueController@deleteFailed',
        'as' => 'admin.queue.delete-failed',
        'namespace' => NULL,
        'prefix' => 'admin/queue',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.queue.clear-failed' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/queue/clear-failed',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QueueController@clearFailed',
        'controller' => 'App\\Http\\Controllers\\Admin\\QueueController@clearFailed',
        'as' => 'admin.queue.clear-failed',
        'namespace' => NULL,
        'prefix' => 'admin/queue',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.queue.restart' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'admin/queue/restart',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QueueController@restart',
        'controller' => 'App\\Http\\Controllers\\Admin\\QueueController@restart',
        'as' => 'admin.queue.restart',
        'namespace' => NULL,
        'prefix' => 'admin/queue',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.queue.api' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/queue/api',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\QueueController@api',
        'controller' => 'App\\Http\\Controllers\\Admin\\QueueController@api',
        'as' => 'admin.queue.api',
        'namespace' => NULL,
        'prefix' => 'admin/queue',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.monitoring.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/monitoring',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@dashboard',
        'controller' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@dashboard',
        'as' => 'admin.monitoring.dashboard',
        'namespace' => NULL,
        'prefix' => 'admin/monitoring',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.monitoring.api' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/monitoring/api',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@api',
        'controller' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@api',
        'as' => 'admin.monitoring.api',
        'namespace' => NULL,
        'prefix' => 'admin/monitoring',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.monitoring.reservations-feed' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/monitoring/reservations-feed',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@reservationsFeed',
        'controller' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@reservationsFeed',
        'as' => 'admin.monitoring.reservations-feed',
        'namespace' => NULL,
        'prefix' => 'admin/monitoring',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.monitoring.email-activities' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/monitoring/email-activities',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@emailActivities',
        'controller' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@emailActivities',
        'as' => 'admin.monitoring.email-activities',
        'namespace' => NULL,
        'prefix' => 'admin/monitoring',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.monitoring.system-health' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/monitoring/system-health',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@systemHealth',
        'controller' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@systemHealth',
        'as' => 'admin.monitoring.system-health',
        'namespace' => NULL,
        'prefix' => 'admin/monitoring',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.monitoring.performance-metrics' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/monitoring/performance-metrics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@performanceMetrics',
        'controller' => 'App\\Http\\Controllers\\Admin\\RealtimeMonitoringController@performanceMetrics',
        'as' => 'admin.monitoring.performance-metrics',
        'namespace' => NULL,
        'prefix' => 'admin/monitoring',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.bog-analytics.dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/bog-analytics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:90:"function () {
                return \\view(\'admin.bog-analytics.dashboard\');
            }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000ce30000000000000000";}}',
        'as' => 'admin.bog-analytics.dashboard',
        'namespace' => NULL,
        'prefix' => 'admin/bog-analytics',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.bog-analytics.transactions' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/bog-analytics/transactions',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:93:"function () {
                return \\view(\'admin.bog-analytics.transactions\');
            }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000ce50000000000000000";}}',
        'as' => 'admin.bog-analytics.transactions',
        'namespace' => NULL,
        'prefix' => 'admin/bog-analytics',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'admin.bog-analytics.revenue' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'admin/bog-analytics/revenue',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:88:"function () {
                return \\view(\'admin.bog-analytics.revenue\');
            }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"0000000000000ce70000000000000000";}}',
        'as' => 'admin.bog-analytics.revenue',
        'namespace' => NULL,
        'prefix' => 'admin/bog-analytics',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'verified',
        ),
        'uses' => '\\Illuminate\\Routing\\ViewController@__invoke',
        'controller' => '\\Illuminate\\Routing\\ViewController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'view' => 'dashboard',
        'data' => 
        array (
        ),
        'status' => 200,
        'headers' => 
        array (
        ),
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::g5G6DB5m69kkA2Kg' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
        2 => 'POST',
        3 => 'PUT',
        4 => 'PATCH',
        5 => 'DELETE',
        6 => 'OPTIONS',
      ),
      'uri' => 'settings',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => '\\Illuminate\\Routing\\RedirectController@__invoke',
        'controller' => '\\Illuminate\\Routing\\RedirectController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::g5G6DB5m69kkA2Kg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
        'destination' => 'settings/profile',
        'status' => 302,
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'settings.profile' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'settings/profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:1:{s:13:"componentName";s:16:"settings.profile";}s:8:"function";s:294:"function () use ($componentName) {
            $container = \\Illuminate\\Container\\Container::getInstance();

            return $container->call([
                $container->make(\\Livewire\\Volt\\LivewireManager::class)->new($componentName),
                \'__invoke\',
            ]);
        }";s:5:"scope";s:25:"Livewire\\Volt\\VoltManager";s:4:"this";N;s:4:"self";s:32:"0000000000000ce90000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'settings.profile',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'settings.password' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'settings/password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:1:{s:13:"componentName";s:17:"settings.password";}s:8:"function";s:294:"function () use ($componentName) {
            $container = \\Illuminate\\Container\\Container::getInstance();

            return $container->call([
                $container->make(\\Livewire\\Volt\\LivewireManager::class)->new($componentName),
                \'__invoke\',
            ]);
        }";s:5:"scope";s:25:"Livewire\\Volt\\VoltManager";s:4:"this";N;s:4:"self";s:32:"0000000000000ceb0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'settings.password',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'settings.appearance' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'settings/appearance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:1:{s:13:"componentName";s:19:"settings.appearance";}s:8:"function";s:294:"function () use ($componentName) {
            $container = \\Illuminate\\Container\\Container::getInstance();

            return $container->call([
                $container->make(\\Livewire\\Volt\\LivewireManager::class)->new($componentName),
                \'__invoke\',
            ]);
        }";s:5:"scope";s:25:"Livewire\\Volt\\VoltManager";s:4:"this";N;s:4:"self";s:32:"0000000000000ced0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'settings.appearance',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bog.payments.initiate' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'bog/payments/initiate/{reservation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\BOGPaymentController@initiatePayment',
        'controller' => 'App\\Http\\Controllers\\BOGPaymentController@initiatePayment',
        'as' => 'bog.payments.initiate',
        'namespace' => NULL,
        'prefix' => '/bog',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bog.payments.status' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bog/payments/status/{transaction}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\BOGPaymentController@checkStatus',
        'controller' => 'App\\Http\\Controllers\\BOGPaymentController@checkStatus',
        'as' => 'bog.payments.status',
        'namespace' => NULL,
        'prefix' => '/bog',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bog.payments.history' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bog/payments/history/{reservation}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\BOGPaymentController@getPaymentHistory',
        'controller' => 'App\\Http\\Controllers\\BOGPaymentController@getPaymentHistory',
        'as' => 'bog.payments.history',
        'namespace' => NULL,
        'prefix' => '/bog',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bog.payments.refund' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'bog/payments/refund/{transaction}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\BOGPaymentController@processRefund',
        'controller' => 'App\\Http\\Controllers\\BOGPaymentController@processRefund',
        'as' => 'bog.payments.refund',
        'namespace' => NULL,
        'prefix' => '/bog',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bog.payment.success' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bog/payment/success',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\BOGPaymentController@handleSuccess',
        'controller' => 'App\\Http\\Controllers\\BOGPaymentController@handleSuccess',
        'as' => 'bog.payment.success',
        'namespace' => NULL,
        'prefix' => '/bog',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bog.payment.fail' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bog/payment/fail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\BOGPaymentController@handleFailure',
        'controller' => 'App\\Http\\Controllers\\BOGPaymentController@handleFailure',
        'as' => 'bog.payment.fail',
        'namespace' => NULL,
        'prefix' => '/bog',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bog.webhook.payment-status' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'bog/webhook/payment-status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\BOGWebhookController@handlePaymentStatus',
        'controller' => 'App\\Http\\Controllers\\BOGWebhookController@handlePaymentStatus',
        'as' => 'bog.webhook.payment-status',
        'namespace' => NULL,
        'prefix' => '/bog',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:1:{s:13:"componentName";s:10:"auth.login";}s:8:"function";s:294:"function () use ($componentName) {
            $container = \\Illuminate\\Container\\Container::getInstance();

            return $container->call([
                $container->make(\\Livewire\\Volt\\LivewireManager::class)->new($componentName),
                \'__invoke\',
            ]);
        }";s:5:"scope";s:25:"Livewire\\Volt\\VoltManager";s:4:"this";N;s:4:"self";s:32:"0000000000000d050000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:1:{s:13:"componentName";s:13:"auth.register";}s:8:"function";s:294:"function () use ($componentName) {
            $container = \\Illuminate\\Container\\Container::getInstance();

            return $container->call([
                $container->make(\\Livewire\\Volt\\LivewireManager::class)->new($componentName),
                \'__invoke\',
            ]);
        }";s:5:"scope";s:25:"Livewire\\Volt\\VoltManager";s:4:"this";N;s:4:"self";s:32:"0000000000000cf70000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'forgot-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:1:{s:13:"componentName";s:20:"auth.forgot-password";}s:8:"function";s:294:"function () use ($componentName) {
            $container = \\Illuminate\\Container\\Container::getInstance();

            return $container->call([
                $container->make(\\Livewire\\Volt\\LivewireManager::class)->new($componentName),
                \'__invoke\',
            ]);
        }";s:5:"scope";s:25:"Livewire\\Volt\\VoltManager";s:4:"this";N;s:4:"self";s:32:"0000000000000cf90000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'reset-password/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'guest',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:1:{s:13:"componentName";s:19:"auth.reset-password";}s:8:"function";s:294:"function () use ($componentName) {
            $container = \\Illuminate\\Container\\Container::getInstance();

            return $container->call([
                $container->make(\\Livewire\\Volt\\LivewireManager::class)->new($componentName),
                \'__invoke\',
            ]);
        }";s:5:"scope";s:25:"Livewire\\Volt\\VoltManager";s:4:"this";N;s:4:"self";s:32:"0000000000000cfb0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'verification.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verify-email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:1:{s:13:"componentName";s:17:"auth.verify-email";}s:8:"function";s:294:"function () use ($componentName) {
            $container = \\Illuminate\\Container\\Container::getInstance();

            return $container->call([
                $container->make(\\Livewire\\Volt\\LivewireManager::class)->new($componentName),
                \'__invoke\',
            ]);
        }";s:5:"scope";s:25:"Livewire\\Volt\\VoltManager";s:4:"this";N;s:4:"self";s:32:"0000000000000cfd0000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'verification.notice',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'verification.verify' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verify-email/{id}/{hash}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'signed',
          3 => 'throttle:6,1',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\VerifyEmailController@__invoke',
        'controller' => 'App\\Http\\Controllers\\Auth\\VerifyEmailController',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'verification.verify',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'confirm-password',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:1:{s:13:"componentName";s:21:"auth.confirm-password";}s:8:"function";s:294:"function () use ($componentName) {
            $container = \\Illuminate\\Container\\Container::getInstance();

            return $container->call([
                $container->make(\\Livewire\\Volt\\LivewireManager::class)->new($componentName),
                \'__invoke\',
            ]);
        }";s:5:"scope";s:25:"Livewire\\Volt\\VoltManager";s:4:"this";N;s:4:"self";s:32:"0000000000000d000000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Livewire\\Actions\\Logout@__invoke',
        'controller' => 'App\\Livewire\\Actions\\Logout',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'storage.local' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'storage/{path}',
      'action' => 
      array (
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:3:{s:4:"disk";s:5:"local";s:6:"config";a:5:{s:6:"driver";s:5:"local";s:4:"root";s:56:"C:\\Users\\David\\Herd\\api.foodlyapp.ge\\storage\\app/private";s:5:"serve";b:1;s:5:"throw";b:0;s:6:"report";b:0;}s:12:"isProduction";b:0;}s:8:"function";s:323:"function (\\Illuminate\\Http\\Request $request, string $path) use ($disk, $config, $isProduction) {
                    return (new \\Illuminate\\Filesystem\\ServeFile(
                        $disk,
                        $config,
                        $isProduction
                    ))($request, $path);
                }";s:5:"scope";s:47:"Illuminate\\Filesystem\\FilesystemServiceProvider";s:4:"this";N;s:4:"self";s:32:"0000000000000cc70000000000000000";}}',
        'as' => 'storage.local',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'path' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
