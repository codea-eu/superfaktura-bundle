<?php

declare(strict_types=1);

namespace Codea\Bundle\Superfaktura\Http;

use Codea\Superfaktura\Http\HttpClient;
use Codea\Superfaktura\Http\Request;
use Codea\Superfaktura\Http\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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
