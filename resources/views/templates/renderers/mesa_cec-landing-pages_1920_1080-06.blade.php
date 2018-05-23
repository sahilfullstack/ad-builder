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
            top: 30px;
            left: 1040px;
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
            width: 830px;
            height: 62px;
            position: absolute;
            top: 250px;
            left: 1040px;
            font-size: 19px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }

        div#text {
            width: 840px;
            height: 411.024px;
            background: #C6E5F3;
            position: absolute;
            top: 360px;
            left: 1040px;
        }

        div.hero-video {
            width: 982.597px;
            height: 554.237px;
            position: absolute;
            top: 30px;
            left: 30px;
        }
        div.hero-video video {
            width: 982.597px;
            height: 554.237px;
        }
        div.hero-video div.placeholder {
            width: 982.597px;
            height: 554.237px;
            background: #C6E5F3;
        }

        div.slideshow {
            width: 396px;
            height: 412.283px;
            background: #C6E5F3;
            position: absolute;
            top: 600px;
            left: 620px;
        }

        div.slideshow img {
            width: 396px;
            height: 412.283px;
        }
        
        div.slideshow div.slideshow-placeholder {
            width: 396px;
            height: 412.283px;
            background: #C6E5F3;
        }

        div.survey {
            width: 572.244px;
            height: 408.963px;
            background: #C6E5F3; 
            position: absolute;
            top: 600px;
            left: 30px;
        }

        div#address-text {
            background: #C6E5F3;
            width: 372.395px;
            height: 41.253px;
            position: absolute;
            top: 800px;
            left: 1040px;
        }

        div.map {
            width: 372.395px;
            height: 157.127px;
            position: absolute;
            top: 855.253px;
            left: 1040px;
        }
        div.map img {
            width: 372.395px;
            height: 157.127px;
        }
        div.map div.map-placeholder {
            width: 372.395px;
            height: 157.127px;
            background: #C6E5F3;
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
        @include('templates.components.banner', ['value' => array_get($readableComponents, 'theme') ])

        <div class="body">
            <div class="logo">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'logo'), 'default' => 'logo'])
            </div>
             <div class="title">
                <h1>@include('templates.components.text', ['value' => array_get($readableComponents, 'landing-page-title'), 'default' => 'Landing Page Title'])</h1>
            </div>

            <div id="text">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text'), 'default' => 'Text'])</p>
            </div>

            <div class="hero-video">
                @include('templates.components.video', ['value' => array_get($readableComponents, 'video'), 'default' => 'video'])
            </div>

            <div class="slideshow">
                @include('templates.components.slideshow', ['value' => array_get($readableComponents, 'slideshow'), 'default' => 'slideshow'])
            </div>

            <div class="survey">
                <p>@include('templates.components.survey', ['value' => array_get($readableComponents, 'survey'), 'default' => 'Survey', 'unit' => $unit])</p>
            </div>

            <div id="address-text">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'map-title'), 'default' => 'Map Title'])</p>
            </div>
            <div class="map">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'map'), 'default' => 'map'])
            </div>
         </div>
    </div>
</body>
</html>