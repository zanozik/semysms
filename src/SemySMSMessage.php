<?php namespace NotificationChannels\SemySMS;

//use Illuminate\Support\Arr;

class SemySMSMessage{
    public $text;

    public function text($text){
        $this->text = $text;
        return $this;
    }
}
