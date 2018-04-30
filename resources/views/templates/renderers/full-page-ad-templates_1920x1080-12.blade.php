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
            background: #ffffff;
            width: 960px;
            height: 540px;
            font-family: sans-serif;
        }

        div.banner {
            width: 960px;
            height: 10px;
            /* position: absolute; */
            /* top: 0;
            left: 0; */
            background: #199FD4;
        }

        p.category-header {
            margin-left: 15px;
            padding-top: 10px;
            color: #199FD4;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        div.logo {
            width: 500px;
            height: 90px;
            margin-left: 15px;
        }

        div.logo img {
            width: 500px;
            height: 90px;
        }

        div.logo div.logo-placeholder {
            width: 500px;
            height: 90px;
            outline: 3px dotted #CC337A;
        }

        div.logo div.logo-placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 35px;
        }
        
        div.text {
            width: 500px;
            height: 90px;
            background: #C6E5F3;
            float: right;
        }

        div.images {
            margin: 10px auto;
            content: "";
            display: table;
            clear: both;
        }

        div.image {
            float: left;
            margin-right: 20px;
            width: 262px;
            height: 262px;
        }

        div.image img {
            width: 262px;
            height: 262px;
        }

        div.image div.image-placeholder {
            height: 262px;
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

            <div class="images">
                <div class="image">
                    <div class="image-placeholder">
                        
                    </div>
                </div>
                <div class="image">
                    <div class="image-placeholder">
                        
                    </div>
                </div>
                <div class="image">
                    <div class="image-placeholder">
                        
                    </div>
                </div>
            </div>

            <div class="text">
                <p>Text</p>
            </div>
    
            {{-- <div class="hero-image">
                <div class="hero-image-placeholder">
                    Hero Image
                </div>
            </div> --}}
        </div>
    </div>
</body>
</html>