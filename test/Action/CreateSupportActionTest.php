<?php
namespace Lavegui\Calendar\Test\Action;

use Lavegui\Calendar\Action\Support\CreateSupportAction;
use Lavegui\Calendar\Action\Support\CreateSupportRequestValidator;
use PHPUnit\Framework\TestCase;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CreateSupportActionTest
 * @package Lavegui\Calendar\Test\Action
 */
class CreateSupportActionTest extends TestCase
{
    /** @test */
    public function with_correct_data_should_return_no_content()
    {
        $data = [
            'email' => 'test@test',
            'date' => '2017-10-20',
        ];

        $request = Request::createFromEnvironment(new Environment());
        $request = $request->withParsedBody($data);

        $action = new CreateSupportAction(new CreateSupportRequestValidator());

        /** @var Response $response */
        $response = $action($request, new Response());

        $this->assertSame(204, $response->getStatusCode());
    }

    /**
     * @return array
     */
    public function badDataProvider()
    {
        return [
            'without email response one error' => [
                ['date' => '2017-10-20'], 1
            ],
            'empty email response one error' => [
                ['date' => '2017-10-20', 'email' => ''], 1
            ],
            'without date response one error' => [
                ['email' => 'test@test'], 1
            ],
            'empty date response one error' => [
                ['email' => 'test@test', 'date' => ''], 1
            ],
            'empty data response two errors' => [
                [], 2
            ]
        ];
    }

    /**
     * @dataProvider badDataProvider
     * @test
     * @param array $data
     * @param int $errorCount
     */
    public function incorrect_data_should_return_bad_request($data, $errorCount)
    {
        $request = Request::createFromEnvironment(new Environment());
        $request = $request->withParsedBody($data);

        $action = new CreateSupportAction(new CreateSupportRequestValidator());

        /** @var Response $response */
        $response = $action($request, new Response());

        $this->assertSame(400, $response->getStatusCode());

        $body = json_decode((string)$response->getBody(), true);

        $this->assertArrayHasKey('errors', $body);
        $this->assertCount($errorCount, $body['errors']);
    }
}
