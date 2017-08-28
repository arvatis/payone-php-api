<?php

namespace ArvPayoneApi\Unit\Lib;

use ArvPayoneApi\Lib\Version;

class VersionTest extends \PHPUnit_Framework_TestCase
{
    public function testNonEmptyVersionCanBeRetrieved()
    {
        self::assertTrue((bool) Version::getVersion());
    }
}
