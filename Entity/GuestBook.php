<?php
require_once('Message.php');

class GuestBook
{
    protected $file;

    public function __construct(String $file)
    {
        if(!file_exists($this->file)) {
            touch($file);
        }
        $this->file = $file;
    }

    public function addMessage(Message $message)
    {

        file_put_contents($this->file, $message->toJson(). PHP_EOL, FILE_APPEND);
    }

    public function getMessages()
    {
        $content = trim(file_get_contents($this->file));
        $lines = explode(PHP_EOL, $content);
        $messages = [];
        if(count($lines) > 0) {
            foreach($lines as $line) {
                $data = json_decode($line, true);
                if($data != null) {
                    $messages[] = Message::fromJSON($line);
                }
            }
        }

        return array_reverse($messages);
    }
}