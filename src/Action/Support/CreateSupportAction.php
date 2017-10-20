<?php
namespace Lavegui\Calendar\Action\Support;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class CreateSupportAction
 * @package Lavegui\Calendar\Action\Support
 */
class CreateSupportAction
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response)
    {
        return $response->withStatus(204);
    }
}
