<?php

namespace App\Shared\Infrastructure\Symfony\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RequestService
{

    /**
     * @throws \JsonException
     */
    public static function getField(Request $request, string $field, bool $isRequired = true, bool $isArray = false): mixed
    {
        $requestData = json_decode($request->getContent(), true, 512,
            JSON_THROW_ON_ERROR);

        if ($isArray) {
            $arrayData = self::arrayFlatten($requestData);
            foreach ($arrayData as $key => $value) {
                if ($key === $field) {
                    return $value;
                }
            }

            if ($isRequired) {
                throw new BadRequestHttpException("Field $field is required");
            }
            return null;
        }

        if (array_key_exists($field, $requestData)) {
            return $requestData[$field];
        }

        if ($isRequired) {
            throw new BadRequestHttpException("Field $field is required");
        }
        return null;
    }

    public static function arrayFlatten(array $array): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::arrayFlatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

}