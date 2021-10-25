<?php

declare(strict_types=1);

namespace Tuzex\Bundle\Superfaktura\Http;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Tuzex\Superfaktura\Http\HttpClient;
use Tuzex\Superfaktura\Http\Request;
use Tuzex\Superfaktura\Http\Response;

final class SymfonyHttpClient implements HttpClient
{
    public function __construct(
        private HttpClientInterface $httpClient
    ) {
    }

    public function send(Request $request): Response
    {
        return new SymfonyHttpClientResponse(
            $this->httpClient->request($request->getMethod(), $request->getUri(), $request->getData())
        );
    }
}
