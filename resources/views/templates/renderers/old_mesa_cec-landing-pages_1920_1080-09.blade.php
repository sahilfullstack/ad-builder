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
        }
        body.two-x {
            zoom: 200%;
        }
        #workspace {
            background: #ccc;
            width: 960px;
            height: 540px;
            font-family: Gotham;

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-09.jpg);
            background-size: 960px 540px;*/
        }

        div.banner {
            width: 960px;
            height: 10px;
            background: #199FD4;
        }

        div.body {
            width: 960px;
            height: 540px;
            background: #fff;

            position: relative;
            overflow: auto;
        }

        div.logo {
            width: 206px;
            height: 74px;
            position: absolute;
            top: 38px;
            left: 374px;
        }

        div.logo img {
            width: 206px;
            height: 74px;
        }

        div.logo div.logo-placeholder {
            width: 206px;
            height: 74px;
            outline: 3px dotted #CC337A;
        }

        div.logo div.logo-placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 25px;
        }

        div.title {
            width: 528px;
            height: 68px;
            position: absolute;
            top: 95px;
            left: 205px;
            font-size: 29px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }
    
        div.social-qrs-text {
            width: 159px;
            height: 36px;
            position: absolute;
            top: 22px;
            left: 781px;
            text-transform: uppercase;
            font-weight: bold;
        }
        div.social-qrs {
            width: 159px;
            height: 55px;
            background: #C6E5F3;
            position: absolute;
            top: 60px;
            left: 781px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        div.social-qrs div.social-qr {
            width: 50px;
            height: 50px;
            background: rgba(255,0,0,0.2);
        }

        div#image-1 {
            width: 285px;
            height: 208px;
            position: absolute;
            top: 205px;
            left: 33px;
        }
        div#image-1 img {
            width: 285px;
            height: 208px;
        }
        div#image-1 div#image-1-placeholder {
            width: 285px;
            height: 208px;
            background: #C6E5F3;
        }

        div#image-2 {
            width: 285px;
            height: 208px;
            position: absolute;
            top: 205px;
            left: 337px;
        }
        div#image-2 img {
            width: 285px;
            height: 208px;
        }
        div#image-2 div#image-2-placeholder {
            width: 285px;
            height: 208px;
            background: #C6E5F3;
        }

        div#text-1 {
            width: 285px;
            height: 82px;
            background: #C6E5F3;
            position: absolute;
            top: 431px;
            left: 33px;
        }

        div#text-2 {
            width: 285px;
            height: 82px;
            background: #C6E5F3;
            position: absolute;
            top: 431px;
            left: 337px;
        }
        div#text-3 {
            width: 285px;
            height: 82px;
            background: #C6E5F3;
            position: absolute;
            top: 431px;
            left: 642px;
        }

        div#image-3 {
            width: 285px;
            height: 208px;
            background: #C6E5F3;
            position: absolute;
            top: 205px;
            left: 642px;
        }
        div#image-3 img {
            width: 285px;
            height: 208px;
        }
        div#image-3 div#image-3-placeholder {
            width: 285px;
            height: 208px;
            background: #C6E5F3;
        }
    </style>
    
</head>
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">    
    
    <div id="workspace">
        @include('templates.components.banner', ['value' => array_get($readableComponents, 'theme') ])

        <div class="body">
            <div class="logo">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'logo'), 'default' => 'logo'])
            </div>
            <div class="title">
                <h1>@include('templates.components.text', ['value' => array_get($readableComponents, 'landing-page-title'), 'default' => 'Landing Page Title'])</h1>
            </div>

            <div class="social-qrs-text">
                <p>SOCIAL MEDIA QR CODES</p>
            </div>
            <div class="social-qrs">
                <div class="social-qr">
                    
                </div>
                <div class="social-qr">
                    
                </div>
                <div class="social-qr">
                    
                </div>
            </div>

            <div id="image-1">
                <div id="image-1-placeholder">
                    Image 1
                </div>
            </div>

            <div id="image-2">
                <div id="image-2-placeholder">
                    Image 2
                </div>
            </div>

            <div id="image-3">
                <div id="image-3-placeholder">
                    Image 3
                </div>
            </div>

            <div id="text-1">
                <p>Text 1</p>
            </div>
            <div id="text-2">
                <p>Text 2</p>
            </div>
            <div id="text-3">
                <p>Text 3</p>
            </div>

        </div>
    </div>
</body>
</html>