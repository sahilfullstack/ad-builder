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

        div.hero-image1 {
            width: 572px;
            height: 414.899px;
            position: absolute;
            top: 37px;
            left: 29px;
        }
        div.hero-image1 img {
            width: 572px;
            height: 414.899px;
        }
        div.hero-image1 div.hero-image1-placeholder {
            width: 572px;
            height: 414.899px;
            background: #C6E5F3;
        }  

        div.hero-image2 {
            width: 572px;
            height: 414.899px;
            position: absolute;
            top: 380.955px;
            left: 29px;
        }
        div.hero-image2 img {
            width: 572px;
            height: 414.899px;
        }
        div.hero-image2 div.hero-image2-placeholder {
            width: 572px;
            height: 414.899px;
            background: #C6E5F3;
        }  

        div.hero-image3 {
            width: 572px;
            height: 414.899px;
            position: absolute;
            top: 730.775px;
            left: 29px;
        }
        div.hero-image3 img {
            width: 572px;
            height: 414.899px;
        }
        div.hero-image3 div.hero-image3-placeholder {
            width: 572px;
            height: 414.899px;
            background: #C6E5F3;
        }

        div.logo {
            width: 412px;
            height: 149px;
            position: absolute;
            top: 320px;
            left: 720px;
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
            width: 1791px;
            height: 77px;
            position: absolute;
            top: 590px;
            left: 720px;
            font-size: 19px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }

        div#hero-text1 {
            width: 572px;
            height: 164.564px;
            background: #C6E5F3;
            position: absolute;
            top: 730px;
            left: 720px;
        }

        div#hero-text2 {
            width: 572px;
            height: 164.564px;
            background: #C6E5F3;
            position: absolute;
            top: 730px;
            left: 720px;
        }

        div#hero-text3 {
            width: 572px;
            height: 164.564px;
            background: #C6E5F3;
            position: absolute;
            top: 730px;
            left: 720px;
        }

        div.social-qrs-1 {
            width: 91.414px;
            height: 88.534px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1420px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-2 {
            width: 91.414px;
            height: 88.534px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1540px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-3 {
            width: 91.414px;
            height: 88.534px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1660px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        div.social-qrs-1 div.social-qr {
           width: 91.414px;
            height: 88.534px;
            background: rgba(255,0,0,0.2);
        }  
        div.social-qrs-2 div.social-qr {
           width: 91.414px;
            height: 88.534px;
            background: rgba(255,0,0,0.2);
        }  

        div.social-qrs-3 div.social-qr {
            width: 91.414px;
            height: 88.534px;
            background: rgba(255,0,0,0.2);
        }


           div.social-logo-image1 {
            width: 50.63px;
            height: 30.801px;
            position: absolute;
            top: 46px;
            left: 1440px;
        }
        div.social-logo-image1 img {
            width: 50.63px;
            height: 30.801px;
        }
        div.social-logo-image1 div.social-logo-image1-placeholder {
            width: 50.63px;
            height: 30.801px;
            background: #C6E5F3;
        }

        div.social-logo-image2 {
            width: 50.63px;
            height: 30.801px;
            position: absolute;
            top: 46px;
            left: 1570px;
        }
        div.social-logo-image2 img {
            width: 50.63px;
            height: 30.801px;
        }
        div.social-logo-image2 div.social-logo-image2-placeholder {
            width: 50.63px;
            height: 30.801px;
            background: #C6E5F3;
        }

        div.social-logo-image3 {
            width: 50.63px;
            height: 30.801px;
            position: absolute;
            top: 46px;
            left: 1680px;
        }
        div.social-logo-image3 img {
            width: 50.63px;
            height: 30.801px;
        }
        div.social-logo-image3 div.social-logo-image3-placeholder {
            width: 50.63px;
            height: 30.801px;
            background: #C6E5F3;
        }

    </style>
    
</head>
<body>
    
    <div id="workspace">
        <div class="banner"></div>

        <div class="body">
            <div class="hero-image1">
                <div class="hero-image1-placeholder">
                    Hero Image 1 
                </div>
            </div>
            <div class="hero-image2">
                <div class="hero-image2-placeholder">
                    Hero Image 2
                </div>                
            </div>            
            <div class="hero-image3">
                <div class="hero-image3-placeholder">
                    Hero Image 3
                </div>
            </div>

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

            <div id="hero-text2">
                <p>Hero Text 2</p>
            </div>

            <div id="hero-text3">
                <p>Hero Text 3</p>
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
    </div>
</body>
</html>