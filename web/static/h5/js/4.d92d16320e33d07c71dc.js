webpackJsonp([4],{"+Zyi":function(t,i){},"7Sgn":function(t,i){},"Hc+b":function(t,i,n){"use strict";Object.defineProperty(i,"__esModule",{value:!0});var a=n("lC5x"),e=n.n(a),s=n("J0Oq"),c=n.n(s),r={render:function(){var t=this,i=t.$createElement,n=t._self._c||i;return n("div",{staticClass:"comp-home-menu flex"},[n("div",{staticClass:"item car",on:{click:function(i){t.jump("/main/car")}}},[n("i",{staticClass:"iconfont"},[t._v("")]),n("div",{staticClass:"text"},[t._v("i 品车")])]),n("div",{staticClass:"item finance",on:{click:function(i){t.jump("/loan")}}},[n("i",{staticClass:"iconfont"},[t._v("")]),n("div",{staticClass:"text"},[t._v("i 品金融")])]),n("div",{staticClass:"item insurance",on:{click:function(i){t.jump("/safe")}}},[n("i",{staticClass:"iconfont"},[t._v("")]),n("div",{staticClass:"text"},[t._v("i 品车险")])]),n("div",{staticClass:"item life",on:{click:function(i){t.jump("/life")}}},[n("i",{staticClass:"iconfont"},[t._v("")]),n("div",{staticClass:"text"},[t._v("i 品车生活")])]),n("div",{staticClass:"item rent",on:{click:t.nofunc}},[n("i",{staticClass:"iconfont"},[t._v("")]),n("div",{staticClass:"text"},[t._v("i 品租车")])]),n("div",{staticClass:"item fix",on:{click:t.nofunc}},[n("i",{staticClass:"iconfont"},[t._v("")]),n("div",{staticClass:"text"},[t._v("i 品汽修")])])])},staticRenderFns:[]};var o=n("C7Lr")({methods:{jump:function(t){this.$router.push({path:t})},nofunc:function(){this.$dialog.alert({message:"对不起，该功能暂未开放"})}}},r,!1,function(t){n("rlYI")},"data-v-31e42b56",null).exports,l={render:function(){var t=this,i=t.$createElement,n=t._self._c||i;return n("div",{staticClass:"comp-home-quick"},[n("div",{staticClass:"item",on:{click:function(i){t.jump("itype","i尊车")}}},[t._v("i尊车")]),n("div",{staticClass:"item",on:{click:function(i){t.jump("itype","i品车")}}},[t._v("i品车")]),n("div",{staticClass:"item",on:{click:function(i){t.jump("itype","i享车")}}},[t._v("i享车")]),n("div",{staticClass:"item",on:{click:function(i){t.jump("itype","i优车")}}},[t._v("i优车")]),n("div",{staticClass:"item",on:{click:function(i){t.jump("brand","大众")}}},[t._v("大众")]),n("div",{staticClass:"item",on:{click:function(i){t.jump("brand","日产")}}},[t._v("日产")]),n("div",{staticClass:"item",on:{click:function(i){t.jump("brand","捷豹")}}},[t._v("捷豹")]),n("div",{staticClass:"item",on:{click:function(i){t.jump("brand","宝马")}}},[t._v("宝马")])])},staticRenderFns:[]};var u=n("C7Lr")({methods:{jump:function(t,i){var n={};n[t]=i,this.$router.push({path:"/main/car",query:n})}}},l,!1,function(t){n("+Zyi")},"data-v-1e58e638",null).exports,m=n("aA9S"),v=n.n(m),d={data:function(){return{img:"",car:[]}},created:function(){var t=this;return c()(e.a.mark(function i(){var n,a;return e.a.wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.prev=0,i.next=3,t.$http.post("/mobile/banner/recommand",{p:1});case 3:n=i.sent,a=n.data,v()(t,a),i.next=11;break;case 8:i.prev=8,i.t0=i.catch(0),console.log(i.t0);case 11:case"end":return i.stop()}},i,t,[[0,8]])}))()}},f={render:function(){var t=this,i=t.$createElement,n=t._self._c||i;return n("div",{staticClass:"comp-home-hot-car"},[n("div",{directives:[{name:"lazy",rawName:"v-lazy:background-image",value:t.img,expression:"img",arg:"background-image"}],staticClass:"top bg"}),n("div",{staticClass:"bottom flex"},t._l(t.car,function(i){return n("div",{staticClass:"item",on:{click:function(n){t.$router.push({path:i.url})}}},[n("div",{staticClass:"title"},[t._v(t._s(i.title))]),n("div",{staticClass:"type"},[t._v(t._s(i.model))]),n("div",{staticClass:"tag"},[t._v(t._s(i.keyword))]),n("div",{directives:[{name:"lazy",rawName:"v-lazy:background-image",value:i.img,expression:"item.img",arg:"background-image"}],staticClass:"img bg"})])}))])},staticRenderFns:[]};var p={components:{"home-menu":o,"home-quick":u,"home-hot-car":n("C7Lr")(d,f,!1,function(t){n("LzsD")},"data-v-3361879d",null).exports,"car-list":n("nJyc").a},data:function(){return{banner:[]}},methods:{getBanner:function(){var t=this;return c()(e.a.mark(function i(){var n,a;return e.a.wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.prev=0,i.next=3,t.$http.post("/mobile/banner/list",{p:1});case 3:n=i.sent,a=n.data,t.banner=a.list,console.log(a),i.next=12;break;case 9:i.prev=9,i.t0=i.catch(0),console.log(i.t0);case 12:case"end":return i.stop()}},i,t,[[0,9]])}))()},handleItemClick:function(t){var i=this.banner[t];this.$router.push({path:i.url,query:{id:i.pid}})}},created:function(){this.getBanner()}},h={render:function(){var t=this.$createElement,i=this._self._c||t;return i("div",{staticClass:"page-home"},[i("my-header"),i("my-banner",{attrs:{list:this.banner},on:{"item-click":this.handleItemClick}}),i("home-menu"),i("home-quick"),i("my-box",[i("home-hot-car")],1),i("my-box",[i("my-title",{attrs:{title:"为你推荐"}}),i("car-list",{attrs:{params:{sort:"diy"}}})],1)],1)},staticRenderFns:[]};var C=n("C7Lr")(p,h,!1,function(t){n("7Sgn")},"data-v-34b9dca5",null);i.default=C.exports},LzsD:function(t,i){},rlYI:function(t,i){}});
//# sourceMappingURL=4.d92d16320e33d07c71dc.js.map