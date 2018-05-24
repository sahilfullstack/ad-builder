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

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-01.jpg);*/
            /*background-size: 960px 540px;*/
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
            width: 204px;
            height: 72px;
            position: absolute;
            top: 34px;
            left: 23px
        }

        div.logo img {
            width: 204px;
            height: 72px;
        }

        div.logo div.placeholder {
            width: 204px;
            height: 72px;
            outline: 3px dotted #CC337A;
        }

        div.logo div.placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 35px;
        }

        div.title {
            width: 690px;
            height: 68px;
            position: absolute;
            top: 40px;
            left: 258px;
            font-size: 27px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }

        div.hero-image {
            width: 385px;
            height: 383px;
            position: absolute;
            top: 131px;
            left: 20px;
        }
        div.hero-image img {
            width: 385px;
            height: 383px;
        }
        div.hero-image div.placeholder {
            width: 385px;
            height: 383px;
            background: #C6E5F3;
        }

        div#text-1 {
            width: 531px;
            height: 134px;
            background: #C6E5F3;
            position: absolute;
            top: 131px;
            left: 414px;
        }
        div#text-2 {
            width: 186px;
            height: 128px;
            background: #C6E5F3;
            position: absolute;
            top: 276px;
            left: 414px;
        }

        div.survey {
            width: 335px;
            height: 128px;
            background: #C6E5F3; 
            position: absolute;
            top: 276px;
            left: 610px;
        }

        div.map {
            width: 187px;
            height: 102px;
            background: #C6E5F3;
            position: absolute;
            top: 412px;
            left: 414px;
        }
        div.map img {
            width: 187px;
            height: 102px;
        }
        div.map div.map-placeholder {
            width: 187px;
            height: 102px;
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

            <div class="hero-image">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image'), 'default' => 'image'])
            </div>

            <div id="text-1">
                <p>Text 1</p>
            </div>

            <div id="text-2">
                <p>Text 2</p>
            </div>

            <div class="survey">
                <p>Survey</p>
            </div>

            <div class="map">
                <div class="map-placeholder">
                    Map
                </div>
            </div>
        </div>
    </div>
</body>
</html>