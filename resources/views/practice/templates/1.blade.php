<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Template 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <style>
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
        }

        div.banner {
            width: 960px;
            height: 10px;
            background: #199FD4;
        }

        div.sidebar {
            width: 310px;
            float: left;
            height: 540px;
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
            width: 207.5px;
            height: 182.5px;
            margin: 70px auto 30px;
        }

        div.sidebar div.logo img {
            width: 207.5px;
            height: 182.5px;
        }

        div.sidebar div.logo div.logo-placeholder {
            width: 207.5px;
            height: 182.5px;
            outline: 3px dotted #CC337A;
        }

        div.sidebar div.logo div.logo-placeholder p {
            color: #CC337A;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            padding-top: 75px;
        }
        
        div.sidebar div.quote {
            width: 257.5px;
            height: 50px;
            background: #199FD4;
            margin: 0 auto 30px;
        }
        
        div.sidebar div.text {
            width: 232.5px;
            height: 122.5px;
            background: #C6E5F3;
            margin: 0 auto;
        }

        div.hero-image {
            margin-left: 250px;
            height: 540px;
        }

        div.hero-image img {
            width: 650px;
            height: 530px;
        }

        div.hero-image div.hero-image-placeholder {
            margin-left: 250px;
            height: 540px;
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
            <div class="sidebar">
                <p class="category-header">HEALTH</p>

                <div class="logo">
                    @if(empty($unit->components['logo']))
                        <div class="logo-placeholder">
                            <p>LOGO</p>
                        </div>
                    @else
                        <img src="{{ $unit->components['logo'] }}" alt="Logo">
                    @endif
                </div>

                <div class="quote">
                    @if(empty($unit->components['quote-text']))
                        <p>Quote</p>
                    @else
                        <p>{{ $unit->components['quote-text'] }}</p>
                    @endif
                </div>

                <div class="text">
                    @if(empty($unit->components['text']))
                        <p>Text</p>
                    @else
                        <p>{{ $unit->components['text'] }}</p>
                    @endif
                </div>
            </div>
    
            <div class="hero-image">
                @if(empty($unit->components['hero-image']))
                    <div class="hero-image-placeholder">
                        Hero Image
                    </div>
                @else
                    <img src="{{ $unit->components['hero-image'] }}" alt="Logo">
                @endif
            </div>

        </div>
        <!-- Empty -->
        <!-- <p class="null-state">Workspace</p> -->
    </div>
</body>
</html>