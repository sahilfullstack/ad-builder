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
            /* height: 1080px; */
            height: 1053.225px;
            background: #fff;

            position: relative;
            overflow: auto;
        }

        div.logo {
            width: 414px;
            height: 229px;
            position: absolute;
            top: 50px;
            left: 50px;
        }

        div.logo img {
            width: 414px;
            height: 229px;
        }

        div.logo div.logo-placeholder {
            width: 414px;
            height: 229px;
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
            width: 849px;
            height: 57px;
            position: absolute;
            top: 330px;
            left: 50px;
            font-size: 19px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }

        div.image-1 {
            width: 235.374px;
            height: 170.728px;
            position: absolute;
            top: 420px;
            left: 50px;
        }
        div.image-1 img {
            width: 235.374px;
            height: 170.728px;
        }
        div.image-1 div.image-1-placeholder {
            width: 235.374px;
            height: 170.728px;
            background: #C6E5F3;
        }
        div#text-1 {
            width: 572px;
            height: 170.728px;
            background: #C6E5F3;
            position: absolute;
            top: 420px;
            left: 330px;
        }

        div.image-2 {
            width: 235.374px;
            height: 170.728px;
            position: absolute;
            top: 620px;
            left: 50px;
        }
        div.image-2 img {
            width: 235.374px;
            height: 170.728px;
        }
        div.image-2 div.image-2-placeholder {
            width: 235.374px;
            height: 170.728px;
            background: #C6E5F3;
        }
        div#text-2 {
            width: 572px;
            height: 170.728px;
            background: #C6E5F3;
            position: absolute;
            top: 620px;
            left: 330px;
        }
        div.image-3 {
            width: 235.374px;
            height: 170.728px;
            position: absolute;
            top: 820px;
            left: 50px;
        }
        div.image-3 img {
            width: 235.374px;
            height: 170.728px;
        }
        div.image-3 div.image-3-placeholder {
            width: 235.374px;
            height: 170.728px;
            background: #C6E5F3;
        }
        div#text-3 {
            width: 572px;
            height: 170.728px;
            background: #C6E5F3;
            position: absolute;
            top: 820px;
            left: 330px;
        }
        div.image-4 {
            width: 235.374px;
            height: 170.728px;
            position: absolute;
            top: 50px;
            left: 1000px;
        }
        div.image-4 img {
            width: 235.374px;
            height: 170.728px;
        }
        div.image-4 div.image-4-placeholder {
            width: 235.374px;
            height: 170.728px;
            background: #C6E5F3;
        }
        div#text-4 {
            width: 572px;
            height: 170.728px;
            background: #C6E5F3;
            position: absolute;
            top: 50px;
            left: 1265px;
        }
        div.image-5 {
            width: 235.374px;
            height: 170.728px;
            position: absolute;
            top: 250px;
            left: 1000px;
        }
        div.image-5 img {
            width: 235.374px;
            height: 170.728px;
        }
        div.image-5 div.image-5-placeholder {
            width: 235.374px;
            height: 170.728px;
            background: #C6E5F3;
        }
        div#text-5 {
            width: 572px;
            height: 170.728px;
            background: #C6E5F3;
            position: absolute;
            top: 250px;
            left: 1265px;
        }
        div.image-6 {
            width: 235.374px;
            height: 170.728px;
            position: absolute;
            top: 450px;
            left: 1000px;
        }
        div.image-6 img {
            width: 235.374px;
            height: 170.728px;
        }
        div.image-6 div.image-6-placeholder {
            width: 235.374px;
            height: 170.728px;
            background: #C6E5F3;
        }
        div#text-6 {
            width: 572px;
            height: 170.728px;
            background: #C6E5F3;
            position: absolute;
            top: 450px;
            left: 1265px;
        }

         div#address-text {
            background: #C6E5F3;
            width: 372.395px;
            height: 41.253px;
            position: absolute;
            top: 650px;
            left: 1000px;
        }

        div.map {
            width: 372.395px;
            height: 157.127px;
            position: absolute;
            top: 700.253px;
            left: 1000px;
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

        div#hours-of-operation {
            background: #C6E5F3;
            width: 461px;
            height: 376px;
            position: absolute;
            top: 650px;
            left: 1402px;
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
            <div class="image-1">
                <div class="image-1-placeholder">
                    Title Image 1
                </div>
            </div>
             <div id="text-1">
                <p>Text 1</p>
            </div>
            <div class="image-2">
                <div class="image-2-placeholder">
                    Title Image 2
                </div>
            </div>
            <div id="text-2">
                <p>Text 2</p>
            </div>            
            <div class="image-3">
                <div class="image-3-placeholder">
                    Title Image 3
                </div>
            </div>
            <div id="text-3">
                <p>Text 3</p>
            </div>
             <div class="image-4">
                <div class="image-4-placeholder">
                    Title Image 4
                </div>
            </div>
            <div id="text-4">
                <p>Text 4</p>
            </div>
            <div class="image-5">
                <div class="image-5-placeholder">
                    Title Image 5
                </div>
            </div>
            <div id="text-5">
                <p>Text 5</p>
            </div>
            <div class="image-6">
                <div class="image-6-placeholder">
                    Title Image 6
                </div>
            </div>
            <div id="text-6">
                <p>Text 6</p>
            </div>
            <div id="address-text">
                <p>Address</p>
            </div>
            <div class="map">
                <div class="map-placeholder">
                    Map
                </div>
            </div>
            <div id="hours-of-operation">
                <p>Hours of operation</p>
            </div> 
         </div>
    </div>
</body>
</html>