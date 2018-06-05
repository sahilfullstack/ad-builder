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

            /*background-image: url(http://chrl.test/temp/MESA_CEC%20Landing%20Pages_1920_1080-02.jpg);
            background-size: 1920px 1080px;*/
        }

        #workspace div {
            overflow: hidden;
        }

        div.banner {
            width: 1920px;
            height: 26.758px;
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
            width: 416px;
            height: 208px;
            position: absolute;
            top: 68px;
            left: 32px;
        }

        div.logo img {
            width: 416px;
            height: 208px;
        }

        div.logo div.placeholder {
            width: 416px;
            height: 208px;
            outline: 3px dotted #CC337A;
            outline-offset: -3px;
        }

        div.logo div.placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 95px;
        }

        div.title {
            width: 902px;
            height: 70px;
            position: absolute;
            top: 220px;
            left: 490px;
            font-size: 19px;
            padding-top: 18px;
            padding-left: 7px;
            color: #29aae2;
        }
    
        div.social-qrs-1 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1420px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-2 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1540px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
        div.social-qrs-3 {
            width: 114.5px;
            height: 110.796px;
            background: #C6E5F3;
            position: absolute;
            top: 106px;
            left: 1660px;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        div.social-qrs div.social-qr {
            width: 50px;
            height: 50px;
            background: rgba(255,0,0,0.2);
        }

        div.hero-image {
            width: 800px;
            height: 430.372px;
            position: absolute;
            top: 340px;
            left: 32px;
        }
        div.hero-image img {
            width: 800px;
            height: 430.372px;
        }
        div.hero-image div.placeholder {
            width: 800px;
            height: 430.372px;
            background: #C6E5F3;
        }

        div.social-logo-image1 {
            width: 63.361px;
            height: 43.552px;
            position: absolute;
            top: 46px;
            left: 1450px;
        }

        div.social-logo-image1 svg {
            width: 63.361px;
            height: 43.552px;
            fill: #199FD4;
        }

        div.hero-video video {
            width: 308px;
            height: 246px;

        }
        div.social-logo-image1 div.social-logo-image1-placeholder {
            width: 63.361px;
            height: 43.552px;
            background: #C6E5F3;
        }

        div.social-logo-image2 {
            width: 63.361px;
            height: 43.552px;
            position: absolute;
            top: 46px;
            left: 1565px;
        }
        div.social-logo-image2 svg {
            width: 63.361px;
            height: 43.552px;
            fill: #199FD4;
        }
        div.social-logo-image2 div.social-logo-image2-placeholder {
            width: 63.361px;
            height: 43.552px;
            background: #C6E5F3;
        }

        div.social-logo-image3 {
            width: 63.361px;
            height: 43.552px;
            position: absolute;
            top: 46px;
            left: 1680px;
        }
        div.social-logo-image3 svg {
            width: 63.361px;
            height: 43.552px;
            fill: #199FD4;

        }
        div.social-logo-image3 div.social-logo-image3-placeholder {
            width: 63.361px;
            height: 43.552px;
            background: #C6E5F3;
        }

        div.hero-text {
            width: 412.146px;
            height: 334px;
            background: #C6E5F3;
            position: absolute;
            top: 437px;
            left: 842px;
        }

        div.hero-video {
            width: 638.318px;
            height: 332.065px;
            position: absolute;
            top: 437px;
            left: 1264.146px;
        }
        div.hero-video video {
            width: 638.318px;
            height: 332.065px;
        }
        div.hero-video div.placeholder {
            width: 638.318px;
            height: 332.065px;
            background: #C6E5F3;
        }

        div.timeline {
            width: 1866px;
            height: 268.812px;
            background: #C6E5F3;
            position: absolute;
            top: 800px;
            left: 32px;
        }
        div.timeline img {
            width: 1866px;
            height: 268.812px;
        }
        div.timeline div.timeline-placeholder {
            width: 1866px;
            height: 268.812px;
            background: #C6E5F3;
        }
    </style>
    
</head>
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">    
    
    <div id="workspace">
        @include('templates.components.banner', ['value' => array_get($readableComponents, 'top-border-bar') ])

        <div class="body">
            <div class="logo">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'logo'), 'default' => 'logo'])
            </div>
             <div class="title">
                <h1>@include('templates.components.text', ['value' => array_get($readableComponents, 'landing-page-title'), 'default' => 'Landing Page Title'])</h1>
            </div>

            <div class="social-logo-image1">
                <svg xmlns="http://www.w3.org/2000/svg" style="fill: {{ array_get($readableComponents, 'top-border-bar._value') }}" aria-labelledby="simpleicons-twitter-icon" role="img" viewBox="0 0 30 30"><title id="simpleicons-twitter-icon">Twitter icon</title><path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z"/></svg>
            </div><div class="social-logo-image2">
                <svg xmlns="http://www.w3.org/2000/svg" style="fill: {{ array_get($readableComponents, 'top-border-bar._value') }}" aria-labelledby="simpleicons-instagram-icon" role="img" viewBox="0 0 30 30"><title id="simpleicons-instagram-icon">Instagram icon</title><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
            </div><div class="social-logo-image3">
                <svg xmlns="http://www.w3.org/2000/svg" style="fill: {{ array_get($readableComponents, 'top-border-bar._value') }}" aria-labelledby="simpleicons-facebook-icon" role="img" viewBox="0 0 30 30"><title id="simpleicons-facebook-icon">Facebook icon</title><path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.099 1.894-4.785 4.659-4.785 1.325 0 2.464.097 2.796.141v3.24h-1.921c-1.5 0-1.792.721-1.792 1.771v2.311h3.584l-.465 3.63H16.56V24h6.115c.733 0 1.325-.592 1.325-1.324V1.324C24 .593 23.408 0 22.676 0"/></svg>
            </div>

            <div class="social-qrs-1" style="background-color: {{ empty(array_get($readableComponents, 'twitter-url')) ?: 'transparent' }}">
                @include('templates.components.qr', ['value' => array_get($readableComponents, 'twitter-url'), 'default' => 'Twitter'])
            </div>

            <div class="social-qrs-2" style="background-color: {{ empty(array_get($readableComponents, 'instagram-url')) ?: 'transparent' }}">
                @include('templates.components.qr', ['value' => array_get($readableComponents, 'instagram-url'), 'default' => 'Instagram'])
            </div>

            <div class="social-qrs-3" style="background-color: {{ empty(array_get($readableComponents, 'facebook-url')) ?: 'transparent' }}">
                @include('templates.components.qr', ['value' => array_get($readableComponents, 'facebook-url'), 'default' => 'Facebook'])
            </div>

            <div class="hero-image">
                @include('templates.components.image', ['value' => array_get($readableComponents, 'image'), 'default' => 'image'])
            </div>

            <div class="hero-text" style="background-color: {{ ! empty(array_get($readableComponents, 'text')['_value']) ? 'transparent' : '' }};">
                <p>@include('templates.components.text', ['value' => array_get($readableComponents, 'text'), 'default' => 'Text'])</p>
            </div>

            <div class="hero-video">
                @include('templates.components.video', ['value' => array_get($readableComponents, 'video'), 'default' => 'video'])
            </div>

            <style>
                .timeline {
                    position: relative;
                }
                .timeline-title {
                    position: absolute;
                    top: 20px;
                    left: 30px;
                    text-transform: uppercase;
                    font-size: 24px;
                }
                .timeline hr {
                    position: absolute;
                    top: 134.39px;
                    border: 0;
                    height: 2px;
                    width: 100%;
                    background: #199FD4;
                }
                .timeline-entry-holder {
                    display: flex;
                    justify-content: space-evenly;
                }
                .timeline-entry {
                    display: flex;
                    width: 247px;
                    height: 73px;
                    position: relative;
                    overflow: visible !important;
                }
                .timeline-pin {
                    display: block;
                    height: 43px;
                    width: 2px;
                    position: absolute;
                    background: #199FD4;
                    left: 43px;
                }
                .timeline-month,.timeline-year {
                    position: absolute;
                    text-transform: uppercase;
                    font-size: 20px;
                }
                .timeline-entry.direction-d {
                    margin-top: 170px;
                }
                .timeline-entry.direction-d .timeline-pin {
                    top: -43px;
                }
                .timeline-entry.direction-d .timeline-month {
                    top: -90px;
                }
                .timeline-entry.direction-d .timeline-year {
                    top: -70px;
                }
                .timeline-entry.direction-u {
                    margin-top: 45px;
                }
                .timeline-entry.direction-u .timeline-pin {
                    bottom: -43px;
                }
                .timeline-entry.direction-u .timeline-month {
                    bottom: -90px;
                }
                .timeline-entry.direction-u .timeline-year {
                    bottom: -70px;
                }
                .timeline-entry-description {
                    width: 160.5px;
                    height: 73px;
                    margin-right: 10px;
                    overflow: hidden;
                }
                .timeline-entry-image {
                    width: 77px;
                    height: 73px;
                }
                .timeline-entry-image img {
                    width: 77px;
                    height: 73px;
                }
            </style>
            <div class="timeline">
                <p class="timeline-title">Timeline Title</p>
                <hr>
                <div class="timeline-entry-holder">
                    <div class="timeline-entry direction-d">
                        <div class="timeline-pin"></div>
                        <div class="timeline-month">Month</div>
                        <div class="timeline-year">Year</div>
                        <div class="timeline-entry-description">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Distinctio, omnis. Aliquid quia deserunt voluptate repellendus consectetur.
                        </div>
                        <div class="timeline-entry-image">
                            <img src="http://placehold.it/77/73">
                        </div>
                    </div>
                    <div class="timeline-entry direction-u">
                        <div class="timeline-pin"></div>
                        <div class="timeline-month">Month</div>
                        <div class="timeline-year">Year</div>
                        <div class="timeline-entry-description">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Distinctio, omnis. Aliquid quia deserunt voluptate repellendus consectetur.
                        </div>
                        <div class="timeline-entry-image">
                            <img src="http://placehold.it/77/73">
                        </div>
                    </div>
                    <div class="timeline-entry direction-d">
                        <div class="timeline-pin"></div>
                        <div class="timeline-month">Month</div>
                        <div class="timeline-year">Year</div>
                        <div class="timeline-entry-description">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Distinctio, omnis. Aliquid quia deserunt voluptate repellendus consectetur.
                        </div>
                        <div class="timeline-entry-image">
                            <img src="http://placehold.it/77/73">
                        </div>
                    </div>
                    <div class="timeline-entry direction-u">
                        <div class="timeline-pin"></div>
                        <div class="timeline-month">Month</div>
                        <div class="timeline-year">Year</div>
                        <div class="timeline-entry-description">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Distinctio, omnis. Aliquid quia deserunt voluptate repellendus consectetur.
                        </div>
                        <div class="timeline-entry-image">
                            <img src="http://placehold.it/77/73">
                        </div>
                    </div>
                    <div class="timeline-entry direction-d">
                        <div class="timeline-pin"></div>
                        <div class="timeline-month">Month</div>
                        <div class="timeline-year">Year</div>
                        <div class="timeline-entry-description">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Distinctio, omnis. Aliquid quia deserunt voluptate repellendus consectetur.
                        </div>
                        <div class="timeline-entry-image">
                            <img src="http://placehold.it/77/73">
                        </div>
                    </div>
                    <div class="timeline-entry direction-u">
                        <div class="timeline-pin"></div>
                        <div class="timeline-month">Month</div>
                        <div class="timeline-year">Year</div>
                        <div class="timeline-entry-description">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Distinctio, omnis. Aliquid quia deserunt voluptate repellendus consectetur.
                        </div>
                        <div class="timeline-entry-image">
                            <img src="http://placehold.it/77/73">
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
</body>
</html>