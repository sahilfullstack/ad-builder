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
            font-family: sans-serif;

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-02.jpg);
            background-size: 1920px 1080px;*/
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
            width: 414px;
            height: 207px;
            position: absolute;
            top: 68px;
            left: 32px;
        }

        div.logo img {
            width: 414px;
            height: 207px;
        }

        div.logo div.logo-placeholder {
            width: 414px;
            height: 207px;
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
            width: 1014px;
            height: 66px;
            position: absolute;
            top: 68px;
            left: 490px;
            font-size: 19px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }
    
        div.social-qrs-1 {
            width: 91.494px;
            height: 88.534px;
            background: #C6E5F3;
            position: absolute;
            top: 80px;
            left: 1520px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-2 {
            width: 91.494px;
            height: 88.534px;
            background: #C6E5F3;
            position: absolute;
            top: 80px;
            left: 1640px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-3 {
            width: 91.494px;
            height: 88.534px;
            background: #C6E5F3;
            position: absolute;
            top: 80px;
            left: 1760px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        div.social-qrs1 div.social-qr {
            width: 91.494px;
            height: 88.534px;
            background: rgba(255,0,0,0.2);
        }  

        div.social-qrs2 div.social-qr {
            width: 91.494px;
            height: 88.534px;
            background: rgba(255,0,0,0.2);
        }

        div.social-qrs3 div.social-qr {
            width: 91.494px;
            height: 88.534px;
            background: rgba(255,0,0,0.2);
        }

        div.social-logo-image1 {
            width: 50.63px;
            height: 34.94px;
            position: absolute;
            top: 26px;
            left: 1540px;
        }
        div.social-logo-image1 img {
            width: 50.63px;
            height: 34.94px;
        }
        div.social-logo-image1 div.social-logo-image1-placeholder {
            width: 50.63px;
            height: 34.94px;
            background: #C6E5F3;
        }

        div.social-logo-image2 {
            width: 50.53px;
            height: 34.94px;
            position: absolute;
            top: 26px;
            left: 1670px;
        }
        div.social-logo-image2 img {
            width: 50.53px;
            height: 34.94px;
        }
        div.social-logo-image2 div.social-logo-image2-placeholder {
            width: 50.53px;
            height: 34.94px;
            background: #C6E5F3;
        }

        div.social-logo-image3 {
            width: 50.53px;
            height: 34.94px;
            position: absolute;
            top: 26px;
            left: 1780px;
        }
        div.social-logo-image3 img {
            width: 50.53px;
            height: 34.94px;
        }
        div.social-logo-image3 div.social-logo-image3-placeholder {
            width: 50.53px;
            height: 34.94px;
            background: #C6E5F3;
        }

        div.image-1 {
            width: 420px;
            height: 183px;
            position: absolute;
            top: 470px;
            left: 151px;
        }
        div.image-1 img {
            width: 420px;
            height: 183px;
        }
        div.image-1 div.image-1-placeholder {
            width: 420px;
            height: 183px;
            background: #C6E5F3;
        }
        div#text-1 {
            width: 419.601px;
            height: 350.585px;
            background: #C6E5F3;
            position: absolute;
            top: 675px;
            left: 151px;
        }

        div.heading-1 {
            width: 120.691px;
            height: 120.691px;
            position: absolute;
            top: 330px;
            left: 291px;
            background: #C6E5F3;
        }

        div.heading-2 {
            width: 120.691px;
            height: 120.691px;
            position: absolute;
            top: 330px;
            left: 732px;
            background: #C6E5F3;
        }

        div.image-2 {
            width: 420px;
            height: 183px;
            position: absolute;
            top: 470px;
            left: 602px;
        }

        div.image-2 img {
            width: 420px;
            height: 183px;
        }

        div.image-2 div.image-2-placeholder {
            width: 420px;
            height: 183px;
            background: #C6E5F3;
        }

        div#text-2 {
            width: 419.601px;
            height: 350.585px;
            background: #C6E5F3;
            position: absolute;
            top: 675px;
            left: 602px;
        }

        div.slideshow {
            width: 832.26px;
            height: 794.202px;
            background: #C6E5F3;
            position: absolute;
            top: 230px;
            left: 1050px;
        }
        div.slideshow img {
            width: 832.26px;
            height: 794.202px;
        }
        div.slideshow div.slideshow-placeholder {
            width: 832.26px;
            height: 794.202px;
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
            
            <div class="heading-1">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'heading-1'), 'default' => 'Heading 1'])</p>
            </div>

            <div class="image-1">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image-1'), 'default' => 'image-1'])
            </div>

            <div id="text-1">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text-1'), 'default' => 'text-1'])</p>
            </div>

            <!-- Amount 1 is pending. -->

            <div class="heading-2">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'heading-2'), 'default' => 'Heading 2'])</p>
            </div>

            <div class="image-2">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image-2'), 'default' => 'image-2'])
            </div>

            <div id="text-2">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text-2'), 'default' => 'text-2'])</p>
            </div>

            <div class="slideshow">
                @include('templates.components.images', ['value' => array_get($readableComponents, 'slideshow'), 'default' => 'slideshow'])
            </div>

            <!-- Amount 2 is pending. -->
         </div>
    </div>
</body>
</html>