<?php

// Dev
if (env('CONFIG_ENV') == 'dev') {
    # code...
    return [
        "API_ADMIN_VERSION" => "v3.7.1/",
    "API_CLIENT_VERSION" => "v3.7.1",
    "BASE_API_CLIENT_URL" => "https://tulabi.com:3801",
    "BASE_API_ADMIN_URL" => "https://tulabi.com:3701",
    "BASE_FILE_URL" => "https://dev.santara.id",
    "BASE_API_FILE" => "https://tulabi.com:3801",
    "STORAGE_GOOGLE" => "https://storage.googleapis.com/asset-santara-staging/santara.co.id/",
    "STORAGE_GOOGLE_BUCKET" => "asset-santara-staging",
    "STORAGE_GOOGLE_BUCKET2" => "santara-bucket-staging",
    "STORAGE_BUCKET" => "https://storage.googleapis.com/asset-bucket-staging/",
    "STORAGE_BUCKET2" => "https://storage.googleapis.com/santara-bucket-staging/"
];
}else{

    
    // Production
return [
    "API_ADMIN_VERSION" => "v3.7.1/",
    "API_CLIENT_VERSION" => "v3.7.1",
    "BASE_API_CLIENT_URL" => "https://fire.santarax.com:3701",
    "BASE_API_ADMIN_URL" => "https://fire.santarax.com:3801",
    "BASE_FILE_URL" => "https://santara.co.id",
    "BASE_API_FILE" => "https://fire.santarax.com:3701",
    "STORAGE_GOOGLE" => "https://storage.googleapis.com/asset-santara/santara.co.id/",
    "STORAGE_GOOGLE_BUCKET" => "asset-santara",
    "STORAGE_GOOGLE_BUCKET2" => "santara-bucket-prod",
    "STORAGE_BUCKET" => "https://storage.googleapis.com/asset-bucket-prod/",
    "STORAGE_BUCKET2" => "https://storage.googleapis.com/santara-bucket-prod/"
];
}