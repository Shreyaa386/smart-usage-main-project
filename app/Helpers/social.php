<?php

if (! function_exists('social_login_enabled')) {
    function social_login_enabled(string $provider): bool
    {
        if (! in_array($provider, ['google', 'github'], true)) {
            return false;
        }

        $config = config("services.{$provider}");

        return filled($config['client_id'] ?? null) && filled($config['client_secret'] ?? null);
    }
}

if (! function_exists('any_social_login_enabled')) {
    function any_social_login_enabled(): bool
    {
        return social_login_enabled('google') || social_login_enabled('github');
    }
}
