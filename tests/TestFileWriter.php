<?php
use CLIFramework\IO\Writer;
class TestFileWriter implements Writer
{
    public function write($text)
    {
        file_put_contents(__DIR__ . '/test.log', $text, FILE_APPEND);
    }
    public function writeln($text)
    {
        file_put_contents(__DIR__ . '/test.log', $text  . "\n", FILE_APPEND);
    }
    public function writef($format)
    {
        $args = func_get_args();
        $this->write(call_user_func_array('sprintf', $args));
    }
}