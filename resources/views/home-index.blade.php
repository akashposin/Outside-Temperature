<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Outside Temperature</title>
    </head>
    <body>

        @if(isset($error))
        {{$error}}
        @endif

        @if(isset($weather_data))

            <h4>Location : {{$weather_data->location->name}}, {{$weather_data->location->region}} </h4>

            <b>Temperature:</b> {{$weather_data->current->temp_c}} °

        @endif

    </body>
</html>
