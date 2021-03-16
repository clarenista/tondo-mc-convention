<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOTH RESPONSIVE</title>
    <style>
        @media screen and (orientation:portrait) {
            .booth-container {
                height: 100vw;
            }

            .centered {
                width: 250%;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        }

        @media screen and (orientation:landscape) {
            .booth-container {
                height: 100vh;
            }

            .centered {
                height: 250%;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
        }
    </style>
</head>

<body class="antialiased">
    <div class="booth-container">
        <img class="centered" src="/images/vwh.png">
    </div>
</body>

</html>
