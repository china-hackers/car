webpackJsonp([18],{"3QXn":function(t,a,i){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var e={data:function(){return{active:0}},beforeRouteUpdate:function(t,a,i){var e=t.fullPath;e=e.replace("#","").split("?")[0],this.active={"/main/home":0,"/main/car":1,"/main/life":2,"/main/profile":3}[e]||0,i()},created:function(){var t=window.location.hash.replace("#","").split("?")[0];this.active={"/main/home":0,"/main/car":1,"/main/life":2,"/main/profile":3}[t]||0}},n={render:function(){var t=this,a=t.$createElement,i=t._self._c||a;return i("div",{staticClass:"app"},[i("router-view"),i("van-tabbar",{model:{value:t.active,callback:function(a){t.active=a},expression:"active"}},[i("van-tabbar-item",{attrs:{to:"/main/home"},scopedSlots:t._u([{key:"icon",fn:function(a){return i("i",{staticClass:"iconfont",class:{active:a.active}},[t._v("")])}}])},[t._v("首页")]),i("van-tabbar-item",{attrs:{to:"/main/car"},scopedSlots:t._u([{key:"icon",fn:function(t){return i("i",{staticClass:"iconfont icon-che",class:{active:t.active}})}}])},[t._v("i品车")]),i("van-tabbar-item",{attrs:{to:"/main/life"},scopedSlots:t._u([{key:"icon",fn:function(t){return i("i",{staticClass:"iconfont icon-cheshenghuo",class:{active:t.active}})}}])},[t._v("i品车生活")]),i("van-tabbar-item",{attrs:{to:"/main/profile"},scopedSlots:t._u([{key:"icon",fn:function(a){return i("i",{staticClass:"iconfont",class:{active:a.active}},[t._v("")])}}])},[t._v("我的")])],1)],1)},staticRenderFns:[]};var c=i("7jd7")(e,n,!1,function(t){i("Ki/B")},"data-v-1b956867",null);a.default=c.exports},"Ki/B":function(t,a){}});
//# sourceMappingURL=18.ca1d6d44518ac3ba4b32.js.map