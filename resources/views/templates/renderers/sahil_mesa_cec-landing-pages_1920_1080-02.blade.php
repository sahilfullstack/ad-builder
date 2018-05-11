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

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-02.jpg);
            background-size: 1920px 1080px;*/
        }

        div.banner {
            width: 1920px;
            height: 26.758px;
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
            width: 416px;
            height: 208px;
            position: absolute;
            top: 68px;
            left: 32px;
        }

        div.logo img {
            width: 416px;
            height: 208px;
        }

        div.logo div.logo-placeholder {
            width: 416px;
            height: 208px;
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
            width: 902px;
            height: 70px;
            position: absolute;
            top: 220px;
            left: 490px;
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
            top: 106px;
            left: 1420px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-2 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1540px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-3 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1660px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        div.social-qrs div.social-qr {
            width: 50px;
            height: 50px;
            background: rgba(255,0,0,0.2);
        }

        div.hero-image {
            width: 800px;
            height: 430.372px;
            position: absolute;
            top: 340px;
            left: 32px;
        }
        div.hero-image img {
            width: 800px;
            height: 430.372px;
        }
        div.hero-image div.hero-image-placeholder {
            width: 800px;
            height: 430.372px;
            background: #C6E5F3;
        }

        div.social-logo-image1 {
            width: 63.361px;
            height: 43.552px;
            position: absolute;
            top: 46px;
            left: 1440px;
        }
        div.social-logo-image1 img {
            width: 63.361px;
            height: 43.552px;
        }
        div.social-logo-image1 div.social-logo-image1-placeholder {
            width: 63.361px;
            height: 43.552px;
            background: #C6E5F3;
        }

        div.social-logo-image2 {
            width: 63.361px;
            height: 43.552px;
            position: absolute;
            top: 46px;
            left: 1570px;
        }
        div.social-logo-image2 img {
            width: 63.361px;
            height: 43.552px;
        }
        div.social-logo-image2 div.social-logo-image2-placeholder {
            width: 63.361px;
            height: 43.552px;
            background: #C6E5F3;
        }

        div.social-logo-image3 {
            width: 63.361px;
            height: 43.552px;
            position: absolute;
            top: 46px;
            left: 1680px;
        }
        div.social-logo-image3 img {
            width: 63.361px;
            height: 43.552px;
        }
        div.social-logo-image3 div.social-logo-image3-placeholder {
            width: 63.361px;
            height: 43.552px;
            background: #C6E5F3;
        }

        div#hero-text {
            width: 412.146px;
            height: 334px;
            background: #C6E5F3;
            position: absolute;
            top: 437px;
            left: 842px;
        }

        div.hero-video {
            width: 638.318px;
            height: 332.065px;
            position: absolute;
            top: 437px;
            left: 1264.146px;
        }
        div.hero-video video {
            width: 638.318px;
            height: 332.065px;
        }
        div.hero-video div.hero-video-placeholder {
            width: 638.318px;
            height: 332.065px;
            background: #C6E5F3;
        }

        div.timeline {
            width: 1866px;
            height: 268.812px;
            background: #C6E5F3;
            position: absolute;
            top: 800px;
            left: 32px;
        }
        div.timeline img {
            width: 1866px;
            height: 268.812px;
        }
        div.timeline div.timeline-placeholder {
            width: 1866px;
            height: 268.812px;
            background: #C6E5F3;
        }
    </style>
    
</head>
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">    
    
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

            <div class="social-logo-image1">
                <div class="social-logo-image1-placeholder">
                    1
                </div>
            </div><div class="social-logo-image2">
                <div class="social-logo-image2-placeholder">
                    2
                </div>
            </div><div class="social-logo-image3">
                <div class="social-logo-image3-placeholder">
                    3
                </div>
            </div>

            <div class="social-qrs-1">
                <div class="social-qr">
                    
                </div>
            </div>

            <div class="social-qrs-2">
                <div class="social-qr">
                    
                </div>
            </div>

            <div class="social-qrs-3">
                <div class="social-qr">
                    
                </div>
            </div>

            <div class="hero-image">
                <div class="hero-image-placeholder">
                    Hero Image
                </div>
            </div>

     <div id="hero-text">
                <p>Hero Text</p>
            </div>

            <div class="hero-video">
                <div class="hero-video-placeholder">
                    Hero Video
                </div>
            </div>


            <div class="timeline">
                <div class="timeline-placeholder">
                    Timeline
                </div>
            </div>
         </div>
    </div>
</body>
</html>