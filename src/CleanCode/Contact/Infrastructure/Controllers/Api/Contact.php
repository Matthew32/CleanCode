<?php

namespace CleanCode\Contact\Infrastructure\Controllers\Api;

use CleanCode\CleanCode\Contact\Infrastructure\Exceptions\ErrorOnSave;
use CleanCode\Contact\Application\Create;
use CleanCode\Contact\Domain\Contact as ContactDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Contact
{
    public function save(Request $request, Create $contactCreateUseCase, ContactDomain $contactToSave, ErrorOnSave $errorOnSaveException)
    {
        try {
            $requestValidator = Validator::make($request->all(), ([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'phoneNumber' => 'max:255',
                'message' => 'required',
            ]));

            if ($requestValidator->fails()) {
                return response()->json($requestValidator->errors())->setStatusCode(422);
            }
            $contactName = $request->get('name');
            $contactToSave->setName($contactName)
                ->setEmail($request->get('email'))
                ->setPhoneNumber($request->get('phoneNumber'))
                ->setMessage($request->get('message'));

            $savedContact = $contactCreateUseCase($contactToSave);
            if (!$savedContact) {
                throw $errorOnSaveException;
            }
            return response()->json($savedContact)->setStatusCode(200);
        } catch (\Throwable $e) {
            \Log::error($e);
        }
        return response()->json(['message' => 'error_on_save'])->setStatusCode(500);
    }
}
