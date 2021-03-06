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

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-02.jpg);
            background-size: 1920px 1080px;*/
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

        div.logo div.placeholder {
            width: 412px;
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

         div#qr-title-1 {
            width: 114.5px;
            height: 50.734px;
            position: absolute;
            top: 800px;
            left: 1560px;
            text-align: center;
        }
         div#qr-title-2 {
            width: 114.5px;
            height: 50.734px;
            position: absolute;
            top: 800px;
            left: 1680px;
            text-align: center;
        }

         div#qr-title-3 {
            width: 114.5px;
            height: 50.734px;
            position: absolute;
            top: 800px;
            left: 1800px;
            text-align: center;
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
        div.image-1 div.placeholder {
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
        div.image-2 div.placeholder {
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
            object-fit: fill;
        }
        div.video div.placeholder {
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
        @include('templates.components.banner', ['value' => array_get($readableComponents, 'top-border-bar') ])

        <div class="body">
            <div class="logo">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'logo'), 'default' => 'logo'])
            </div>
             <div class="title" style="background-color: {{ empty(array_get($readableComponents, 'landing-page-title')['background_color']) ? 'transparent' : array_get($readableComponents, 'landing-page-title')['background_color'] }};">
                <h1>@include('templates.components.text', ['value' => array_get($readableComponents, 'landing-page-title'), 'default' => 'Landing Page Title'])</h1>
            </div>

            @if(! is_null(array_get($readableComponents, 'qr-code-title-1._value')))
            <div id="qr-title-1" style="background-color: {{ empty(array_get($readableComponents, 'qr-code-title-1')['background_color']) ? 'transparent' : array_get($readableComponents, 'qr-code-title-1')['background_color'] }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'qr-code-title-1'), 'default' => 'QR Title 1'])</p>
            </div>
            @endif
            
            @if(! is_null(array_get($readableComponents, 'qr-code-value-1._value')))            
            <div class="social-qrs-1" style="background-color: {{ empty(array_get($readableComponents, 'qr-code-value-1')) ?: 'transparent' }}">
                @include('templates.components.qr', ['value' => array_get($readableComponents, 'qr-code-value-1'), 'default' => 'QR Value 1'])
            </div>
            @endif

            @if(! is_null(array_get($readableComponents, 'qr-code-title-2._value')))
            <div id="qr-title-2" style="background-color: {{ empty(array_get($readableComponents, 'qr-code-title-2')['background_color']) ? 'transparent' : array_get($readableComponents, 'qr-code-title-2')['background_color'] }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'qr-code-title-2'), 'default' => 'QR Title 2'])</p>
            </div>
            @endif
            
            @if(! is_null(array_get($readableComponents, 'qr-code-value-2._value')))            
            <div class="social-qrs-2" style="background-color: {{ empty(array_get($readableComponents, 'qr-code-value-2')) ?: 'transparent' }}">
                @include('templates.components.qr', ['value' => array_get($readableComponents, 'qr-code-value-2'), 'default' => 'QR Value 2'])
            </div>
            @endif
            
            @if(! is_null(array_get($readableComponents, 'qr-code-title-3._value')))
            <div id="qr-title-3" style="background-color: {{ empty(array_get($readableComponents, 'qr-code-title-3')['background_color']) ? 'transparent' : array_get($readableComponents, 'qr-code-title-3')['background_color'] }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'qr-code-title-3'), 'default' => 'QR Title 3'])</p>
            </div>
            @endif
            
            @if(! is_null(array_get($readableComponents, 'qr-code-value-3._value')))
            <div class="social-qrs-3" style="background-color: {{ empty(array_get($readableComponents, 'qr-code-value-3')) ?: 'transparent' }}">
                @include('templates.components.qr', ['value' => array_get($readableComponents, 'qr-code-value-3'), 'default' => 'QR Value 3'])
            </div>
            @endif
            
            <div class="image-1">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image-1'), 'default' => 'image 1'])
            </div>

            <div id="hero-text" style="
                background-color: {{ empty(array_get($readableComponents, 'text')['background_color']) ? 'transparent' : array_get($readableComponents, 'text')['background_color'] }};
                display: flex;
                align-items: {{ align_to_flex_rule(array_get($readableComponents, 'text.valign')) }};
                justify-content: {{ align_to_flex_rule(array_get($readableComponents, 'text.halign')) }};
                text-align: {{ array_get($readableComponents, 'text.halign') }};
            ">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text'), 'default' => 'Text'])</p>
            </div>

            <div class="video">
                @include('templates.components.video', ['value' => array_get($readableComponents, 'video'), 'default' => 'video'])
            </div>

            <div class="image-2">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image-2'), 'default' => 'image 2'])
            </div>

            <div class="photogallery" style="background-color: {{ empty(array_get($readableComponents, 'photo-gallery')['background_color']) ? 'transparent' : array_get($readableComponents, 'photo-gallery')['background_color'] }};">
                @include('templates.components.photogallery', ['value' => array_get($readableComponents, 'photo-gallery')['_value'], 'default' => 'photogallery'])
            </div>
         </div>
    </div>
</body>
</html>