<?php

return [
    'supportedLocales' => [
        'en' => ['name' => 'English',       'native' => 'English'],
        'my' => ['name' => 'Burmese',       'native' => 'မြန်မာ'],
        'th' => ['name' => 'Thai',          'native' => 'ไทย'],
    ],

    'useAcceptLanguageHeader' => true,
    'hideDefaultLocaleInURL' => false,
    'localeKey' => 'locale',

    // 🔽 This ensures fallback to English
    'localesOrder' => ['en', 'my', 'th'],
    'default' => 'en',
    'useFallback' => true,
    'fallbackLocale' => 'en',
];
