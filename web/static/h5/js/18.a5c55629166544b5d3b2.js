webpackJsonp([18],{D4T5:function(e,t){},W3xj:function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=a("lC5x"),i=a.n(n),r=a("J0Oq"),s=a.n(r),c={mixins:[a("VHG+").a],data:function(){return{guide:!0,list:[]}},methods:{onRead:function(e){var t=this;return s()(i.a.mark(function a(){var n,r,s;return i.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return a.prev=0,t.loading.show("上传中..."),n=new FormData,e.length?e.forEach(function(e){n.append("UploadModel[images][]",e.file)}):n.append("UploadModel[images][]",e.file),n.append("id",t.$route.query.id),r={headers:{"Content-Type":"multipart/form-data"}},a.next=8,t.$http.post("/admin/site/productimg",n,r);case 8:s=a.sent,s.data.forEach(function(e){t.list.push({id:e[0],img:e[1]})}),a.next=16;break;case 13:a.prev=13,a.t0=a.catch(0),console.log(a.t0);case 16:t.loading.clear();case 17:case"end":return a.stop()}},a,t,[[0,13]])}))()},delItem:function(e,t){var a=this;return s()(i.a.mark(function n(){return i.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,n.next=3,a.confirm("确认删除？");case 3:return n.next=5,a.$http.post("/mobile/product/imgdelete",{img_id:e.id});case 5:a.success("删除成功"),a.list.splice(t,1),n.next=12;break;case 9:n.prev=9,n.t0=n.catch(0),console.log(n.t0);case 12:case"end":return n.stop()}},n,a,[[0,9]])}))()},preview:function(e){this.ImagePreview({images:this.list.map(function(e){return e.img}),startPosition:e})},hideGuide:function(){this.guide=!1}},created:function(){var e=this;return s()(i.a.mark(function t(){var a,n;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,e.$http.post("/mobile/product/img",{id:e.$route.query.id});case 3:a=t.sent,n=a.data,e.list=n.list,t.next=11;break;case 8:t.prev=8,t.t0=t.catch(0),console.log(t.t0);case 11:case"end":return t.stop()}},t,e,[[0,8]])}))()}},o={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"page"},[a("my-nav-bar",{attrs:{title:"车辆图片","right-icon":"info-o"},on:{"right-click":function(t){e.guide=!0}}}),a("div",{staticClass:"wrap"},[e._l(e.list,function(t,n){return a("div",{directives:[{name:"lazy",rawName:"v-lazy:background-image",value:t.img,expression:"item.img",arg:"background-image"}],staticClass:"item bg",on:{click:function(t){e.preview(n)}}},[a("van-icon",{staticClass:"icon",attrs:{name:"close"},on:{click:function(a){a.stopPropagation(),a.preventDefault(),e.delItem(t,n)}}})],1)}),a("van-uploader",{attrs:{"after-read":e.onRead,multiple:"multiple"}},[a("div",{staticClass:"item upload"},[a("van-icon",{attrs:{name:"photograph",size:"2rem"}})],1)])],2),e.guide?a("div",{staticClass:"guide",on:{click:e.hideGuide}},[a("div",{staticClass:"img bg"}),a("van-icon",{staticClass:"close",attrs:{name:"close"}})],1):e._e()],1)},staticRenderFns:[]};var u=a("C7Lr")(c,o,!1,function(e){a("D4T5")},"data-v-3847a3ea",null);t.default=u.exports}});
//# sourceMappingURL=18.a5c55629166544b5d3b2.js.map