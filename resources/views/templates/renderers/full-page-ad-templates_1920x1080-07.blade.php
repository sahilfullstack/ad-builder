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
            background: #ffffff;
            width: 960px;
            height: 540px;
            font-family: Gotham;
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
            padding-top: 10px;
            padding-left: 10px;
            color: #199FD4;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        div.logo {
            width: 485px;
            height: 110px;
            margin: 20px auto 10px;
        }

        div.logo img {
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            display: table-cell;
            vertical-align: middle; 
            max-width: 485px;
            max-height: 110px;
        }

        div.logo div.placeholder {
            width: 485px;
            height: 110px;
            outline: 3px dotted #CC337A;
            outline-offset: -3px;
        }

        div.logo div.placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 55px;
        }
        
        div.text {
            width: 485px;
            height: 57px;
            background: #C6E5F3;
            margin: 0 auto 10px;
            overflow: hidden;
        }

        div.hero-image {
            height: 295px;
        }

        div.hero-image img {
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            display: table-cell;
            vertical-align: middle; 
            max-width: 960px;
            max-height: 295px;
        }

        div.hero-image div.placeholder {
            height: 295px;
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

            <div class="text" style="
                background-color: {{ empty(array_get($readableComponents, 'text')['background_color']) ? 'transparent' : array_get($readableComponents, 'text')['background_color'] }};
                display: flex;
                align-items: {{ align_to_flex_rule(array_get($readableComponents, 'text.valign')) }};
                justify-content: {{ align_to_flex_rule(array_get($readableComponents, 'text.halign')) }};
                text-align: {{ array_get($readableComponents, 'text.halign') }};    
            ">
                @include('templates.components.text', ['value' => array_get($readableComponents, 'text'), 'default' => 'Text'])
            </div>
    
            <div class="hero-image">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image'), 'default' => 'image'])
            </div>
        </div>
    </div>
</body>
</html>