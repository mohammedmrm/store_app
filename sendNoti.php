<?php
 require_once __DIR__.'/vendor/autoload.php';
 try{
  $channelName = 'alnahr_user_2';
  $recipient= 'ExponentPushToken[SR-HjmEYkgpYGEAiHscaUo]';

  // You can quickly bootup an expo instance
  $expo = \ExponentPhpSDK\Expo::normalSetup();

  // Subscribe the recipient to the server
  $expo->subscribe($channelName, $recipient);

  // Build the notification data
  $notification = [
   'body'   => 'Hello World!',
   'title'  =>"Title",
   "sound"=>'default',
   '_displayInForeground'=>true,
   'subtitle'=> '123456',
   'vibrate'=> [300,100,400,100,400,100,400],
   'vibrationPattern'=> [300,100,400,100,400,100,400],
   'data'=>["message" => '',"moredata" =>'']
  ];
  // Notify an interest with a notification
  print_r($expo->notify([$channelName], $notification));
  }catch (Exception $e) {
          var_dump($e);
  }
 ?>