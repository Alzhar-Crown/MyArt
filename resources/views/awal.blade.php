<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:ital,wght@0,100..900;1,100..900&family=Akatab:wght@400;500;600;700;800;900&family=Alumni+Sans:ital@0;1&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Bruno+Ace+SC&family=Bungee&family=Mate+SC&family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Radio+Canada:ital,wght@0,300..700;1,300..700&family=Rubik+Broken+Fax&family=Rubik+Doodle+Shadow&family=Zen+Dots&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:ital,wght@0,100..900;1,100..900&family=Akatab:wght@400;500;600;700;800;900&family=Alumni+Sans:ital,wght@0,100..900;1,100..900&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Bruno+Ace+SC&family=Bungee&family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Radio+Canada:ital,wght@0,300..700;1,300..700&family=Rubik+Broken+Fax&family=Rubik+Doodle+Shadow&family=Zen+Dots&display=swap" rel="stylesheet">
    <style>
        .heading span {
            font-family: "Rubik Doodle Shadow", system-ui;
            font-weight: 400;
            font-size: 100px;
            font-style: normal;
        }

        .heading {
            display: flex;
            flex-direction: column;
            text-align: right;
            gap: 0px;
        }

        .base {
            width: 100%;
            height: 90vh;
            overflow:hidden;
            background-color: white;
            align-items: center;
            display: flex;
            justify-content: center;
            flex-direction: row;
        }

        .kiri {
            display: flex;
            gap: 3%;
            flex-direction: column;
        }
        .ead{
            display: flex;
            flex-direction: row;
            gap: 3%;
            width: 105%;


        }

        .sub-heading span {
            font-family: "Mate SC", serif;
            font-weight: 400;
            font-size: 28px;
            font-style: normal;
        }

        .sub-heading {
            justify-content: center;
            display: flex;
            flex-direction: column;
        }

        .art {
            margin-top: -17%;
        }

        .pby {
            width: 100%;
        }

        .kanan {
            margin-left: 9%;
            margin-top: 6%;
        }

        .kanan img {
            width: 360px;
        }
        .cta{
            align-items: center;

            margin-left: 23%;
            width: 50%;
            height: 40%;
            border: 1px solid black;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding-left: 4%;
            padding-right: 4%;
            border-radius: 13px;
            padding-top: 1%;
            padding-bottom: 1%;
        }
        .cta a {
            background-color: black;
            border-radius:8px;
            text-decoration: none;
            padding-top: 3%;
            padding-bottom: 3%;
            padding-left: 5%;
            font-family: "Mate SC", serif;
            font-weight: 400;   
            color: white;
            padding-right : 5%;
            text-align: center;
            
        }
        .cta span{
            font-family: "Mate SC", serif;
            font-weight: 400;   
            font-size: medium;
        }
    </style>
</head>

<body>
    <div class="base">
        <div class="kiri">
            <div class="ead">
                <div class="heading">
                    <span>MY</span>
                    <span class="art">ART</span>
                </div>
                <div class="sub-heading">
                    <span class="pby">Publish Your</span>
                    <span>Optimal <br> Design</span>
                </div>
            </div>
            <div class="cta">
                <span>Get Start</span>
                <a href="{{ route('user.login') }}">Sign In</a>
            </div>

        </div>
        <div class="kanan">
            <img src="{{ asset('images/ilustrasiion.png') }}" alt="">
        </div>
    </div>
</body>

</html>