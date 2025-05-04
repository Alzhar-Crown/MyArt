<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyArt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/theme/dist/css/adminlte.min.css">
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

        .logo {
            display: flex;
            flex-direction: column;
            margin-left: 20%;
            margin-top: 10%;
        }

        .lp {
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
            text-align: center;
            color: black;
            align-items: center;
        }

        .cta a {
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
            background-color: rgba(121, 124, 98, 1);
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

        .pi img {
            width: 250px;
        }
    </style>
</head>

<body>
    <div class="base">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="MyArtLogo">
            <span>Let's grow together</span>
        </div>


        <div class="lp">

            <form class="act" action="{{ route('user.auth') }}" method="POST">
                @csrf
                <div class="l">
                    <label for="">Username</label>
                    <input type="text" placeholder="ex : Alzhar" name="username" value="{{ old('username') }}" required>
                    <label for="">Password</label>
                    <input type="password" placeholder="ex : Romawi23ikb" id="password" name="password"
                        value="{{ old('password') }}" required>
                    <button type="button" id="toggle-password" style="cursor: pointer;"><span
                            class="material-symbols-outlined" id="password-icon"> lock</span></button>

                    {{-- chechkbox bootstrap --}}

                    <a href="{{ route('user.create') }}">don't have an account yet?</a>


                    <div class="cta&bckn">
                        {{-- <div class="form-check" style="height:fit-content; ">
                            <input class="form-check-input" style="" type="checkbox" value=""
                                id="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Remember Me
                            </label>
                        </div> --}}
                        <div class="cta">
                            <span>Sure?</span>
                            <button type="submit">Login</button>

                        </div>

                    </div>


                    @if (session('error'))
                        <div class="alert alert-danger">
                            <li style="color:white;">{{ session('error') }}</li>
                        </div>
                    @endif



                </div>

            </form>


            <div class="p">
                <div class="pi">
                    <img src="{{ asset('images/ilustrasiion.png') }}" alt="MyArtLogo">

                </div>

            </div>

        </div>
    </div>
</body>
<script>
    document.getElementById('toggle-password').addEventListener('click', function() {
        var passwordField = document.getElementById('password');
        var passwordType = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = passwordType;

        // Optional: Change icon when toggling
        var icon = document.getElementById('password-icon');
        if (passwordType === 'password') {
            icon.innerHTML = 'lock'; // Ikon lock
        } else {
            icon.innerHTML = 'lock_open'; // Ikon lock_open
        }
    });
</script>


</html>
