<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @font-face {
            font-family: Gotham;
            src: url('/fonts/Gotham-Medium.otf');
        }

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
            background: #ccc;
            width: 960px;
            height: 540px;
            font-family: Gotham;
        }

        div.body {
            width: 240px;
            height: 265px;
            background: #fff;
            position: relative;
            overflow: hidden;
        }

        div.banner {
            width: 240px;
            height: 10px;
            background: #199FD4;
        }

        p.category-header {
            margin-top: 5px;
            margin-left: 5px;
            color: #199FD4;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        div.logo {
            width: 153px;
            height: 57px;
            margin: 20px auto 30px;
        }

        div.logo img {
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            max-width: 153px;
            max-height: 57px;
        }

        div.logo div.placeholder {
            width: 153px;
            height: 57px;
            outline: 3px dotted #CC337A;
            outline-offset: -3px;
        }

        div.logo div.placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 25px;
        }
        
        div.text {
            width: 500px;
            height: 90px;
            background: #C6E5F3;
            margin: 0 auto 10px;
        }

        div.hero-video {
            height: 139px;
        }

        div.hero-video video {
            width: 240px;
            height: 139px;
            object-fit: fill;
        }

        div.hero-video div.placeholder {
            height: 139px;
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
        @include('templates.components.banner', ['value' => array_get($readableComponents, 'top-border-bar') ])

        <div class="body">
            <p class="category-header" style="color:{{ array_get($readableComponents, 'category-header-color._value') }};">@include('templates.components.text', ['value' => array_get($unit->category, 'name'), 'default' => 'Category Header'])</p>

            <div class="logo">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'logo'), 'default' => 'logo'])
            </div>
    
            <div class="hero-video">
                @include('templates.components.video', ['value' => array_get($readableComponents, 'video'), 'default' => 'video'])
            </div>
        </div>
    </div>
</body>
</html>