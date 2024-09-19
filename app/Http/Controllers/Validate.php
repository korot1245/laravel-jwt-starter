<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

trait Validate
{
    /**
     * @param array $rules
     * @return array
     * @throws ValidationException
     */
    protected function validateRequest(array $rules, array $data = [], array $messages = []): array
    {
        $req = request();
        $reqData = [];
        /** @psalm-suppress RedundantConditionGivenDocblockType */
        if ($req instanceof Request) {
            $reqData = $req->all();
        }
        $v = sizeof($data) ? Validator::make($data, $rules, $messages) : Validator::make($reqData, $rules, $messages);
        if ($v->fails()) {
            $response = [
                'error' => 'user_validation_error',
                'errors' => array_map(fn(array $error): mixed => $error[0], $v->errors()->toArray()),
            ];
            throw new ValidationException($v, response()->json($response, 422));
        }

        return $v->validated();
    }
}
