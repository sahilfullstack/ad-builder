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

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-06.jpg);
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
            width: 190px;
            height: 73px;
            position: absolute;
            top: 29px;
            left: 453px;
        }

        div.logo img {
            width: 190px;
            height: 73px;
        }

        div.logo div.logo-placeholder {
            width: 190px;
            height: 73px;
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
            width: 496px;
            height: 133px;
            position: absolute;
            top: 90px;
            left: 443px;
            font-size: 23px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }

        div.slideshow {
            width: 576px;
            height: 133px;
            position: absolute;
            top: 383px;
            left: 22px;
        }

        div.slideshow img {
            width: 576px;
            height: 133px;
        }

        div.hero-video video {
            width: 982.597px;
            height: 554.237px;
        }

        div.slideshow div.slideshow-placeholder {
            width: 576px;
            height: 133px;
            background: #C6E5F3;
        }

        div.survey {
            width: 325px;
            height: 134px;
            position: absolute;
            top: 383px;
            left: 615px;
        }
        div.survey img {
            width: 325px;
            height: 134px;
        }
        div.survey div.survey-placeholder {
            width: 325px;
            height: 134px;
            background: #C6E5F3;
        }

        div.hero-video {
            width: 416px;
            height: 344px;
            position: absolute;
            top: 28px;
            left: 21px;
        }
        div.hero-video img {
            width: 416px;
            height: 344px;
        }
        div.hero-video div.hero-video-placeholder {
            width: 416px;
            height: 344px;
            background: #C6E5F3;
        }

        div#text-1 {
            width: 489px;
            height: 206px;
            background: #C6E5F3;
            position: absolute;
            top: 166px;
            left: 450px;
        }

        div#text-2 {
            width: 600px;
            height: 34px;
            background: #C6E5F3;
            position: absolute;
            top: 339px;
            left: 347px;
        }
    </style>
    
</head>
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">    
    
    <div id="workspace">
        <div class="banner"></div>

        <div class="body">
            <div class="logo">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'logo'), 'default' => 'logo'])
            </div>
            <div class="title">
                <h1>@include('templates.components.text', ['value' => array_get($readableComponents, 'landing-page-title'), 'default' => 'Landing Page Title'])</h1>
            </div>
    
            <div class="hero-video">
                @include('templates.components.video', ['value' => array_get($readableComponents, 'hero-video'), 'default' => 'hero-video'])
            </div>

            <div class="slideshow">
                <div class="slideshow-placeholder">
                    Slideshow
                </div>
            </div>


            <div id="text-1">
                <p>Text 1</p>
            </div>

            <div class="survey">
                <div class="survey-placeholder">
                    Survey
                </div>
            </div>
        </div>
    </div>
</body>
</html>