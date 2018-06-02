<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset Begins */
        @font-face {
            font-family: Gotham;
            src: url('/fonts/Gotham-Medium.otf');
        }

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

        #workspace div {
            overflow: hidden;
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

       div.logo {
            width: 387px;
            height: 149px;
            position: absolute;
            top: 70.775px;
            left: 29px;
        }

        div.logo img {
            width: 387px;
            height: 149px;
        }

        div.logo div.placeholder {
            width: 387px;
            height: 149px;
            outline: 3px dotted #CC337A;
            outline-offset: -3px;
        }

        div.logo div.placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 65px;
        }

        div.title {
            width: 482px;
            height: 176px;
            position: absolute;
            top: 263.775px;
            left: 29px;
            font-size: 19px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }

        div#hero-text1 {
            width: 615.254px;
            height: 551.025px;
            background: #C6E5F3;
            position: absolute;
            top: 483.775px;
            left: 29px;
        }

        div.slideshow {
            width: 1199.024px;
            height: 561.439px;
            position: absolute;
            top: 70.775px;
            left: 673.254px;
        }
        div.slideshow img {
            width: 1199.024px;
            height: 561.439px;
        }
        div.slideshow div.slideshow-placeholder {
            width: 1199.024px;
            height: 561.439px;
            background: #C6E5F3;
        }

        div#hero-text2 {
            width: 1199.056px;
            height: 162px;
            background: #C6E5F3;
            position: absolute;
            top: 650px;
            left: 673.254px;
        }
        
        div#address-text {
            background: #C6E5F3;
            width: 372.395px;
            height: 41.253px;
            position: absolute;
            top: 827px;
            left: 673.254px;
        }

        div.map {
            width: 372.395px;
            height: 157.127px;
            position: absolute;
            top: 875.253px;
            left: 673.254px;
        }
        div.map img {
            width: 372.395px;
            height: 157.127px;
        }
        div.map div.placeholder {
            width: 372.395px;
            height: 157.127px;
            background: #C6E5F3;
        }
        div.audio {
            width: 188.839px;
            height: 202.139px;
            position: absolute;
            top: 827px;
            left: 1065.65px;
        }
        div.audio img {
            width: 188.839px;
            height: 202.139px;
        }
        div.audio div.audio-placeholder {
            width: 188.839px;
            height: 202.139px;
            background: #C6E5F3;
        }
        
        div.blog-logo {
            width: 42.402px;
            height: 42.316px;
            position: absolute;
            top: 827px;
            left: 1305.65px;

        }
        div.blog-logo svg {
            width: 42.402px;
            height: 42.316px;
            fill: #199FD4;
        }
        
        div.blog-qrs {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 885.253px;
            left: 1274.65px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        div.blog-qrs div.blog-qr {
            width: 114.5px;
            height: 110.796px;
            background: rgba(255,0,0,0.2);
        }

    </style>
    
</head>
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">    
    
    <div id="workspace">
        @include('templates.components.banner', ['value' => array_get($readableComponents, 'top-border-bar') ])

        <div class="body">
            <div class="logo">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'logo'), 'default' => 'logo'])
            </div>
             <div class="title">
                <h1>@include('templates.components.text', ['value' => array_get($readableComponents, 'landing-page-title'), 'default' => 'Landing Page Title'])</h1>
            </div>
            
            <div id="hero-text1" style="background-color: {{ ! empty(array_get($readableComponents, 'text-1')['_value']) ? 'transparent' : '' }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text-1'), 'default' => 'Text 1'])</p>
            </div>
            <div class="slideshow">
                @include('templates.components.slideshow', ['value' => array_get($readableComponents, 'slideshow'), 'default' => 'slideshow'])
            </div>
            <div id="hero-text2" style="background-color: {{ ! empty(array_get($readableComponents, 'text-2')['_value']) ? 'transparent' : '' }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text-2'), 'default' => 'Text 2'])</p>
            </div>
            <div id="address-text" style="background-color: {{ ! empty(array_get($readableComponents, 'map-title')['_value']) ? 'transparent' : '' }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'map-title'), 'default' => 'Map Title'])</p>
            </div>
            <div class="map">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'map'), 'default' => 'map'])
            </div>
            <div class="audio">
                @include('templates.components.audio', ['value' => array_get($readableComponents, 'audio'), 'default' => 'audio'])
            </div> 
            <div class="blog-logo">
                <svg xmlns="http://www.w3.org/2000/svg" style="fill: {{ array_get($readableComponents, 'top-border-bar._value') }}" aria-labelledby="simpleicons-blogger-icon" role="img" viewBox="0 0 24 24"><title id="simpleicons-blogger-icon">Blogger icon</title><path d="M21.976 24H2.026C.9 24 0 23.1 0 21.976V2.026C0 .9.9 0 2.025 0H22.05C23.1 0 24 .9 24 2.025v19.95C24 23.1 23.1 24 21.976 24zM12 3.975H9c-2.775 0-5.025 2.25-5.025 5.025v6c0 2.774 2.25 5.024 5.025 5.024h6c2.774 0 5.024-2.25 5.024-5.024v-3.975c0-.6-.45-1.05-1.05-1.05H18c-.524 0-.976-.45-.976-.976 0-2.776-2.25-5.026-5.024-5.026zm3.074 12H9c-.525 0-.975-.45-.975-.975s.45-.976.975-.976h6.074c.526 0 .977.45.977.976s-.45.976-.975.976zm-2.55-7.95c.527 0 .976.45.976.975s-.45.975-.975.975h-3.6c-.525 0-.976-.45-.976-.975s.45-.975.975-.975h3.6z"/></svg>
            </div>
             <div class="blog-qrs">
                @include('templates.components.qr', ['value' => array_get($readableComponents, 'blog-feed-url'), 'default' => 'blog-qr', 'size' => 115])
            </div>
    </div>
</body>
</html>