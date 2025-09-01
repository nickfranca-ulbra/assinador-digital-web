<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ParChavesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        if (empty(config('app.private_key')) || empty(config('app.public_key'))) {
            $parChaves = openssl_pkey_new([
                'private_key_bits' => 2048,
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
            ]);

            openssl_pkey_export($parChaves, $privateKey);
            $publicKey = openssl_pkey_get_details($parChaves)['key'];

            config([
                'app.private_key' => $privateKey,
                'app.public_key' => $publicKey,
            ]);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
