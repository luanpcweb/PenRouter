<?php

namespace Pen\Http;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
    private $resource = [];

    public function __toString()
    {
        return implode(PHP_EOL, $this->resource);
    }

    public function close()
    {
        $this->resource = null;
    }

    public function detach()
    {
        $this->resource = null;

        return null;
    }

    public function getSize()
    {
        return count($this->resource);
    }

    public function tell()
    {

    }

    public function eof()
    {

    }

    public function isSeekable()
    {

    }

    public function seek($offset, $whence = SEEK_SET)
    {

    }

    public function rewind()
    {

    }

    public function isWritable()
    {
        return !is_null($this->resource);
    }

    public function write($string)
    {
        $this->resource[] = $string;

        return count($this->resource);
    }

    public function isReadable()
    {

    }

    public function read($length){
        return implode(PHP_EOL, array_splice($this->resource, 0, $length));
    }

    public function getContents()
    {
        return implode(PHP_EOL, $this->resource);
    }

    public function getMetadata($key = null)
    {

    }
}
