<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>H5游戏分享测试</title>
    <link rel="icon" type="image/GIF" href="res/favicon.ico"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="full-screen" content="yes"/>
    <meta name="screen-orientation" content="portrait"/>
    <meta name="x5-fullscreen" content="true"/>
    <meta name="360-fullscreen" content="true"/>
    <style>
        body, canvas, div {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            -khtml-user-select: none;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }
    </style>
</head>
<body style="padding:0; margin: 0; background: #000;">
<script src="res/loading.js"></script>
<canvas id="gameCanvas" width="480" height="720"></canvas>

<script cocos src="game.min.js"></script>
<!-- <script type="text/javascript">
    if(/MicroMessenger/.test(window.navigator.userAgent)){
        var script1 =  document.createElement('script');
        var script2 =  document.createElement('script');
        script1.setAttribute('cocos', "");
        script1.setAttribute('src', "game.min.js")
        script2.setAttribute('src', "res/loading.js")
        document.body.appendChild(script2);
        document.body.appendChild(script1);
    }else{
        alert('请在微信浏览器中打开~~~')
    }
</script> -->



<!-- 加载微信JS-SDK  在加载之前要先绑定绑定域名 ，先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”-->
<!-- JSSDK说明文档 http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html#.E9.99.84.E5.BD.957-.E9.97.AE.E9.A2.98.E5.8F.8D.E9.A6.88-->
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    <?php
    //引入 jssdk.php 注 在同一级下面还有另外2个文件 access_token.json jsapi_ticket.json 新部署的是请降这里面的内容清空 如果懂得PHP可以自己写个方法替换这个2文件，他们只是用来保存一些临时数据
    require_once "./jssdk.php";
    //配置微信的 AppID(应用ID)AppSecret(应用密钥) 登录微信公众号后台 点击右边的菜单 “开发者中心” 就能看到这2个值 。 上线后请配置自己的应用ID和应用密钥
    $appID = "wx1ccb336d8614a753"; 
    $appSecret = "d4624c36b6795d1d99dcf0547af5443d";
    $jssdk = new JSSDK($appID, $appSecret);
    $signPackage = $jssdk->GetSignPackage();
    $dm = 'http://'.$_SERVER['SERVER_NAME'].'/';
    ?>
    var dm = '<?php echo $dm;?>';
    //加载jssdk       
    wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"]; ?>',
        timestamp: <?php echo $signPackage["timestamp"]; ?>,
        nonceStr: '<?php echo $signPackage["nonceStr"]; ?>',
        signature: '<?php echo $signPackage["signature"]; ?>',
        jsApiList: [
            'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage'
        ]
    });
    //分享的基础配置 要写不写这个都可以
    var wxCustomConfig = {
        title: '',//分享标题
        desc: '',//分享描述
        link: dm, //分享链接
        imgUrl:  dm+'fx.png'//分享图片
    }

    wx.ready(function () {
        //分享到朋友
        wx.onMenuShareAppMessage({
            title: wxCustomConfig.title,
            desc: wxCustomConfig.desc,
            link: wxCustomConfig.link,
            imgUrl: wxCustomConfig.imgUrl,
            //  当微信用户点击微信右上角的分享的时候触发的方法  onMenuShareAppMessage中已经废除
            trigger: function (res) {
                //获取localStorage存储的最高分数
                this.title = 'H5游戏分享测试';
            }
        });
        //分享到朋友圈  注：分享到朋友圈没有描述
        wx.onMenuShareTimeline({
            title:'',
            link: dm, //分享链接
            imgUrl: dm+'fx.png', //分享图片
            // 当微信用户点击微信右上角的分享的时候触发的方法 
            trigger: function (res) {
                //获取localStorage存储的最高分数
                //重新赋值标题 修改本次分享的标题
                this.title = 'H5游戏分享测试';
            }
        });
    });
</script>    
</body>
</html>
