<?php namespace NotificationChannels\SemySMS;

//use NotificationChannels\SemySMS\Exceptions\CouldNotSendNotification;
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
     * @return void
     *
     * @throws \NotificationChannels\SemySMS\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification){
        if (! $to = $notifiable->routeNotificationFor('semy-sms')) {
            return;
        }

        $message = $notification->toSemySms($notifiable);

        $result = $this->client->request('POST', 'https://semysms.net/api/3/sms.php', [
          'form_params' => [
            'token' => config('services.semysms.token'),
            'device' => config('services.semysms.device'),
            'phone' => $to,
            'msg' => $message->text,
          ]
        ]);

        return json_decode($result->getBody());

        /*if (count($response->result->fails)) { // replace this by the code need to check for errors
          throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }*/
    }
}
