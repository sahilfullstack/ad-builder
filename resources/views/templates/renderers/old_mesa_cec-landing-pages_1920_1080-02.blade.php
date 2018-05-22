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
            font-family: sans-serif;

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-02.jpg);
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
            width: 192px;
            height: 47px;
            position: absolute;
            top: 22px;
            left: 22px;
        }

        div.logo img {
            width: 192px;
            height: 47px;
        }

        div.logo div.logo-placeholder {
            width: 192px;
            height: 47px;
            outline: 3px dotted #CC337A;
        }

        div.logo div.logo-placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 15px;
        }

        div.title {
            width: 690px;
            height: 68px;
            position: absolute;
            top: 62px;
            left: 13px;
            font-size: 19px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }
    
        div.social-qrs-text {
            width: 159px;
            height: 36px;
            position: absolute;
            top: 20px;
            left: 781px;
            text-transform: uppercase;
            font-weight: bold;
        }
        div.social-qrs {
            width: 159px;
            height: 55px;
            background: #C6E5F3;
            position: absolute;
            top: 56px;
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

        div.hero-image {
            width: 603px;
            height: 246px;
            position: absolute;
            top: 131px;
            left: 21px;
        }
        div.hero-image img {
            width: 603px;
            height: 246px;
        }
        div.hero-image div.placeholder {
            width: 603px;
            height: 246px;
            background: #C6E5F3;
        }

        div.hero-video {
            width: 308px;
            height: 246px;
            position: absolute;
            top: 131px;
            left: 638px;
        }
        div.hero-video img {
            width: 308px;
            height: 246px;
        }
        div.hero-video div.placeholder {
            width: 308px;
            height: 246px;
            background: #C6E5F3;
        }

        div#text-1 {
            width: 465px;
            height: 134px;
            background: #C6E5F3;
            position: absolute;
            top: 437px;
            left: 842px;
        }

        div.hero-video {
            width: 638.318px;
            height: 332.065px;
            position: absolute;
            top: 437px;
            left: 1264.146px;
        }
        div.hero-video video {
            width: 638.318px;
            height: 332.065px;
        }
        div.hero-video div.placeholder {
            width: 638.318px;
            height: 332.065px;
            background: #C6E5F3;
>>>>>>> f872b4898a2b2a2276913302ec4d51384e427c9a:resources/views/templates/renderers/sahil_mesa_cec-landing-pages_1920_1080-02.blade.php
        }

        div.timeline {
            width: 443px;
            height: 134px;
            background: #C6E5F3;
            position: absolute;
            top: 385px;
            left: 503px;
        }
        div.timeline img {
            width: 443px;
            height: 134px;
        }
        div.timeline div.timeline-placeholder {
            width: 443px;
            height: 134px;
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

            <div class="hero-image">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image'), 'default' => 'image'])
            </div>

            <div class="hero-video">
                @include('templates.components.video', ['value' => array_get($readableComponents, 'hero-video'), 'default' => 'hero-video'])
            </div>

            <div id="text-1">
                <p>Text 1</p>
            </div>

            <div class="timeline">
                <div class="timeline-placeholder">
                    Timeline
                </div>
            </div>
        </div>
    </div>
</body>
</html>