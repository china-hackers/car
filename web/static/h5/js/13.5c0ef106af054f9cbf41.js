webpackJsonp([13],{Cr12:function(e,t){},XS3x:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a=r("lC5x"),s=r.n(a),n=r("J0Oq"),c=r.n(n),i={data:function(){return{qr:"",user:{}}},methods:{getUser:function(){var e=this;return c()(s.a.mark(function t(){var r,a;return s.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,e.$http.post("/mobile/user/user",{id:1});case 3:r=t.sent,a=r.data,e.user=a,t.next=11;break;case 8:t.prev=8,t.t0=t.catch(0),console.log(t.t0);case 11:case"end":return t.stop()}},t,e,[[0,8]])}))()}},created:function(){var e=this;return c()(s.a.mark(function t(){var r,a;return s.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,e.$http.post("/mobile/user/qrcode",{p:1,id:e.$route.query.id});case 3:r=t.sent,a=r.data,e.qr=a.qrcode,e.getUser(),t.next=12;break;case 9:t.prev=9,t.t0=t.catch(0),console.log(t.t0);case 12:case"end":return t.stop()}},t,e,[[0,9]])}))()}},u={render:function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"page-qr"},[r("my-nav-bar",{attrs:{title:"我的二维码"}}),r("div",{staticClass:"cont"},[r("my-avatar",{staticClass:"avatar",attrs:{src:e.user.headimgurl}}),r("div",{staticClass:"name"},[e._v(e._s(e.user.name))]),r("div",{staticClass:"usertype"},[e._v(e._s(e.user.itype)+"尊享客户")]),e._m(0),r("div",{staticClass:"qr"},[r("img",{directives:[{name:"lazy",rawName:"v-lazy",value:e.qr,expression:"qr"}]})]),r("div",{staticClass:"tips"},[e._v("识别二维码，加入I品车")])],1)],1)},staticRenderFns:[function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"desc"},[t("p",[this._v("加入I品车，更多车源更多客户")])])}]};var o=r("C7Lr")(i,u,!1,function(e){r("Cr12")},"data-v-bf2b74ae",null);t.default=o.exports}});
//# sourceMappingURL=13.5c0ef106af054f9cbf41.js.map