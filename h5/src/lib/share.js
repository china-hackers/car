import router from '../router/index';
import { instance } from '../lib/http';

let wxConfig = window.wxConfig;

/* eslint-disable */
wx.config({
    ...wxConfig,
    jsApiList: [
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'updateAppMessageShareData',
        'updateTimelineShareData'
    ]
});

let userId = '';
let dataReady = false;
instance
    .post('/mobile/user/user', {
        id: 1
    })
    .then(({ data }) => {
        userId = data.id;
        dataReady = true;
        setShareData();
    });
/* eslint-disable */
function setShareData(path) {
    path = path || window.location.hash;
    console.log(path);
    if (dataReady === false) {
        return;
    }
    let shareData = {
        title: '加入I品车，更多车源更多客户',
        desc: '加入I品车，更多车源更多客户',
        imgUrl: wxConfig.headimgurl,
        success: function() {}
    };
    path = path.replace('#', '');

    if (path.indexOf('/my/qr') !== -1) {
        path = '/my/qr?id=' + userId;
    } else if (path.indexOf('/business/qr') !== -1) {
        path = '/business/qr?id=' + userId;
    }
    // if (path.indexOf('/my/qr') === -1) {
    // } else {
    //     path = '/my/qr?id=' + userId;
    // }
    path = encodeURIComponent(path);
    path = shareData.link = wxConfig.host + '?uid=' + userId + '&path=' + path;

    wx.ready(function() {
        wx.onMenuShareTimeline(shareData);
        wx.onMenuShareAppMessage(shareData);
        wx.onMenuShareQQ(shareData);
        wx.onMenuShareWeibo(shareData);
    });
}

/* eslint-disable */
router.afterEach(to => {
    // console.log('to')
    setShareData(to.path);
});
