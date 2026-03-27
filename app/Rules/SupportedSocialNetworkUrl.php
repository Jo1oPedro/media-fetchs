<?php

namespace App\Rules;

use App\Models\SocialNetwork;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Log;

class SupportedSocialNetworkUrl implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $host = parse_url($value , PHP_URL_HOST);

        $isSupported = SocialNetwork::query()
            ->get("base_url")
            ->contains(function ($network) use ($host) {
                return str_contains($host, parse_url($network->base_url, PHP_URL_HOST));
            }
        );

        if(!$isSupported) {
            $fail("A URL inserida não pertence a uma rede social suportada.");
        }
    }
}
