<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset Begins */
        html, body, ul, ol, li, form, fieldset, legend
        {
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, h4, h5, h6, p { margin-top: 0; }

        fieldset,img { border: 0; }

        legend { color: #000; }

        li { list-style: none; }

        sup { vertical-align: text-top; }

        sub { vertical-align: text-bottom; }

        table
        {
            border-collapse: collapse;
            border-spacing: 0;
        }

        caption, th, td
        {
            text-align: left;
            vertical-align: top;
            font-weight: normal;
        }

        input, textarea, select
        {
            font-size: 110%;
            line-height: 1.1;
        }

        abbr, acronym
        {
            border-bottom: .1em dotted;
            cursor: help;
        }
        /* Reset Ends */

        html {
            box-sizing: border-box;
        }
        *, *:before, *:after {
            box-sizing: inherit;
        }

        body {
            overflow: hidden;
            zoom: 50%;
        }
        body.two-x {
            zoom: 100%;
        }
        
        #workspace {
            background: #ccc;
            width: 1920px;
            height: 1080px;
            font-family: Gotham;

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-01.jpg);*/
            /*background-size: 1920px 1080px;*/
        }

        div.banner {
            width: 1920px;
            height: 26.775px;
            background: #199FD4;
        }

        div.body {
            width: 1920px;
            height: 1080px;
            background: #fff;

            position: relative;
            overflow: auto;
        }

        div.hero-image1 {
            width: 658.308px;
            height: 319.18px;
            position: absolute;
            top: 37px;
            left: 29px;
        }
        div.hero-image1 img {
            width: 658.308px;
            height: 319.18px;
        }
        div.hero-image1 div.hero-image1-placeholder {
            width: 658.308px;
            height: 319.18px;
            background: #C6E5F3;
        }  

        div.hero-image2 {
            width: 658.308px;
            height: 319.18px;
            position: absolute;
            top: 380.955px;
            left: 29px;
        }
        div.hero-image2 img {
            width: 658.308px;
            height: 319.18px;
        }
        div.hero-image2 div.hero-image2-placeholder {
            width: 658.308px;
            height: 319.18px;
            background: #C6E5F3;
        }  

        div.hero-image3 {
            width: 658.308px;
            height: 319.18px;
            position: absolute;
            top: 730.775px;
            left: 29px;
        }
        div.hero-image3 img {
            width: 658.308px;
            height: 319.18px;
        }
        div.hero-image3 div.hero-image3-placeholder {
            width: 658.308px;
            height: 319.18px;
            background: #C6E5F3;
        }

        div.logo {
            width: 414px;
            height: 207px;
            position: absolute;
            top: 320px;
            left: 720px;
        }

        div.logo img {
            width: 414px;
            height: 207px;
        }

        div.logo div.placeholder {
            width: 414px;
            height: 207px;
            outline: 3px dotted #CC337A;
        }

        div.logo div.placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 15px;
        }

        div.title {
            width: 1017px;
            height: 76px;
            position: absolute;
            top: 590px;
            left: 720px;
            font-size: 19px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }

        div#hero-text {
            width: 1147.858px;
            height: 315.815px;
            background: #C6E5F3;
            position: absolute;
            top: 730px;
            left: 720px;
        }

        div.social-qrs-1 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1420px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-2 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1540px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-3 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1660px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        div.social-qrs-1 div.social-qr {
           width: 114.5px;
            height: 110.796px;
            background: rgba(255,0,0,0.2);
        }  
        div.social-qrs-2 div.social-qr {
           width: 114.5px;
            height: 110.796px;
            background: rgba(255,0,0,0.2);
        }  

        div.social-qrs-3 div.social-qr {
            width: 114.5px;
            height: 110.796px;
            background: rgba(255,0,0,0.2);
        }


           div.social-logo-image1 {
            width: 63.361px;
            height: 43.552px;
            position: absolute;
            top: 46px;
            left: 1440px;
        }
        div.social-logo-image1 img {
            width: 63.361px;
            height: 43.552px;
        }
        div.social-logo-image1 div.social-logo-image1-placeholder {
            width: 63.361px;
            height: 43.552px;
            background: #C6E5F3;
        }

        div.social-logo-image2 {
            width: 63.361px;
            height: 43.552px;
            position: absolute;
            top: 46px;
            left: 1570px;
        }
        div.social-logo-image2 img {
            width: 63.361px;
            height: 43.552px;
        }
        div.social-logo-image2 div.social-logo-image2-placeholder {
            width: 63.361px;
            height: 43.552px;
            background: #C6E5F3;
        }

        div.social-logo-image3 {
            width: 63.361px;
            height: 43.552px;
            position: absolute;
            top: 46px;
            left: 1680px;
        }
        div.social-logo-image3 img {
            width: 63.361px;
            height: 43.552px;
        }
        div.social-logo-image3 div.social-logo-image3-placeholder {
            width: 63.361px;
            height: 43.552px;
            background: #C6E5F3;
        }

    </style>
    
</head>
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">    
    
    <div id="workspace">
        @include('templates.components.banner', ['value' => array_get($readableComponents, 'theme') ])

        <div class="body">
            <div class="hero-image1">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image-1'), 'default' => 'hero-image1'])
            </div>
            <div class="hero-image2">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image-2'), 'default' => 'hero-image2'])
            </div>            
            <div class="hero-image3">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image-3'), 'default' => 'hero-image3'])
            </div>

            <div class="logo">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'logo'), 'default' => 'logo'])
            </div>
             <div class="title">
                <h1>@include('templates.components.text', ['value' => array_get($readableComponents, 'landing-page-title'), 'default' => 'Landing Page Title'])</h1>
            </div>
            
            <div id="hero-text">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text'), 'default' => 'Text'])</p>
            </div>

            <div class="social-logo-image1">
                <div class="social-logo-image1-placeholder">
                    Tw
                </div>
            </div><div class="social-logo-image2">
                <div class="social-logo-image2-placeholder">
                    In
                </div>
            </div><div class="social-logo-image3">
                <div class="social-logo-image3-placeholder">
                    Fb
                </div>
            </div>

            <div class="social-qrs-1">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'twitter-url'), 'default' => 'social-qr'])
            </div>

            <div class="social-qrs-2">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'instagram-url'), 'default' => 'social-qr'])
            </div>

            <div class="social-qrs-3">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'facebook-url'), 'default' => 'social-qr'])
            </div>
    </div>
</body>
</html>