<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyApiToken\Tests\Decoders;

use StepTheFkUp\EasyApiToken\Decoders\JwtTokenDecoder;
use StepTheFkUp\EasyApiToken\Exceptions\InvalidEasyApiTokenFromRequestException;
use StepTheFkUp\EasyApiToken\Tests\AbstractAuth0JwtTokenTestCase;
use StepTheFkUp\EasyApiToken\Tokens\JwtEasyApiToken;

final class Auth0JwtTokenDecoderTest extends AbstractAuth0JwtTokenTestCase
{
    /**
     * JwtTokenDecoder should decode token successfully for each algorithms.
     *
     * @return void
     *
     * @throws \StepTheFkUp\EasyApiToken\Exceptions\InvalidEasyApiTokenFromRequestException
     */
    public function testJwtTokenDecodeSuccessfully(): void
    {
        $jwtEasyApiTokenFactory = $this->createJwtEasyApiTokenFactory($this->createAuth0JwtDriver());

        /** @var \StepTheFkUp\EasyApiToken\Interfaces\Tokens\JwtEasyApiTokenInterface $token */
        $token = (new JwtTokenDecoder($jwtEasyApiTokenFactory))->decode($this->createServerRequest([
            'HTTP_AUTHORIZATION' => 'Bearer ' . $this->createToken()
        ]));

        $payload = $token->getPayload();

        self::assertInstanceOf(JwtEasyApiToken::class, $token);

        foreach (static::$tokenPayload as $key => $value) {
            self::assertArrayHasKey($key, $payload);
            self::assertEquals($value, $payload[$key]);
        }
    }

    /**
     * JwtTokenDecoder should return null if Authorization header not set.
     *
     * @return void
     *
     * @throws \StepTheFkUp\EasyApiToken\Exceptions\InvalidEasyApiTokenFromRequestException
     */
    public function testJwtTokenNullIfAuthorizationHeaderNotSet(): void
    {
        $decoder = new JwtTokenDecoder($this->createJwtEasyApiTokenFactory($this->createAuth0JwtDriver()));

        self::assertNull($decoder->decode($this->createServerRequest()));
    }

    /**
     * JwtTokenDecoder should return null if Authorization header doesn't start with "Bearer ".
     *
     * @return void
     *
     * @throws \StepTheFkUp\EasyApiToken\Exceptions\InvalidEasyApiTokenFromRequestException
     */
    public function testJwtTokenNullIfDoesntStartWithBearer(): void
    {
        $decoder = new JwtTokenDecoder($this->createJwtEasyApiTokenFactory($this->createAuth0JwtDriver()));

        self::assertNull($decoder->decode($this->createServerRequest(['HTTP_AUTHORIZATION' => 'SomethingElse'])));
    }

    /**
     * JwtTokenDecoder should throw an exception if unable to decode token because token is invalid.
     *
     * @return void
     *
     * @throws \StepTheFkUp\EasyApiToken\Exceptions\InvalidEasyApiTokenFromRequestException
     */
    public function testJwtTokenThrowExceptionIfUnableToDecodeToken(): void
    {
        $this->expectException(InvalidEasyApiTokenFromRequestException::class);

        $jwtEasyApiTokenFactory = $this->createJwtEasyApiTokenFactory($this->createAuth0JwtDriver());

        (new JwtTokenDecoder($jwtEasyApiTokenFactory))->decode($this->createServerRequest([
            'HTTP_AUTHORIZATION' => 'Bearer WeirdTokenHere'
        ]));
    }
}

\class_alias(
    Auth0JwtTokenDecoderTest::class,
    'LoyaltyCorp\EasyApiToken\Tests\Decoders\Auth0JwtTokenDecoderTest',
    false
);
