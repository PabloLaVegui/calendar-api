<?php
namespace Lavegui\Calendar\Test\Action;

use Lavegui\Calendar\Action\Support\CreateSupportAction;
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

        $action = new CreateSupportAction();

        $request = Request::createFromEnvironment(new Environment());
        $request->withParsedBody($data);

        /** @var Response $response */
        $response = $action($request, new Response());

        $this->assertSame(204, $response->getStatusCode());
    }
}
