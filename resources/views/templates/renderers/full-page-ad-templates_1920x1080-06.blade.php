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
            background: #ffffff;
        }

        div.banner {
            width: 960px;
            height: 10px;
            background: #199FD4;
        }

        div.sidebar {
            width: 310px;
            float: right;
            height: 530px;
            background: #FFFFFF;
            padding-left: 15px;
        }

        div.sidebar p.category-header {
            margin-top: 10px;
            color: #199FD4;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        div.sidebar div.logo {
           width: 204.5px;
            height: 270px;
            margin: 70px auto 70px;
            position: relative;
        }

        div.sidebar div.logo img {
             position:absolute;
            top:0;
            bottom:0;
            left:0;
            right:0; 
            margin: auto; 
           max-width: 204.5px;
            max-height: 270px;
        }

        div.sidebar div.logo div.placeholder {
           width: 204.5px;
            height: 270px;
            outline: 3px dotted #CC337A;
            outline-offset: -3px;
        }

        div.sidebar div.logo div.placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 105px;
        }

        div.sidebar div.quote-holder {
            position: relative;
            width: 247.5px;
            margin: 0 auto 30px;
        }
        
        div.sidebar div.quote {
            width: 247.5px;
            height: 37px;
            background: #199FD4;
            margin: 0 auto 30px;
            position: relative;
            overflow: hidden;
        }
        
        div.flag {
            width: 0px;
            height: 0px;
            position: absolute;
            bottom: -20px;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 20px solid #199FD4;
        }

        div.hero-video {
            height: 530px;
        }

        div.hero-video video {
            width: 650px;
            height: 530px;
        }

        div.hero-video div.placeholder {
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
        @include('templates.components.banner', ['value' => array_get($readableComponents, 'top-border-bar') ])

        <div class="body">
            <div class="sidebar">
                <p class="category-header" style="color:{{ array_get($readableComponents, 'category-header-color._value') }};">@include('templates.components.text', ['value' => array_get($unit->category, 'name'), 'default' => 'Category Header'])</p>

                <div class="logo">
                    @include('templates.components.image', ['value' => array_get($readableComponents, 'logo'), 'default' => 'logo'])
                </div>

                <div class="quote-holder">
                    <div class="flag" style="border-top-color: {{ array_get($readableComponents, 'text.background_color') }}"></div>
                    <div class="quote" style="background-color: {{ array_get($readableComponents, 'text.background_color') }};overflow:hidden;">
                        @include('templates.components.text', ['value' => array_get($readableComponents, 'text'), 'default' => 'Text'])
                    </div>
                </div>
            </div>
    
            <div class="hero-video">
                @include('templates.components.video', ['value' => array_get($readableComponents, 'video'), 'default' => 'video'])
            </div>
        </div>
    </div>
</body>
</html>