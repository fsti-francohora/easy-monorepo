<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyApiToken\Tests\Decoders;

use StepTheFkUp\EasyApiToken\Decoders\JwtTokenInQueryDecoder;
use StepTheFkUp\EasyApiToken\Tests\AbstractFirebaseJwtTokenTestCase;
use StepTheFkUp\EasyApiToken\Tokens\JwtEasyApiToken;

final class FirebaseJwtTokenInQueryDecoderTest extends AbstractFirebaseJwtTokenTestCase
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
        foreach (static::$algos as $algo) {
            $key = static::$key;

            if ($this->isAlgoRs($algo)) {
                $key = $this->getOpenSslPublicKey();
            }

            $jwtEasyApiTokenFactory = $this->createJwtEasyApiTokenFactory($this->createFirebaseJwtDriver(
                null,
                $key,
                null,
                [$algo]
            ));
            $decoder = new JwtTokenInQueryDecoder($jwtEasyApiTokenFactory, 'param');
            $request = $this->createServerRequest(null, [
                'param' => $this->createToken($algo)
            ]);

            /** @var \StepTheFkUp\EasyApiToken\Interfaces\Tokens\JwtEasyApiTokenInterface $token */
            $token = $decoder->decode($request);

            $payload = $token->getPayload();

            self::assertInstanceOf(JwtEasyApiToken::class, $token);

            foreach (static::$tokenPayload as $key => $value) {
                self::assertArrayHasKey($key, $payload);
                self::assertEquals($value, $payload[$key]);
            }
        }
    }

    /**
     * JwtTokenInQueryDecoder should return null if query param not set on request.
     *
     * @return void
     *
     * @throws \StepTheFkUp\EasyApiToken\Exceptions\InvalidEasyApiTokenFromRequestException
     */
    public function testNullWhenQueryParamNotSet(): void
    {
        $decoder = new JwtTokenInQueryDecoder(
            $this->createJwtEasyApiTokenFactory(
                $this->createFirebaseJwtDriver()
            ),
            'param'
        );

        self::assertNull($decoder->decode($this->createServerRequest()));
    }
}

\class_alias(
    FirebaseJwtTokenInQueryDecoderTest::class,
    'LoyaltyCorp\EasyApiToken\Tests\Decoders\FirebaseJwtTokenInQueryDecoderTest',
    false
);
