<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Company Contact Information
    |--------------------------------------------------------------------------
    |
    | Used across landing page views. Change values via .env to avoid
    | touching source files.
    |
    */

    'name'          => env('COMPANY_NAME', 'UD Jaya Mebel'),
    'address'       => env('COMPANY_ADDRESS', 'Jl. Raya Mebel No.1, Jepara'),
    'hours'         => env('COMPANY_HOURS', 'Sen–Sab, 09.00–20.00 WIB'),

    // Used in wa.me/ links — digits only, no leading +
    'whatsapp'      => env('COMPANY_WHATSAPP', '620000000000'),

    // Used in tel: links — include country code with +
    'phone'         => env('COMPANY_PHONE', '+620000000000'),

    // Human-readable phone number shown in footer
    'phone_display' => env('COMPANY_PHONE_DISPLAY', '+62 800-0000-0000'),

    'email'         => env('COMPANY_EMAIL', 'cs@jayamebel.id'),
];
