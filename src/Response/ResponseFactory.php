<?php

namespace ArvPayoneApi\Response;

class ResponseFactory
{
    /**
     * @param string $responseData
     *
     * @return ResponseContract
     */
    public static function create($responseData)
    {
        if (strpos($responseData, 'clearing') !== false) {
            $authResponse = new ResponseWithClearing($responseData);

            $clearing = new Clearing($authResponse->getResponseData());
            $authResponse->setClearing($clearing);

            return $authResponse;
        }

        return new GenericResponse($responseData);
    }
}
