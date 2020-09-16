<?php

class Message
{
    protected $username;
    protected $message;
    protected $createdAt;

    public function __construct(String $username, String $message, ?DateTime $createdAt = null)
    {
        $this->username = $username;
        $this->message = $message;
        $this->createdAt = $createdAt ?: new DateTime();
        $this->createdAt->setTimeZone(new DateTimeZone('Europe/Paris'));
    }

    public function isValid() : Bool
    {
        return empty($this->getErrors());
    }

    public function getErrors() : Array
    {
        $errors = [];
        if(strlen($this->username) < 3) {
            $errors[] = 'Le champ nom d\'utilisateur doit comporter au moins 3 caractères.<br>';
        }
        if(strlen($this->message) < 3) {
            $errors[] = 'Le champ message doit comporter au moins 3 caractères.<br>';
        }
        return $errors;
    }

    public function toHTML() : String
    {
        return '<p><strong>'. htmlentities($this->username) . '</strong> <em> le '.$this->createdAt->format('d/m/Y à H:i'). '</em><br>'. nl2br(htmlentities($this->message)).'</p>';
    }

    public function toJson() : String
    {
        $object = [
            'username' => $this->username,
            'message' => $this->message,
            'createdAt' => $this->createdAt->getTimeStamp()
        ];
        return json_encode($object);
    }

    public static function fromJSON(String $json)
    {
        $data = json_decode($json, true);
        return new self($data['username'], $data['message'], new DateTime('@' .$data['createdAt']));
    }
}