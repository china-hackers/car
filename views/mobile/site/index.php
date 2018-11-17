

<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>I品车</title>
    <?php if(YII_DEBUG):?>
    <?php else:?>
        <link href="/static/h5/css/app.css" rel="stylesheet">
    <?php endif;?>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
    <script>
        window.wxConfog = {

        }
    </script>
</head>

<body module=live>
    <div id=app></div>
    <?php if(YII_DEBUG):?>
        <script type="text/javascript" src="http://localhost:9001/app.js"></script>
    <?php else:?>
        <script type="text/javascript" src="/static/h5/js/manifest.js"> </script>
        <script type="text/javascript" src="/static/h5/js/vendor.js"> </script>
        <script type="text/javascript" src="/static/h5/js/app.js"> </script>
    <?php endif;?>
</body>

</html>
