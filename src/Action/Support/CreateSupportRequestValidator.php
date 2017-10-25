<?php
namespace Lavegui\Calendar\Action\Support;

use Slim\Http\Request;

/**
 * Class CreateSupportRequestValidator
 * @package Lavegui\Calendar\Action\Support
 */
class CreateSupportRequestValidator
{
    /**
     * @param Request $request
     * @return array
     */
    public function validate(Request $request)
    {
        $data = $request->getParsedBody();

        $errors = [];
        if (!isset($data['email'])) {
            $errors[] = ['message' => 'The email is required'];
        }
        if (isset($data['email']) && empty($data['email'])) {
            $errors[] = ['message' => 'Email can not be empty'];
        }

        return $errors;
    }
}
