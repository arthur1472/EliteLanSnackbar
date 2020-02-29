<?php

return [
    'webhooks' => [
        'status_change' => getenv('DISCORD_WEBHOOK_STATUS_CHANGE'),
        'admin_note_change' => getenv('DISCORD_WEBHOOK_ADMIN_NOTE_CHANGE')
    ]
];
