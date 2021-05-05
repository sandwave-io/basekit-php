<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Api;

use SandwaveIo\BaseKit\Api\Interfaces\SslApiInterface;

final class SslApi extends AbstractApi implements SslApiInterface
{
    /**
     * This function will add your supplied ssl certificate to your created website.
     *
     * @param string        $domain
     * @param string        $privateKey    PEM formatted private key
     * @param string        $certificate   PEM formatted certificate
     * @param array<string> $domains       List of additional domains
     * @param array<string> $intermediates
     */
    public function addSsl(
        string $domain,
        string $privateKey,
        string $certificate,
        array $domains = [],
        array $intermediates = []
    ): void {
        $payload = [
            'key' => $privateKey,
            'cert' => $certificate,
        ];

        if (count($domains) > 1) {
            $payload['domains'] = $domains;
        }

        if (count($intermediates) > 1) {
            $payload['intermediates'] = $intermediates;
        }

        $this->client->post("/ssl-certs/{$domain}", $payload);
    }
}
