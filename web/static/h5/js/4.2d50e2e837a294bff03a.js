webpackJsonp([4],{APCb:function(t,i){},EFKu:function(t,i){},"Hc+b":function(t,i,a){"use strict";Object.defineProperty(i,"__esModule",{value:!0});var n=a("lC5x"),e=a.n(n),s=a("J0Oq"),c=a.n(s),r={render:function(){var t=this,i=t.$createElement,a=t._self._c||i;return a("div",{staticClass:"comp-home-menu flex"},[a("div",{staticClass:"item car",on:{click:function(i){t.jump("/main/car")}}},[a("i",{staticClass:"iconfont"},[t._v("")]),a("div",{staticClass:"text"},[t._v("i 品车")])]),a("div",{staticClass:"item finance",on:{click:function(i){t.jump("/loan")}}},[a("i",{staticClass:"iconfont"},[t._v("")]),a("div",{staticClass:"text"},[t._v("i 品金融")])]),a("div",{staticClass:"item insurance",on:{click:function(i){t.jump("/safe")}}},[a("i",{staticClass:"iconfont"},[t._v("")]),a("div",{staticClass:"text"},[t._v("i 品车险")])]),a("div",{staticClass:"item life",on:{click:function(i){t.jump("/life")}}},[a("i",{staticClass:"iconfont"},[t._v("")]),a("div",{staticClass:"text"},[t._v("i 品车生活")])]),a("div",{staticClass:"item rent",on:{click:t.nofunc}},[a("i",{staticClass:"iconfont"},[t._v("")]),a("div",{staticClass:"text"},[t._v("i 品租车")])]),a("div",{staticClass:"item fix",on:{click:t.nofunc}},[a("i",{staticClass:"iconfont"},[t._v("")]),a("div",{staticClass:"text"},[t._v("i 品汽修")])])])},staticRenderFns:[]};var o=a("C7Lr")({methods:{jump:function(t){this.$router.push({path:t})},nofunc:function(){this.$dialog.alert({message:"对不起，该功能暂未开放"})}}},r,!1,function(t){a("APCb")},"data-v-02a47e37",null).exports,l={render:function(){var t=this,i=t.$createElement,a=t._self._c||i;return a("div",{staticClass:"comp-home-quick"},[a("div",{staticClass:"item",on:{click:function(i){t.jump("itype","i尊车")}}},[t._v("i尊车")]),a("div",{staticClass:"item",on:{click:function(i){t.jump("itype","i品车")}}},[t._v("i品车")]),a("div",{staticClass:"item",on:{click:function(i){t.jump("itype","i享车")}}},[t._v("i享车")]),a("div",{staticClass:"item",on:{click:function(i){t.jump("itype","i优车")}}},[t._v("i优车")]),a("div",{staticClass:"item",on:{click:function(i){t.jump("brand","大众")}}},[t._v("大众")]),a("div",{staticClass:"item",on:{click:function(i){t.jump("brand","日产")}}},[t._v("日产")]),a("div",{staticClass:"item",on:{click:function(i){t.jump("brand","捷豹")}}},[t._v("捷豹")]),a("div",{staticClass:"item",on:{click:function(i){t.jump("brand","宝马")}}},[t._v("宝马")])])},staticRenderFns:[]};var u=a("C7Lr")({methods:{jump:function(t,i){var a={};a[t]=i,this.$router.push({path:"/main/car",query:a})}}},l,!1,function(t){a("qerI")},"data-v-5cc52c32",null).exports,m=a("aA9S"),v=a.n(m),d={data:function(){return{img:"",car:[]}},created:function(){var t=this;return c()(e.a.mark(function i(){var a,n;return e.a.wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.prev=0,i.next=3,t.$http.post("/mobile/banner/recommand",{p:1});case 3:a=i.sent,n=a.data,v()(t,n),i.next=11;break;case 8:i.prev=8,i.t0=i.catch(0),console.log(i.t0);case 11:case"end":return i.stop()}},i,t,[[0,8]])}))()}},f={render:function(){var t=this,i=t.$createElement,a=t._self._c||i;return a("div",{staticClass:"comp-home-hot-car"},[a("div",{directives:[{name:"lazy",rawName:"v-lazy:background-image",value:t.img,expression:"img",arg:"background-image"}],staticClass:"top bg"}),a("div",{staticClass:"bottom flex"},t._l(t.car,function(i){return a("div",{staticClass:"item",on:{click:function(a){t.$router.push({path:i.url})}}},[a("div",{staticClass:"title"},[t._v(t._s(i.title))]),a("div",{staticClass:"type"},[t._v(t._s(i.model))]),a("div",{staticClass:"tag"},[t._v(t._s(i.keyword))]),a("div",{directives:[{name:"lazy",rawName:"v-lazy:background-image",value:i.img,expression:"item.img",arg:"background-image"}],staticClass:"img bg"})])}))])},staticRenderFns:[]};var p={components:{"home-menu":o,"home-quick":u,"home-hot-car":a("C7Lr")(d,f,!1,function(t){a("Xd8v")},"data-v-57e3a3ef",null).exports,"car-list":a("nJyc").a},data:function(){return{banner:[]}},methods:{getBanner:function(){var t=this;return c()(e.a.mark(function i(){var a,n;return e.a.wrap(function(i){for(;;)switch(i.prev=i.next){case 0:return i.prev=0,i.next=3,t.$http.post("/mobile/banner/list",{p:1});case 3:a=i.sent,n=a.data,t.banner=n.list,console.log(n),i.next=12;break;case 9:i.prev=9,i.t0=i.catch(0),console.log(i.t0);case 12:case"end":return i.stop()}},i,t,[[0,9]])}))()},handleItemClick:function(t){var i=this.banner[t];this.$router.push({path:i.url,query:{id:i.pid}})}},created:function(){this.getBanner()}},h={render:function(){var t=this.$createElement,i=this._self._c||t;return i("div",{staticClass:"page-home"},[i("my-header"),i("my-banner",{attrs:{list:this.banner},on:{"item-click":this.handleItemClick}}),i("home-menu"),i("home-quick"),i("my-box",[i("home-hot-car")],1),i("my-box",[i("my-title",{attrs:{title:"为你推荐"}}),i("car-list",{attrs:{params:{sort:"diy"}}})],1)],1)},staticRenderFns:[]};var C=a("C7Lr")(p,h,!1,function(t){a("EFKu")},"data-v-4a929f1e",null);i.default=C.exports},Xd8v:function(t,i){},qerI:function(t,i){}});
//# sourceMappingURL=4.2d50e2e837a294bff03a.js.map