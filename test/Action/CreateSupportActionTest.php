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

    /** @test */
    public function without_email_should_return_bad_request()
    {
        $data = [
            'date' => '2017-10-20',
        ];

        $request = Request::createFromEnvironment(new Environment());
        $request = $request->withParsedBody($data);

        $action = new CreateSupportAction(new CreateSupportRequestValidator());

        /** @var Response $response */
        $response = $action($request, new Response());

        $this->assertSame(400, $response->getStatusCode());

        $body = json_decode((string)$response->getBody(), true);

        $this->assertArrayHasKey('errors', $body);
        $this->assertCount(1, $body['errors']);
    }
}
