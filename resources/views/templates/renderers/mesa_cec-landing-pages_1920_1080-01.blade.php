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
            top: 68px;
            left: 35px;
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
            padding-top: 70px;
        }

        div.title {
            width: 1394px;
            height: 70px;
            position: absolute;
            top: 145px;
            left: 491px;
            font-size: 27px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }

        div.hero-image {
            width: 769.227px;
            height: 765.582px;
            position: absolute;
            top: 275px;
            left: 35px;
        }
        div.hero-image img {
            width: 769.227px;
            height: 765.582px;
        }
        div.hero-image div.placeholder {
            width: 769.227px;
            height: 765.582px;
            background: #C6E5F3;
        }

        div#text-1 {
            width: 1063.201px;
            height: 268.782px;
            background: #C6E5F3;
            position: absolute;
            top: 275px;
            left: 821.799px;
        }
        div#text-2 {
            width: 372.482px;
            height: 256.042px;
            background: #C6E5F3;
            position: absolute;
            top: 558.784px;
            left: 821.799px;
        }

        div#map-title {
            width: 373.268px;
            height: 41.253px;
            background: #C6E5F3;
            position: absolute;
            top: 834.826px;
            left: 821.799px;
        }

        div.map {
            width: 373.268px;
            height: 154px;
            background: #C6E5F3;
            position: absolute;
            top: 886px;
            left: 821.799px;
            position: relative;
        }
        div.map img {
             position:absolute;
            top:0;
            bottom:0;
            left:0;
            right:0; 
            margin: auto; 
            max-width: 373.268px;
            max-height: 154px;
        }
        div.map div.map-placeholder {
            width: 373.268px;
            height: 41.253px;
            background: #C6E5F3;
        }

        div.survey {
            width: 669.258px;
            height: 478.319px;
            background: #C6E5F3; 
            position: absolute;
            top: 558.784px;
            left: 1213.709px;
        }
        div.survey div.survey-buttons {
            text-align: center;
            margin-top: 30px;
        }
        div.survey div.survey-buttons button {
            background-color: #0078e7;
            font-size: 100%;
            padding: .5em 1em;
            text-decoration: none;
            border-radius: 2px;
            color: white;
            border: transparent;
            cursor: pointer;
        }
        div.survey div.survey-buttons button:disabled {
            filter: alpha(opacity=40);
            opacity: .4;
            cursor: not-allowed;
            pointer-events: none;
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
                <h1>
                    @include('templates.components.text', ['value' => array_get($readableComponents, 'landing-page-title'), 'default' => 'Landing Page Title'])
                </h1>
            </div>
            <div class="hero-image">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image'), 'default' => 'image'])
            </div>

            <div id="text-1" style="background-color: {{ ! empty(array_get($readableComponents, 'text-1')['_value']) ? 'transparent' : '' }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text-1'), 'default' => 'Text 1'])</p>
            </div>

            <div id="text-2" style="background-color: {{ ! empty(array_get($readableComponents, 'text-2')['_value']) ? 'transparent' : '' }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text-2'), 'default' => 'Text 2'])</p>
            </div>
            
            <div id="map-title" style="background-color: {{ ! empty(array_get($readableComponents, 'map-title')['_value']) ? 'transparent' : '' }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'map-title'), 'default' => 'Map Title'])</p>
            </div>

            <div class="map">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'map'), 'default' => 'map'])
            </div>
            
            <div class="survey">
                @include('templates.components.survey', ['value' => array_get($readableComponents, 'survey'), 'default' => 'Survey', 'unit' => $unit])</p>
            </div>
        </div>
    </div>
</body>
</html>