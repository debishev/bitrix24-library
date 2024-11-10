<?php

namespace Debishev\Bitrix24Library\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\AccessToken\AccessTokenExtractorInterface;

class AccessTokenExtractor implements AccessTokenExtractorInterface
{
    const SESSION_KEY = 'Authorization';

    public function extractAccessToken(Request $request): ?string
    {
        $token =  $request->headers->get(self::SESSION_KEY,null);

        if ($token) {
            $token = str_ireplace('BEARER ','',$token);
            $token = str_ireplace('"','',$token);

        }

        return $token;
    }
}