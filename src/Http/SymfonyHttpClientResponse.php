<?php

declare(strict_types=1);

namespace Tuzex\Bundle\Superfaktura\Http;

use Symfony\Contracts\HttpClient\ResponseInterface;
use Tuzex\Superfaktura\Http\Response;

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
