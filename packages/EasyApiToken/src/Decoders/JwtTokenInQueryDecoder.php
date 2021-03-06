<?php
declare(strict_types=1);

namespace StepTheFkUp\EasyApiToken\Decoders;

use Psr\Http\Message\ServerRequestInterface;
use StepTheFkUp\EasyApiToken\Interfaces\EasyApiTokenDecoderInterface;
use StepTheFkUp\EasyApiToken\Interfaces\EasyApiTokenInterface;
use StepTheFkUp\EasyApiToken\Interfaces\Tokens\Factories\JwtEasyApiTokenFactoryInterface;
use StepTheFkUp\EasyApiToken\Traits\EasyApiTokenDecoderTrait;

final class JwtTokenInQueryDecoder implements EasyApiTokenDecoderInterface
{
    use EasyApiTokenDecoderTrait;

    /**
     * @var \StepTheFkUp\EasyApiToken\Interfaces\Tokens\Factories\JwtEasyApiTokenFactoryInterface
     */
    private $jwtEasyApiTokenFactory;

    /**
     * @var string
     */
    private $queryParam;

    /**
     * JwtTokenInQueryDecoder constructor.
     *
     * @param \StepTheFkUp\EasyApiToken\Interfaces\Tokens\Factories\JwtEasyApiTokenFactoryInterface $jwtEasyApiTokenFactory
     * @param string $queryParam
     */
    public function __construct(JwtEasyApiTokenFactoryInterface $jwtEasyApiTokenFactory, string $queryParam)
    {
        $this->jwtEasyApiTokenFactory = $jwtEasyApiTokenFactory;
        $this->queryParam = $queryParam;
    }

    /**
     * Decode API token for given request.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return null|\StepTheFkUp\EasyApiToken\Interfaces\EasyApiTokenInterface
     *
     * @throws \StepTheFkUp\EasyApiToken\Exceptions\InvalidEasyApiTokenFromRequestException
     */
    public function decode(ServerRequestInterface $request): ?EasyApiTokenInterface
    {
        $jwtToken = $this->getQueryParam($this->queryParam, $request);

        if (empty($jwtToken)) {
            return null;
        }

        return $this->jwtEasyApiTokenFactory->createFromString((string)$jwtToken);
    }
}

\class_alias(
    JwtTokenInQueryDecoder::class,
    'LoyaltyCorp\EasyApiToken\Decoders\JwtTokenInQueryDecoder',
    false
);
