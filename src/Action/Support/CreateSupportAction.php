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
    /** @var CreateSupportRequestValidator */
    private $requestValidator;

    /**
     * CreateSupportAction constructor.
     * @param CreateSupportRequestValidator $requestValidator
     */
    public function __construct(CreateSupportRequestValidator $requestValidator)
    {
        $this->requestValidator = $requestValidator;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response)
    {
        $errors = $this->requestValidator->validate($request);

        if (!empty($errors)) {
            return $response->withStatus(400)
                ->withJson(['errors' => $errors]);
        }

        return $response->withStatus(204);
    }
}
