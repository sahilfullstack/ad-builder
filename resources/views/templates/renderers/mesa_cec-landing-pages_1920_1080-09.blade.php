<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset Begins */
        @font-face {
            font-family: Gotham;
            src: url('/fonts/Gotham-Medium.otf');
        }

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
            zoom: 50%;
        }
        body.two-x {
            zoom: 100%;
        }
        
        #workspace {
            background: #ccc;
            width: 1920px;
            height: 1080px;
            font-family: Gotham;

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-01.jpg);*/
            /*background-size: 1920px 1080px;*/
        }

        #workspace div {
            overflow: hidden;
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
            width: 412px;
            height: 149px;
            position: absolute;
            top: 75px;
            left: 720px;
        }

        div.logo img {
            width: 412px;
            height: 149px;
        }

        div.logo div.placeholder {
            width: 412px;
            height: 149px;
            outline: 3px dotted #CC337A;
        }

        div.logo div.placeholder p {
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
            top: 240px;
            left: 75px;
            font-size: 19px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }

        div.image-1 {
            width: 572px;
            height: 414.899px;
            position: absolute;
            top: 377px;
            left: 75px;
        }
        div.image-1 img {
            width: 572px;
            height: 414.899px;
        }
        div.image-1 div.image-1-placeholder {
            width: 572px;
            height: 414.899px;
            background: #C6E5F3;
        }  

        div.image-2 {
            width: 572px;
            height: 414.899px;
            position: absolute;
            top: 377px;
            left: 684px;
        }
        div.image-2 img {
            width: 572px;
            height: 414.899px;
        }
        div.image-2 div.image-2-placeholder {
            width: 572px;
            height: 414.899px;
            background: #C6E5F3;
        }  

        div.image-3 {
            width: 572px;
            height: 414.899px;
            position: absolute;
            top: 377px;
            left: 1290px;
        }
        
        div.image-3 img {
            width: 572px;
            height: 414.899px;
        }

        div.image-3 div.image-3-placeholder {
            width: 572px;
            height: 414.899px;
            background: #C6E5F3;
        }

        div#text-1 {
            width: 572px;
            height: 164.564px;
            background: #C6E5F3;
            position: absolute;
            top: 820px;
            left: 75px;
        }

        div#text-2 {
            width: 572px;
            height: 164.564px;
            background: #C6E5F3;
            position: absolute;
            top: 820px;
            left: 684px;
        }

        div#text-3 {
            width: 572px;
            height: 164.564px;
            background: #C6E5F3;
            position: absolute;
            top: 820px;
            left: 1290px;
        }

        div.social-qrs-1 {
            width: 91.414px;
            height: 88.534px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1520px;
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
            left: 1640px;
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
            left: 1760px;
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
            left: 1540px;
        }
        div.social-logo-image1 svg {
            fill: #199FD4;
            width: 50.63px;
            height: 30.801px;
        }
        

        div.social-logo-image2 {
            width: 50.63px;
            height: 30.801px;
            position: absolute;
            top: 46px;
            left: 1675px;
        }
        div.social-logo-image2 svg {
            width: 50.63px;
            height: 30.801px;
            fill: #199FD4;
        }

        div.social-logo-image3 {
            width: 50.63px;
            height: 30.801px;
            position: absolute;
            top: 46px;
            left: 1780px;
        }
        div.social-logo-image3 svg {
            width: 50.63px;
            height: 30.801px;
            fill: #199FD4;
        }
        div.social-logo-image3 div.social-logo-image3-placeholder {
            width: 50.63px;
            height: 30.801px;
            background: #C6E5F3;
        }

    </style>
    
</head>
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">    
    
    <div id="workspace">
        @include('templates.components.banner', ['value' => array_get($readableComponents, 'theme') ])

        <div class="body">
            <div class="image-1">
                <div class="image-1-placeholder">
                    @include('templates.components.image', ['value' => array_get($readableComponents, 'image-1'), 'default' => 'image-1'])
                </div>
            </div>
            <div class="image-2">
                <div class="image-2-placeholder">
                    @include('templates.components.image', ['value' => array_get($readableComponents, 'image-2'), 'default' => 'image-2'])
                </div>                
            </div>            
            <div class="image-3">
                <div class="image-3-placeholder">
                    @include('templates.components.image', ['value' => array_get($readableComponents, 'image-3'), 'default' => 'image-3'])
                </div>
            </div>

            <div class="logo">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'logo'), 'default' => 'logo'])
            </div>
             <div class="title">
                <h1>@include('templates.components.text', ['value' => array_get($readableComponents, 'landing-page-title'), 'default' => 'Landing Page Title'])</h1>
            </div>
            
            <div id="text-1" style="background-color: {{ ! empty(array_get($readableComponents, 'text-1')['_value']) ? 'transparent' : '' }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text-1'), 'default' => 'Text 1'])</p>
            </div>

            <div id="text-2" style="background-color: {{ ! empty(array_get($readableComponents, 'text-2')['_value']) ? 'transparent' : '' }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text-2'), 'default' => 'Text 2'])</p>
            </div>

            <div id="text-3" style="background-color: {{ ! empty(array_get($readableComponents, 'text-3')['_value']) ? 'transparent' : '' }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text-3'), 'default' => 'Text 3'])</p>
            </div>

            <div class="social-logo-image1">
                <svg xmlns="http://www.w3.org/2000/svg" style="fill: {{ array_get($readableComponents, 'theme._value') }}" aria-labelledby="simpleicons-twitter-icon" role="img" viewBox="0 0 30 30"><title id="simpleicons-twitter-icon">Twitter icon</title><path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"/></svg>
            </div><div class="social-logo-image2">
                <svg xmlns="http://www.w3.org/2000/svg" style="fill: {{ array_get($readableComponents, 'theme._value') }}" aria-labelledby="simpleicons-instagram-icon" role="img" viewBox="0 0 30 30"><title id="simpleicons-instagram-icon">Instagram icon</title><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
            </div><div class="social-logo-image3">
                <svg xmlns="http://www.w3.org/2000/svg" style="fill: {{ array_get($readableComponents, 'theme._value') }}" aria-labelledby="simpleicons-facebook-icon" role="img" viewBox="0 0 30 30"><title id="simpleicons-facebook-icon">Facebook icon</title><path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.099 1.894-4.785 4.659-4.785 1.325 0 2.464.097 2.796.141v3.24h-1.921c-1.5 0-1.792.721-1.792 1.771v2.311h3.584l-.465 3.63H16.56V24h6.115c.733 0 1.325-.592 1.325-1.324V1.324C24 .593 23.408 0 22.676 0"/></svg>
            </div>

            <div class="social-qrs-1">
                @include('templates.components.qr', ['value' => array_get($readableComponents, 'twitter-url'), 'default' => 'social-qr', 'size' => 92])
            </div>

            <div class="social-qrs-2">
                @include('templates.components.qr', ['value' => array_get($readableComponents, 'instagram-url'), 'default' => 'social-qr', 'size' => 92])
            </div>

            <div class="social-qrs-3">
                @include('templates.components.qr', ['value' => array_get($readableComponents, 'facebook-url'), 'default' => 'social-qr', 'size' => 92])
            </div>
    </div>
</body>
</html>