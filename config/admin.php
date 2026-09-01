<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin panel URL path
    |--------------------------------------------------------------------------
    |
    | The URL segment the admin area is served under (e.g. "admin" for
    | /admin). Change ADMIN_PATH in .env to a harder-to-guess value so the
    | login page isn't sitting at the first path automated scanners try.
    | Internal route names (admin.*) are unaffected by this value.
    |
    */

    'path' => env('ADMIN_PATH', 'admin'),

];
