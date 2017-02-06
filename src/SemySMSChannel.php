<?php namespace NotificationChannels\SemySMS;

use Illuminate\Notifications\Notification;
use GuzzleHttp\Client;

class SemySMSChannel{
    protected $client;

    public function __construct(Client $client){
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     * @return object
     *
     */
    public function send($notifiable, Notification $notification){
	    $message = $notification->toSemySms($notifiable);
        if (!$to = $notifiable->routeNotificationFor('semy-sms')) return;

        $result = $this->client->request('POST', 'https://semysms.net/api/3/sms.php', [
          'form_params' => [
            'token' => config('services.semysms.token'),
            'device' => config('services.semysms.device'),
            'phone' => $to,
            'msg' => $message->text
          ]
        ]);

        return json_decode($result->getBody());
    }
}
