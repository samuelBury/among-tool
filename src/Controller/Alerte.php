<?php


namespace App\Controller;


class Alerte
{
private $message;
private $color;

/**
 * @return mixed
 */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

}