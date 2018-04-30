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
            width: 960px;
            height: 540px;
            font-family: sans-serif;
        }

        div.body {
            width: 480px;
            height: 260px;
            position: relative;
            background: #fff;
        }

        div.banner {
            width: 960px;
            height: 10px;
            background: #199FD4;
        }

        div.sidebar {
            width: 155px;
            float: left;
            height: 260px;
            background: #FFFFFF;
            padding-left: 15px;
        }

        p.category-header {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #199FD4;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        div.logo {
            width: 150px;
            height: 65px;
            float: left;
            margin-left: 75px;
            margin-top: 30px;
        }

        div.logo img {
            width: 150px;
            height: 65px;
        }

        div.logo div.logo-placeholder {
            width: 150px;
            height: 65px;
            outline: 3px dotted #CC337A;
        }

        div.logo div.logo-placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 25px;
        }
        
        div.text {
            width: 150px;
            height: 65px;
            float: left;
            margin-left: 30px;
            margin-top: 30px;
            background: #C6E5F3;
        }

        div.hero-video {
            position: absolute;
            top: 100px;
            margin-top: 30px;
            width: 480px;
            height: 130px;
        }

        div.hero-video img {
            width: 480px;
            height: 130px;
        }

        div.hero-video div.hero-video-placeholder {
            height: 130px;
            background: #C6E5F3;
        }

        p.null-state {
            padding-top: 230px;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
            color: #aaa;
            text-align: center;
        }
    </style>
    
</head>
<body>
    
    <div id="workspace">
        <div class="banner"></div>

        <div class="body">
            <p class="category-header">Category Header</p>


            <div class="logo">
                <div class="logo-placeholder">
                    <p>LOGO</p>
                </div>
            </div>

            <div class="text">
                <p>Text</p>
            </div>

            <div class="hero-video">
                <div class="hero-video-placeholder">
                    Hero Video
                </div>
            </div>
    
        </div>
    </div>
</body>
</html>