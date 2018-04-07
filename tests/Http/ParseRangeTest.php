<?php

namespace Http;

use GuzzleHttp\Psr7;
use Psr\Http\Message\RequestInterface;


class ParseRangeTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $request = new Psr7\Request('GET', '/', ['Range' => 'bytes=0-500,1000-1499,-200']);

        $parseRange = function (RequestInterface $request)
        {
            $headers = $request->getHeader('Range');
            $headers = str_replace([' ', 'bytes', '='], [], $headers);
            $headers = array_map(function ($val) { return explode(',', $val); }, $headers);

            return $headers;
        };

        $this->assertEquals([['0-500', '1000-1499', '-200']], $parseRange($request));
    }
}
