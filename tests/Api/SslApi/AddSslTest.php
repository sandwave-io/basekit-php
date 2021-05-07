<?php declare(strict_types = 1);

namespace SandwaveIo\BaseKit\Tests\Api\SitesApi;

use PHPUnit\Framework\TestCase;
use SandwaveIo\BaseKit\Tests\Helpers\MockedClientFactory;

final class AddSslTest extends TestCase
{
    const CERT = "-----BEGIN CERTIFICATE-----\nMIIDXTCCAkWgAwIBAgIJAJzF83HrOtgIMA0GCSqGSIb3DQEBCwUAMEUxCzAJBgNV\nBAYTAkFVMRMwEQYDVQQIDApTb21lLVN0YXRlMSEwHwYDVQQKDBhJbnRlcm5ldCBX\naWRnaXRzIFB0eSBMdGQwHhcNMTYwNzI3MTQ1NzI4WhcNMTYwODA2MTQ1NzI4WjBF\nMQswCQYDVQQGEwJBVTETMBEGA1UECAwKU29tZS1TdGF0ZTEhMB8GA1UECgwYSW50\nZXJuZXQgV2lkZ2l0cyBQdHkgTHRkMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIB\nCgKCAQEA5k3MeLJUSK52Oqzz5vdNVZOqkLJNUZueLomO+fMFJXhAGjfFZPkgLD+B\nbNWxHD/AcydOe31tJvD0TAH4gFz+wpVk3DA50KN5crN69YQrUQHvYxOxSBUq+TXB\n8vvL+3/W1JzvwY6r4jUVpLwQaUsfUWxWner0CG9cbrK3dK6nSAhdIzuh2NMwINbs\nyNEv/QXuH0UYpcBNuzYJPwsNzpIoqQSCu2l43E9n1zNRBK7AjkYH4bpZWiGdYLlO\neRqTkSpGg7KmeyQt+8q59n0IUOhR+6R/xz1Fsm9ZhPiEeO9a78d7qaNqWqNrnPIs\nMHhFBKD44Mm8K982NXMFjIj1jrECCQIDAQABo1AwTjAdBgNVHQ4EFgQUxfP/l1BX\nLsNBFcfLWhJJ0RJTCD0wHwYDVR0jBBgwFoAUxfP/l1BXLsNBFcfLWhJJ0RJTCD0w\nDAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQsFAAOCAQEAQjjkhYV24nOYNxY6ekJ8\nMiNTke1VEc92Kb3lyStKyV9hzv/zr/h6Lk6dFBUOEL/h1ipMVBXyVWbCLKDvuqS+\nk3VW4WD/KAJHIMAeDa2K1uVzj7vIvjRGzkwOwGELnt1M0WWVFeB8kFZ7yHNjU9NA\n9vp6an7Rabg8zepHYrfo2Q6mPasKB5ac/UZ3FCtMS/VvHFi5uCVFyYpbsQJFxbjE\n6U+nVfSVh9Bx+LjK/j9mnKvNUZtF1sO9yxiBOtDy6DuyVIbXvxnuLKHg2TDp5SPl\nB0FCOb0wBY1rkD76MZQjnAUP6R1sfioMmwIj8L2nI+90BleerFRmql49FMnx4hzZ\nkA==\n-----END CERTIFICATE-----";
    const KEY = "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDmTcx4slRIrnY6\nrPPm901Vk6qQsk1Rm54uiY758wUleEAaN8Vk+SAsP4Fs1bEcP8BzJ057fW0m8PRM\nAfiAXP7ClWTcMDnQo3lys3r1hCtRAe9jE7FIFSr5NcHy+8v7f9bUnO/BjqviNRWk\nvBBpSx9RbFad6vQIb1xusrd0rqdICF0jO6HY0zAg1uzI0S/9Be4fRRilwE27Ngk/\nCw3OkiipBIK7aXjcT2fXM1EErsCORgfhullaIZ1guU55GpORKkaDsqZ7JC37yrn2\nfQhQ6FH7pH/HPUWyb1mE+IR471rvx3upo2pao2uc8iwweEUEoPjgybwr3zY1cwWM\niPWOsQIJAgMBAAECggEARKplkIb7AkCiF5SBlBegAyfn7wR6cR6I5y80ZenDWwyj\ncC24uQZeRVMZ7603BUksxCiwCbm31ah57j+YLA2OF84bKFtooYBcMYq52oHxuFFv\nYob4kJlfGraggSX6B55yGyo/geJb9TIGpfs8mWhAijJXEPaAlBM/5/F5KVz5m0vy\nTkJZJsYC64QTmpdp3hb03cxHXptYiTPO3YblMeHqv/d9MlaW7dPZa7sz5sv6OfYQ\nN9SnmBfL2SXHLH2ZkHwtX7jjN8Cr+ARNNFE+puvNTrRheAA2sA9hCwLofKiluGKX\nTE8p+ssIDyiIuooAlB/FITsWbhsmh6S0zGF+6up+kQKBgQDy7ZRR7GmDWQXr4k4P\npXAJ7SwxgP2qeuY8zn9Zp4hp2davck/EsnGOk528lttU0cINGxhY1YT4f+V6Y8zk\n9tTyqyOABdZQydR/CxkIOlhdb8IbX35VD59dre5dGLhIv/yYDrH5vVvJoseCX9AL\nCrdVKhYWzdg0XnfczBOdgnKvNwKBgQDyslE3zWZZ6F+OughwgKkV3bWvMHapRUkk\naSItGAJme00YmAaPKPB2YXJ5GYHdYM1sXadNcHGevASCP7BwbD8H6XTbTPQY7Z8r\nPgBxmIw7QsG9zcHJfFHh0M3XhAul9MeyTmYrQal9DiAUNcN9IcndjljHkoRMy5EV\nxE5qfTX4vwKBgAnpa63UCZIUZct0Fl9JDsM47B6w9qioDxDYFBYiYcx/2OSbs2mB\nJmT83Oi+9wAE9vf17Q5i1+QTw9c0jz2gXJvyI6arlk0BjywH1eOiDczyLGdVhCAQ\nXR5DZIBj69D8FGBX6ScZdM9LVvyY0DJDI6vT5cbUa0fnuthFc19v3SINAoGBANdw\n5do0crRDLHiluhIslGy9uKfAzMVspQY2cck39AGHWSQI6GGzROrBjH3l37tmUFTv\nOjHrLGFtpE7/PKA/5yAd5Mc8I7/xSId5balpcqq0kwnrmihDPOjJk8DKDhEPHyqw\nn8+sZUmG/YETTOtK0EjmMPdQoDMPzkZVUgsEBaI/AoGAM0F0TWrrhBT/ih5l3WM7\nX+nNXCuNBCpr06ohGewGPAldreVf1KuRkwmrSpm6taC+P2fqZBjMoXy9mP9ZzEGb\nlk82UOdJR3BRS8BqDKbRAktxTd35jaCdca/f3mkvrZ7a6jYgs7iD/xlaGtS6vTkz\nbZArr0TwEz+uvMU4YTtaMCA=\n-----END PRIVATE KEY-----";
    const DOMAINS = ['mydomain.com', 'yourdomain.co.uk'];

    public function testAddSsl(): void
    {
        $client = MockedClientFactory::makeSdk(
            204,
            '',
            MockedClientFactory::assertRoute('PUT', '/ssl-certs/example.com')
        );

        $client->sslApi->addSsl('example.com', self::KEY, self::CERT, self::DOMAINS);
    }
}