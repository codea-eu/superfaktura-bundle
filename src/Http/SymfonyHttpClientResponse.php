<?php

declare(strict_types=1);

namespace Codea\Bundle\Superfaktura\Http;

use Codea\Superfaktura\Http\Response;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class SymfonyHttpClientResponse implements Response
{
    public function __construct(
        private ResponseInterface $response,
    ) {
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function getHeaders(): array
    {
        return $this->response->getHeaders(false);
    }

    public function getPayload(): array
    {
        return $this->response->toArray(false);
    }
}
