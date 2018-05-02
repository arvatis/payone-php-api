<?php

namespace ArvPayoneApi\Request\PreAuthorization;

use ArvPayoneApi\Request\Authorization\RequestFactory as AuthorizationRequestFactory;
use ArvPayoneApi\Request\RequestFactoryContract;
use ArvPayoneApi\Request\Types;

class RequestFactory extends AuthorizationRequestFactory implements RequestFactoryContract
{
    protected static $requestType = Types::PREAUTHORIZATION;
}
