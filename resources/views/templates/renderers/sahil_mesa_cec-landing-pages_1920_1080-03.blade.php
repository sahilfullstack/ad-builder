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
            width: 387px;
            height: 149px;
            position: absolute;
            top: 70.775px;
            left: 29px;
        }
        div.hero-image1 img {
            width: 387px;
            height: 149px;
        }
        div.hero-image1 div.hero-image1-placeholder {
            width: 387px;
            height: 149px;
            background: #C6E5F3;
        }  

        div.hero-image2 {
            width: 482px;
            height: 176px;
            position: absolute;
            top: 263.775px;
            left: 29px;
        }
        div.hero-image2 img {
            width: 482px;
            height: 176px;
        }
        div.hero-image2 div.hero-image2-placeholder {
            width: 482px;
            height: 176px;
            background: #C6E5F3;
        }  

        div.hero-image3 {
            width: 615.254px;
            height: 551.025px;
            position: absolute;
            top: 483.775px;
            left: 29px;
        }
        div.hero-image3 img {
            width: 615.254px;
            height: 551.025px;
        }
        div.hero-image3 div.hero-image3-placeholder {
            width: 615.254px;
            height: 551.025px;
            background: #C6E5F3;
        }

        div.hero-image4 {
            width: 1199.024px;
            height: 561.439px;
            position: absolute;
            top: 70.775px;
            left: 673.254px;
        }
        div.hero-image4 img {
            width: 1199.024px;
            height: 561.439px;
        }
        div.hero-image4 div.hero-image4-placeholder {
            width: 1199.024px;
            height: 561.439px;
            background: #C6E5F3;
        }
        
        div.hero-image5 {
            width: 1199.056px;
            height: 162px;
            position: absolute;
            top: 650px;
            left: 673.254px;
        }
        div.hero-image5 img {
            width: 1199.056px;
            height: 162px;
        }
        div.hero-image5 div.hero-image5-placeholder {
            width: 1199.056px;
            height: 162px;
            background: #C6E5F3;
        }
        div.baby-image1 {
            width: 372.395px;
            height: 41.253px;
            position: absolute;
            top: 827px;
            left: 673.254px;
        }
        div.baby-image1 img {
            width: 372.395px;
            height: 41.253px;
        }
        div.baby-image1 div.baby-image1-placeholder {
            width: 372.395px;
            height: 41.253px;
            background: #C6E5F3;
        }

        div.baby-image2 {
            width: 372.395px;
            height: 157.127px;
            position: absolute;
            top: 875.253px;
            left: 673.254px;
        }
        div.baby-image2 img {
            width: 372.395px;
            height: 157.127px;
        }
        div.baby-image2 div.baby-image2-placeholder {
            width: 372.395px;
            height: 157.127px;
            background: #C6E5F3;
        }
        div.baby-image3 {
            width: 188.839px;
            height: 202.139px;
            position: absolute;
            top: 827px;
            left: 1065.65px;
        }
        div.baby-image3 img {
            width: 188.839px;
            height: 202.139px;
        }
        div.baby-image3 div.baby-image3-placeholder {
            width: 188.839px;
            height: 202.139px;
            background: #C6E5F3;
        }
        
        div.baby-image4 {
            width: 114.5px;
            height: 110.796px;
            position: absolute;
            top: 885.253px;
            left: 1274.65px;
        }
        div.baby-image4 img {
            width: 114.5px;
            height: 110.796px;
        }
        div.baby-image4 div.baby-image4-placeholder {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
        }
        
        div.baby-image5 {
            width: 42.402px;
            height: 42.316px;
            position: absolute;
            top: 827px;
            left: 1294.65px;
        }
        div.baby-image5 img {
            width: 42.402px;
            height: 42.316px;
        }
        div.baby-image5 div.baby-image5-placeholder {
            width: 42.402px;
            height: 42.316px;
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
            <div class="hero-image4">
                <div class="hero-image4-placeholder">
                    Hero Image 4
                </div>
            </div>
            <div class="hero-image5">
                <div class="hero-image5-placeholder">
                    Hero Image 5
                </div>
            </div>
            <div class="baby-image1">
                <div class="baby-image1-placeholder">
                    Baby Image 1
                </div>
            </div>
            <div class="baby-image2">
                <div class="baby-image2-placeholder">
                    Baby Image 2
                </div>
            </div> 
            <div class="baby-image3">
                <div class="baby-image3-placeholder">
                    Baby Image 3
                </div>
            </div> 
            <div class="baby-image4">
                <div class="baby-image4-placeholder">
                    Baby Image 4
                </div>
            </div>
            <div class="baby-image5">
                <div class="baby-image5-placeholder">
                    B-5
                </div>
            </div>
    </div>
</body>
</html>