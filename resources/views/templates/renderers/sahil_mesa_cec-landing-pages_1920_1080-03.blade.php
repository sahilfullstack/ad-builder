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
            top: 70.775px;
            left: 29px;
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
            padding-top: 15px;
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
        div.map div.map-placeholder {
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
            left: 1294.65px;

        }
        div.blog-logo img {
            width: 42.402px;
            height: 42.316px;
        }
        div.blog-logo div.blog-logo-placeholder {
            width: 42.402px;
            height: 42.316px;
            background: #C6E5F3;
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
            
            <div id="hero-text1">
                <p>Hero Text 1</p>
            </div>
            <div class="slideshow">
                <div class="slideshow-placeholder">
                    Slideshow
                </div>
            </div>
            <div id="hero-text2">
                <p>Hero Text 2</p>
            </div>
            <div id="address-text">
                <p>Address</p>
            </div>
            <div class="map">
                <div class="map-placeholder">
                    Map
                </div>
            </div>
            <div class="audio">
                <div class="audio-placeholder">
                    Audio
                </div>
            </div> 
            <div class="blog-logo">
                <div class="blog-logo-placeholder">
                    Blog Logo
                </div>
            </div>
             <div class="blog-qrs">
                <div class="blog-qr">
                    
                </div>
            </div>
<!--             <div class="baby-image5">
                <div class="baby-image5-placeholder">
                    B-5
                </div>
            </div> -->
    </div>
</body>
</html>