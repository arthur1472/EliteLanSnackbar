<?php

return [
    'show_images' => env('SHOW_IMAGES'),
    'status' => env('DISCORD_WEBHOOK_STATUS_CHANGE'),
    'note' => env('DISCORD_WEBHOOK_ADMIN_NOTE_CHANGE'),
    'new' => env('DISCORD_WEBHOOK_NEW'),

    'top_up_5_euro' => env('TOP_UP_5_EURO', '#'),
    'top_up_10_euro' => env('TOP_UP_10_EURO', '#'),
];
