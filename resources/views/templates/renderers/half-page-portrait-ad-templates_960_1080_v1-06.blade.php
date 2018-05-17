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
            background: #ffffff;
            width: 960px;
            height: 540px;
            font-family: sans-serif;
        }

        div.body {
            width: 480px;
            height: 530px;
            position: relative;
        }

        div.banner {
            width: 960px;
            height: 10px;
            background: #199FD4;
        }

        p.category-header {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #199FD4;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        div.logo {
            width: 260px;
            height: 130px;
            margin: 20px auto 10px;
        }

        div.logo img {
            width: 260px;
            height: 130px;
        }

        div.logo div.logo-placeholder {
            width: 260px;
            height: 130px;
            outline: 3px dotted #CC337A;
        }

        div.logo div.logo-placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 55px;
        }
        
        div.text {
            width: 280px;
            height: 90px;
            background: #C6E5F3;
            margin: 0 auto 10px;
        }

        div.hero-video {
            height: 530px;
        }

        div.hero-video video {
            width: 480px;
            height: 530px;
        }

        div.hero-video div.hero-video-placeholder {
            height: 530px;
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
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">    
    
    <div id="workspace">
        @include('templates.components.banner', ['value' => array_get($readableComponents, 'theme') ])

        <div class="body">
            <p class="category-header">@include('templates.components.text', ['value' => array_get($unit->category, 'name'), 'default' => 'Category Header'])</p>
    
            <div class="hero-video">
                @include('templates.components.video', ['value' => array_get($readableComponents, 'hero-video'), 'default' => 'hero-video'])
            </div>
        </div>
    </div>
</body>
</html>