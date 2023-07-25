<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body style="margin:0; padding:0; direction: rtl;">
        <div class="email" style="height:70px; background-color: #fff; padding:5px 20px">
            <div class="email-logo" style="float:right">
                <img style="width:70px; height:70px; object-fit: contain;" src="https://shaheenplus.com/public/assets/logo.png" alt="https://shaheenplus.com/public/assets/logo.png" >
            </div>
            <div class="email-caption" style="float:left">
                <h1 style="color:##000;line-height:2.5">{{ $data['project_name'] }}</h1>
            </div>
        </div>
        <div class="name" style="background-color: #b5b5b5; display: block; text-align: center; clear: both;font-size: 15px;">
            <h2 style="display:inline-block;margin: 5px;">{{ $data['welcome_msg'] }} : </h2> <span>{{ $data['user_name'] }}</span>
        </div>
        <div class="email-content" style="padding: 0;">
            <div style="padding-right: 30px;">{!! $data['reply'] !!}</div>
        </div>
        <div class="email-footer" style="background-color: #efefef; color:#000; padding:5px; height:30px; text-align: center;">
            <a href="{{ $data['project_link'] }}" style="color:#000;text-decoration: none;font-size:20px;">{{ $data['project_name'] }}</a>
        </div>
    </body>
</html>
