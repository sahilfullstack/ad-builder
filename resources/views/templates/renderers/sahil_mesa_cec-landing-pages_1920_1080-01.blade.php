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
        #workspace {
            background: #ccc;
            width: 1920px;
            height: 1080px;
            font-family: sans-serif;

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-01.jpg);*/
            /*background-size: 1920px 1080px;*/
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
            left: 35px
        }

        div.logo img {
            width: 387px;
            height: 149px;
        }

        div.logo div.logo-placeholder {
            width: 387px;
            height: 149px;
            outline: 3px dotted #CC337A;
        }

        div.logo div.logo-placeholder p {
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
        div.hero-image div.hero-image-placeholder {
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
        }
        div.map img {
            width: 373.268px;
            height: 41.253px;
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

    </style>
    
</head>
<body>
    
    <div id="workspace">
        <div class="banner"></div>

        <div class="body">
            <div class="logo">
                <div class="logo-placeholder">
                    <p>LOGO</p>
                </div>
            </div>
             <div class="title">
                <h1>Landing Page Title</h1>
            </div>
            <div class="hero-image">
                <div class="hero-image-placeholder">
                    Hero Image
                </div>
            </div>

            <div id="text-1">
                <p>Text 1</p>
            </div>

            <div id="text-2">
                <p>Text 2</p>
            </div>
            
            <div id="map-title">
                <p>Map title</p>
            </div>

            <div class="map">
                <div class="map-placeholder">
                    Map
                </div>
            </div>

            <div class="survey">
                <p>Survey</p>
            </div>
        </div>
    </div>
</body>
</html>