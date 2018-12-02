<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>I品车</title>
</head>

<body>
    <div class="page-qr">

        <div class="cont">
            <div class="comp-avatar avatar">
                <div class="img bg" data-src="/logo.png"
                    lazy="loaded" style="background-image: url(&quot;/logo.png&quot;);"></div>
            </div>
            <div class="name">i品车微信公众号</div>
            <div class="usertype">i品车尊享客户</div>
            <div class="desc">
                <p>加入I品车，更多车源更多客户</p>
            </div>
            <div class="qr"><img data-src="/qrcode.jpg" src="/qrcode.jpg"
                    lazy="error"></div>
            <div class="tips">识别二维码，加入I品车</div>
        </div>
    </div>
    <script>
        document.querySelector('html').style.fontSize =
            document.documentElement.offsetWidth / 25 + 'px';
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .page-qr {
            height: 100vh;
            overflow: hidden;
            background-color: #f18036;
        }

        .page-qr .cont {
            margin: 4rem 1rem 0;
            background-color: #fff;
            border-radius: 0.27rem;
            padding: 1rem 1rem 4rem 1rem;
            text-align: center;
            position: relative;
        }

        .page-qr .cont .avatar {
            position: absolute;
            left: 9.5rem;
            top: -2rem;
        }

        .page-qr .cont .name {
            color: #f18036;
            padding-top: 2rem;
            font-size: 1.2rem;
            line-height: 100%;
        }

        .page-qr .cont .usertype {
            color: #999;
            padding: 1rem 0;
            font-weight: bold;
        }

        .page-qr .cont .desc {
            color: #999;
            font-size: 0.87rem;
            line-height: 1.5rem;
        }

        .page-qr .cont .qr {
            padding: 1rem 0;
        }

        .page-qr .cont .qr img {
            margin: 0 auto;
            display: block;
            width: 10rem;
            height: 10rem;
            background-color: #ccc;
        }


        .comp-avatar {
            width: 4rem;
            height: 4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border-radius: 50%;
            border: 1px solid #eee;
            overflow: hidden;
        }

        .comp-avatar .icon {
            font-size: 2rem;
            color: #ccc;
        }

        .comp-avatar .img {
            width: 100%;
            height: 100%;
        }
    </style>
</body>

</html>