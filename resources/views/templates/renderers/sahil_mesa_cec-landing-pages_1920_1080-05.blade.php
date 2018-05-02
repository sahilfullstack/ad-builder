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

        div.hero-image-1 {
            width: 420px;
            height: 183px;
            position: absolute;
            top: 470px;
            left: 151px;
        }
        div.hero-image-1 img {
            width: 420px;
            height: 183px;
        }
        div.hero-image-1 div.hero-image-1-placeholder {
            width: 420px;
            height: 183px;
            background: #C6E5F3;
        }
        div#hero-text-1 {
            width: 419.601px;
            height: 350.585px;
            background: #C6E5F3;
            position: absolute;
            top: 675px;
            left: 151px;
        }

        div.title-image-1 {
            width: 120.691px;
            height: 120.691px;
            position: absolute;
            top: 330px;
            left: 291px;
        }
        div.title-image-1 img {
            width: 120.691px;
            height: 120.691px;
        }
        div.title-image-1 div.title-image-1-placeholder {
            width: 120.691px;
            height: 120.691px;
            background: #C6E5F3;
        }

        div.title-image-2 {
            width: 120.691px;
            height: 120.691px;
            position: absolute;
            top: 330px;
            left: 732px;
        }
        div.title-image-2 img {
            width: 120.691px;
            height: 120.691px;
        }
        div.title-image-2 div.title-image-2-placeholder {
            width: 120.691px;
            height: 120.691px;
            background: #C6E5F3;
        }

        div.hero-image-2 {
            width: 420px;
            height: 183px;
            position: absolute;
            top: 470px;
            left: 602px;
        }

        div.hero-image-2 img {
            width: 420px;
            height: 183px;
        }

        div.hero-image-2 div.hero-image-2-placeholder {
            width: 420px;
            height: 183px;
            background: #C6E5F3;
        }

        div#hero-text-2 {
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
            
            <div class="title-image-1">
                <div class="title-image-1-placeholder">
                    Title Image 1
                </div>
            </div>

            <div class="hero-image-1">
                <div class="hero-image-1-placeholder">
                    Hero Image 1
                </div>
            </div>

            <div id="hero-text-1">
                <p>Hero Text 1</p>
            </div>

            <div class="title-image-2">
                <div class="title-image-2-placeholder">
                    Title Image 2
                </div>
            </div>

            <div class="hero-image-2">
                <div class="hero-image-2-placeholder">
                    Hero Image 2
                </div>
            </div>

            <div id="hero-text-2">
                <p>Hero Text 2</p>
            </div>

            <div class="slideshow">
                <div class="slideshow-placeholder">
                    Slideshow
                </div>
            </div>
         </div>
    </div>
</body>
</html>