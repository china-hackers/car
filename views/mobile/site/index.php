

<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <meta name=viewport content="width=device-width,initial-scale=1">
    <title>ayk-admin</title>
    <?php if(YII_DEBUG):?>
    <?php else:?>
        <link href="/static/h5/css/app.css" rel="stylesheet">
    <?php endif;?>
    
</head>

<body module=live>
    <div id=app></div>
    <?php if(YII_DEBUG):?>
        <script type="text/javascript" src="http://localhost:8090/app.js"></script>
    <?php else:?>
        <script type="text/javascript" src="/static/h5/js/manifest.js"> </script>
        <script type="text/javascript" src="/static/h5/js/vendor.js"> </script>
        <script type="text/javascript" src="/static/h5/js/app.js"> </script>
    <?php endif;?>
</body>

</html>
