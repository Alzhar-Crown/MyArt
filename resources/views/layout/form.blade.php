@csrf
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyArt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=lock,lock_open" />
    <link
        href="https://fonts.googleapis.com/css2?family=Alumni+Sans:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&display=swap"
        rel="stylesheet">
    <style>
        .base {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 70vh;
            margin: 0px;
            padding: 0px;
        }

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }




        #toggle-password {
            transform: translateY(-33px);
            margin-left: 250px;
            background: none;
            border: none;
            width: fit-content;
            font-size: 18px;
            border-radius: 50%;
            cursor: pointer;
            padding: 1px;
        }

        .logo {
            display: flex;
            flex-direction: column;
            margin-left: 20%;
            margin-top: 10%;
        }

        .act {
            display: flex;
            flex-direction: row;
            width: fit-content;
            margin-left: 22.7%;
            margin-top: 3%;
        }

        .logo img {
            width: 23%;
            filter: brightness(90%)
        }

        span {
            font-family: "Onest", sans-serif;
            font-optical-sizing: auto;
        }

        a {
            font-family: "Onest", sans-serif;
            font-optical-sizing: auto;
            text-decoration: none;
        }

        .l {
            display: flex;
            width: 400px;
            gap: 5px;
            flex-direction: column;
        }

        .l .act {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .l a {
            font-size: 12px;
            color: black;
        }

        .l label {
            font-family: "Onest", sans-serif;
            font-optical-sizing: auto;

        }

        .l input {
            overflow-x: scroll;
            width: 240px;
            text-align: center;
            font-family: "Onest", sans-serif;
            font-optical-sizing: auto;
            border-radius: 5px;
            background-color:transparent;
            height: 30px;
            border: none;
            outline: 1px solid rgba(86, 91, 41, 1);
            text-decoration: none;
        }
        

        .logo span {

            font-style: normal;
            font-weight: 500;
            margin-left: 12%;
            margin-top: -2.7%;
        }

        .cta {
            margin-top: 1%;
            width: 180px;
            height: fit-content;
            border: 1px solid black;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding-left: 3px;
            padding-right: 3px;
            border-radius: 10px;
            padding-bottom: 3px;
            padding-top: 3px;
            background-color:none;
            text-align: center;
            color: black;
            align-items: center;
        }

        .cta button {
            height: fit-content;
            border-radius: 6px;
            background-color: black;
            color: white;
            width: 60px;
            font-size: 15px;
            padding-top: 3px;
            padding-bottom: 3px;
            border: 1px solid black;
            text-align: center;

        }

        .cta span {
            font-size: smaller;
        }

        .p {
            display: flex;
            flex-direction: column;

        }

        .p img {
            width: 140px;
            margin-left: 200px;
            margin-top: -160px;
        }

        .pin {
            display: flex;
            flex-direction: row;
            gap: 3px;
            margin-left: 75%;
        }

        .box1 {
            background-color: rgba(86, 91, 41, 1);
            width: 15px;
            height: 15px;
            border-radius: 15px;

        }

        .box2 {
            width: 15px;
            height: 15px;
            border-radius: 15px;
        }

        .box3 {
            background-color: rgba(121, 124, 98, 1);
            width: 15px;
            height: 15px;
            border-radius: 15px;
        }
        .video-bg {
            position: fixed;
            top: 0;
            filter:brightness(120%);
            left: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
            /* filter: grayscale(100%); */

        }
        
            
        
    </style>
</head>

<body>
    <video autoplay muted loop class="video-bg">
        <source src="{{ asset('video/bgbg.mp4') }}" type="video/mp4">
        {{-- Your browser does not support HTML5 video. --}}
    </video>
    <div class="base">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="MyArtLogo">
            <span>Make a Contribute</span>
        </div>
        <div class="lp">

            @yield('form')

        </div>
    </div>
</body>

</html>
