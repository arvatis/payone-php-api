<?php

namespace ArvPayoneApi\Response;

class ResponseFactory
{
    /**
     * @param string $response
     *
     * @return ResponseContract|GenericResponse|ResponseWithClearing
     */
    public static function create($response)
    {
        $responseData = self::parseResponse($response);
        if (strpos($response, 'clearing') !== false) {
            $authResponse = new ResponseWithClearing($responseData);

            $clearing = new Clearing($authResponse->getResponseData());
            $authResponse->setClearing($clearing);

            return $authResponse;
        }

        return new GenericResponse($responseData);
    }

    /**
     * @param string $response
     *
     * @return array
     */
    private static function parseResponse($response)
    {
        $responseData = [];
        $separator = "\n\t";
        $line = strtok($response, $separator);

        while ($line !== false) {
            $responseData += self::parseLine($line);
            $line = strtok($separator);
        }

        return $responseData;
    }

    /**
     * @param $line
     *
     * @return array
     */
    private static function parseLine($line)
    {
        if (!trim($line)) {
            return [];
        }
        list($key, $value) = explode('=', $line, 2);

        return [trim($key) => trim($value)];
    }
}
