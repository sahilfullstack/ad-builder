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
            width: 412px;
            height: 149px;
            position: absolute;
            top: 60px;
            left: 30px;
        }

        div.logo img {
            width: 412px;
            height: 149px;
        }

        div.logo div.logo-placeholder {
            width: 412px;
            height: 149px;
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
            width: 1387px;
            height: 77px;
            position: absolute;
            top: 130px;
            left: 472px;
            font-size: 19px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }
    
        div.social-qrs-1 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 846px;
            left: 1560px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-2 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 846px;
            left: 1680px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-3 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 846px;
            left: 1800px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        div.social-qrs1 div.social-qr {
            width: 114.5px;
            height: 110.796px;
            background: rgba(255,0,0,0.2);
        }  

        div.social-qrs2 div.social-qr {
            width: 114.5px;
            height: 110.796px;
            background: rgba(255,0,0,0.2);
        }  

        div.social-qrs3 div.social-qr {
            width: 114.5px;
            height: 110.796px;
            background: rgba(255,0,0,0.2);
        }

        div.image-1 {
            width: 769.062px;
            height: 493.332px;
            position: absolute;
            top: 260px;
            left: 30px;
        }
        div.image-1 img {
            width: 769.062px;
            height: 493.332px;
        }
        div.image-1 div.image-1-placeholder {
            width: 769.062px;
            height: 493.332px;
            background: #C6E5F3;
        }

        div.image-2 {
            width: 526.542px;
            height: 268.734px;
            position: absolute;
            top: 783px;
            left: 830px;
        }
        div.image-2 img {
            width: 526.542px;
            height: 268.734px;
        }
        div.image-2 div.image-2-placeholder {
            width: 526.542px;
            height: 268.734px;
            background: #C6E5F3;
        }

        div#hero-text {
            width: 769.062px;
            height: 268.734px;
            background: #C6E5F3;
            position: absolute;
            top: 783px;
            left: 30px;
        }

        div.video {
            width: 684.684px;
            height: 493.074px;
            position: absolute;
            top: 260px;
            left: 1230.146px;
        }
        div.video video {
            width: 684.684px;
            height: 493.074px;
        }
        div.video div.video-placeholder {
            width: 684.684px;
            height: 493.074px;
            background: #C6E5F3;
        }

        div.photogallery {
            width: 369.747px;
            height: 493.659px;
            background: #C6E5F3;
            position: absolute;
            top: 260px;
            left: 830px;
            padding: 20px;
        }
        div.photogallery img {
            width: 142.8735px;
            height: 123.55px;
            text-align: center;
        }
        div.photogallery div.photogallery-placeholder {
            width: 142.8735px;
            height: 123.55px;
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

            <!-- QR Code Title 1 pending. -->
            
            <div class="social-qrs-1">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'qr-code-value-1'), 'default' => 'social-qr'])
            </div>

            <!-- QR Code Title 2 pending. -->
            
            <div class="social-qrs-2">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'qr-code-value-2'), 'default' => 'social-qr'])
            </div>

            <!-- QR Code Title 3 pending. -->

            <div class="social-qrs-3">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'qr-code-value-2'), 'default' => 'social-qr'])
            </div>

            <div class="image-1">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image-1'), 'default' => 'image-1'])
            </div>

            <div id="hero-text">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text'), 'default' => 'Text'])</p>
            </div>

            <div class="video">
                @include('templates.components.video', ['value' => array_get($readableComponents, 'video'), 'default' => 'video'])
            </div>

            <div class="image-2">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image-2'), 'default' => 'image-2'])
            </div>

            <div class="photogallery">
                @include('templates.components.photogallery', ['value' => array_get($readableComponents, 'photo-gallery'), 'default' => 'photogallery'])
            </div>
         </div>
    </div>
</body>
</html>