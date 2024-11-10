<?php

namespace Debishev\Bitrix24Library\Core\Security;


use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Http\AccessToken\AccessTokenHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class AccessTokenHandler implements AccessTokenHandlerInterface
{

    public function __construct(
        private readonly JWTTokenManagerInterface $JWTManager

    )
    {

    }

    public function getUserBadgeFrom(string $accessToken): UserBadge
    {

        try {
            $user = $this->JWTManager->parse($accessToken);

            $username = $user['username'];
        } catch (\Exception $exception) {
            throw new HttpException(401, 'wrong token');
        }



        // and return a UserBadge object containing the user identifier from the found token
        // (this is the same identifier used in Security configuration; it can be an email,
        // a UUUID, a username, a database ID, etc.)
        return new UserBadge($username);
    }
}