webpackJsonp([3],{"BU+f":function(t,e){},Vssz:function(t,e){},X9fc:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=a("lC5x"),r=a.n(n),s=a("4YfN"),c=a.n(s),i=a("J0Oq"),o=a.n(i),l=a("0wMN"),u=a("gC1q"),p={mixins:[l.a],data:function(){return{list:[],loading:!1,filter:{}}},components:{"my-car-filter":u.a},methods:{getState:function(t){return{0:"已上架",1:"已下架",2:"已售"}[t]},newCar:function(){this.$router.push({path:"/car/add"})},startSearch:function(t){this.pagination.curPage=1,this.filter=t,this.req()},req:function(){var t=this;return o()(r.a.mark(function e(){var a,n;return r.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/product/list",c()({p:t.pagination.curPage},t.filter));case 3:a=e.sent,n=a.data,t.list=n.data.list,t.pagination.pageTotal=n.data.total,e.next=12;break;case 9:e.prev=9,e.t0=e.catch(0),console.log(e.t0);case 12:case"end":return e.stop()}},e,t,[[0,9]])}))()},jumpToEdit:function(t){this.$router.push({path:"/car/edit",query:{id:t.id}})},pass:function(t){var e=this;return o()(r.a.mark(function a(){return r.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return a.prev=0,a.next=3,e.$confirm("确认审核通过该车辆");case 3:return a.next=5,e.$http.post("/admin/product/check",{id:t.id});case 5:e.success("审核成功"),e.req(),a.next=12;break;case 9:a.prev=9,a.t0=a.catch(0),console.log(a.t0);case 12:case"end":return a.stop()}},a,e,[[0,9]])}))()},unpass:function(t){var e=this;return o()(r.a.mark(function a(){return r.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return a.prev=0,a.next=3,e.$confirm("确认下架该车辆");case 3:return a.next=5,e.$http.post("/admin/product/close",{id:t.id});case 5:e.success("下架成功"),e.req(),a.next=12;break;case 9:a.prev=9,a.t0=a.catch(0),console.log(a.t0);case 12:case"end":return a.stop()}},a,e,[[0,9]])}))()},del:function(t){var e=this;return o()(r.a.mark(function a(){return r.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return a.prev=0,a.next=3,e.$confirm("确认删除该车辆");case 3:return a.next=5,e.$http.post("/admin/product/delete",{id:t.id});case 5:e.success("删除成功"),e.req(),a.next=12;break;case 9:a.prev=9,a.t0=a.catch(0),console.log(a.t0);case 12:case"end":return a.stop()}},a,e,[[0,9]])}))()}}},d={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"page-second-hand-car"},[a("my-page-title",{attrs:{title:"I品二手车"}}),a("my-car-filter",{on:{"new-car":t.newCar,"start-search":t.startSearch}}),a("div",{directives:[{name:"loading",rawName:"v-loading",value:t.loading,expression:"loading"}],staticClass:"content"},[a("el-table",{staticStyle:{width:"100%"},attrs:{data:t.list,border:"border"}},[a("el-table-column",{attrs:{align:"center",type:"index"}}),a("el-table-column",{attrs:{align:"center",label:"车行名称",prop:"business_name"}}),a("el-table-column",{attrs:{align:"center",label:"标题",prop:"title"}}),a("el-table-column",{attrs:{align:"center",label:"卖价(万)",prop:"price"}}),a("el-table-column",{attrs:{align:"center",label:"新车价(万)",prop:"price_new"}}),a("el-table-column",{attrs:{align:"center",label:"上牌时间",prop:"reg_date"}}),a("el-table-column",{attrs:{align:"center",label:"行驶里程(km)",prop:"km"}}),a("el-table-column",{attrs:{align:"center",label:"归属地",prop:"city"}}),a("el-table-column",{attrs:{align:"center",label:"状态",prop:"state"},scopedSlots:t._u([{key:"default",fn:function(e){return[t._v(t._s(t.getState(e.row.state)))]}}])}),a("el-table-column",{attrs:{align:"center",label:"链接",prop:""},scopedSlots:t._u([{key:"default",fn:function(e){return[t._v(t._s("/car/detail?id="+e.row.id))]}}])}),a("el-table-column",{attrs:{align:"center",label:"操作",prop:""},scopedSlots:t._u([{key:"default",fn:function(e){return 2!==e.row.state?[a("el-button",{attrs:{type:"text"},on:{click:function(a){t.jumpToEdit(e.row)}}},[t._v("修改")]),0!==e.row.state?a("el-button",{attrs:{type:"text"},on:{click:function(a){t.pass(e.row)}}},[t._v("审核")]):t._e(),0===e.row.state?a("el-button",{attrs:{type:"text"},on:{click:function(a){t.unpass(e.row)}}},[t._v("下架")]):t._e(),a("el-button",{attrs:{type:"text"},on:{click:function(a){t.del(e.row)}}},[t._v("删除")])]:void 0}}])})],1),a("div",{staticClass:"pager"},[a("el-pagination",{attrs:{"page-sizes":[20],layout:"total,slot,prev,pager,next","current-page":t.pagination.curPage,"page-size":t.pagination.pageSize,total:t.pagination.pageTotal},on:{"update:currentPage":function(e){t.$set(t.pagination,"curPage",e)},"current-change":t.pageCurPageChange,"size-change":t.pageSizeChange}})],1)],1)],1)},staticRenderFns:[]};var h=a("C7Lr")(p,d,!1,function(t){a("Vssz")},"data-v-f7a61fd8",null);e.default=h.exports},gC1q:function(t,e,a){"use strict";var n=a("lC5x"),r=a.n(n),s=a("J0Oq"),c=a.n(s),i={data:function(){return{choosedLetter:"",letterList:[],choosedBrand:"",brandList:[],typeList:[],choosedTypeId:"",business_name:"",price_from:0,price_to:0}},methods:{getLetterList:function(){var t=this;return c()(r.a.mark(function e(){var a,n;return r.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/letterlist",{p:1});case 3:return a=e.sent,n=a.data,t.letterList=n.data.list,e.next=8,t.chooseLetter("");case 8:e.next=13;break;case 10:e.prev=10,e.t0=e.catch(0),console.log(e.t0);case 13:case"end":return e.stop()}},e,t,[[0,10]])}))()},chooseLetter:function(t){var e=this;return c()(r.a.mark(function a(){return r.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return e.choosedLetter=t,e.choosedTypeId="",a.next=4,e.getBrandList();case 4:case"end":return a.stop()}},a,e)}))()},getBrandList:function(){var t=this;return c()(r.a.mark(function e(){var a,n;return r.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/brandlist",{letter:t.choosedLetter,p:1});case 3:return a=e.sent,n=a.data,t.brandList=n.data.list,e.next=8,t.chooseBrand("");case 8:e.next=13;break;case 10:e.prev=10,e.t0=e.catch(0),console.log(e.t0);case 13:case"end":return e.stop()}},e,t,[[0,10]])}))()},chooseBrand:function(t){var e=this;return c()(r.a.mark(function a(){return r.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:if(e.choosedBrand=t,""===t){a.next=4;break}return a.next=4,e.getTypeList();case 4:e.choosedTypeId="";case 5:case"end":return a.stop()}},a,e)}))()},getTypeList:function(){var t=this;return c()(r.a.mark(function e(){var a,n;return r.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/modellist",{brand:t.choosedBrand});case 3:a=e.sent,n=a.data,t.typeList=n.data.list,console.log(n),e.next=12;break;case 9:e.prev=9,e.t0=e.catch(0),console.log(e.t0);case 12:case"end":return e.stop()}},e,t,[[0,9]])}))()},chooseType:function(t){this.choosedTypeId=t},newCar:function(){this.$emit("new-car")},startSearch:function(){this.$emit("start-search",{letter:this.choosedLetter,brand:this.choosedBrand,car_id:this.choosedTypeId,price_from:this.price_from,price_to:this.price_to,business_name:this.business_name})}},created:function(){var t=this;return c()(r.a.mark(function e(){return r.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.getLetterList();case 2:t.startSearch();case 3:case"end":return e.stop()}},e,t)}))()}},o={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"comp-car-filter"},[a("div",{staticClass:"item"},[a("label",[t._v("首字母")]),a("div",{staticClass:"right"},[a("div",{staticClass:"choose-item",class:{choosed:""==t.choosedLetter},on:{click:function(e){t.chooseLetter("")}}},[t._v("不限")]),t._l(t.letterList,function(e){return a("div",{staticClass:"choose-item",class:{choosed:e==t.choosedLetter},on:{click:function(a){t.chooseLetter(e)}}},[t._v(t._s(e))])})],2)]),a("div",{staticClass:"item"},[a("label",[t._v("品牌")]),a("div",{staticClass:"right"},[a("div",{staticClass:"choose-item",class:{choosed:""==t.choosedBrand},on:{click:function(e){t.chooseBrand("")}}},[t._v("不限")]),t._l(t.brandList,function(e){return a("div",{staticClass:"choose-item",class:{choosed:e.brand==t.choosedBrand},on:{click:function(a){t.chooseBrand(e.brand)}}},[t._v(t._s(e.brand))])})],2)]),a("div",{staticClass:"item"},[a("label",[t._v("车型")]),a("div",{staticClass:"right"},[a("div",{staticClass:"choose-item",class:{choosed:""==t.choosedTypeId},on:{click:function(e){t.chooseType("")}}},[t._v("不限")]),t._l(t.typeList,function(e){return a("div",{staticClass:"choose-item",class:{choosed:e.id==t.choosedTypeId},on:{click:function(a){t.chooseType(e.id)}}},[t._v(t._s(e.model))])})],2)]),a("div",{staticClass:"item"},[a("label",[t._v("价格")]),a("div",{staticClass:"right"},[a("div",{staticClass:"my-define"},[a("el-input-number",{attrs:{size:"small",min:0,"controls-position":"right",precision:2,step:.01,placeholder:"万元"},model:{value:t.price_from,callback:function(e){t.price_from=e},expression:"price_from"}}),a("div",{staticClass:"space"},[t._v("-")]),a("el-input-number",{attrs:{size:"small",min:0,"controls-position":"right",precision:2,step:.01,placeholder:"万元"},model:{value:t.price_to,callback:function(e){t.price_to=e},expression:"price_to"}})],1)])]),a("div",{staticClass:"item"},[a("label",[t._v("车行名称")]),a("div",{staticClass:"right"},[a("div",{staticClass:"my-define"},[a("el-input",{staticClass:"text",attrs:{size:"small"},model:{value:t.business_name,callback:function(e){t.business_name=e},expression:"business_name"}})],1)])]),a("div",{staticClass:"item"},[a("label"),a("div",{staticClass:"right"},[a("el-button",{attrs:{type:"primary"},on:{click:t.startSearch}},[t._v("开始搜索")])],1)])])},staticRenderFns:[]};var l=a("C7Lr")(i,o,!1,function(t){a("BU+f")},"data-v-3dc67b5c",null);e.a=l.exports}});
//# sourceMappingURL=3.d60b03a293f8366e734b.js.map