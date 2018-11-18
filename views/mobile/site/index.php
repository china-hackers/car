

<!DOCTYPE html>
<html>

<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>I品车</title>
    <?php if(YII_DEBUG):?>
    <?php else:?>
        <link href="/static/h5/css/app.css?<?php echo time();?>" rel="stylesheet">
    <?php endif;?>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
    <script>
        window.wxConfig = {
            debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '<?php echo @$signature['appId'];?>', // 必填，公众号的唯一标识
            timestamp: <?php echo @$signature['timestamp'];?>, // 必填，生成签名的时间戳
            nonceStr: '<?php echo @$signature['nonceStr'];?>', // 必填，生成签名的随机串
            signature: '<?php echo @$signature['signature'];?>',// 必填，签名
            headimgurl: '<?php echo @$signature['headimgurl']; ?>',
            host:'<?php echo @$signature['host'];?>'
        }
    </script>
</head>

<body module=live>
    <div id=app></div>
    <?php if(YII_DEBUG):?>
        <script type="text/javascript" src="http://localhost:9001/app.js"></script>
    <?php else:?>
        <script type="text/javascript" src="/static/h5/js/manifest.js?<?php echo time();?>"> </script>
        <script type="text/javascript" src="/static/h5/js/vendor.js?<?php echo time();?>"> </script>
        <script type="text/javascript" src="/static/h5/js/app.js?<?php echo time();?>"> </script>
    <?php endif;?>
</body>

</html>
