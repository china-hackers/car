webpackJsonp([11],{"94Ro":function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=a("5/aF"),r=a.n(n),i=a("Z34F"),o=a.n(i),l=a("0wMN"),c=a("CPGk"),s={mixins:[l.a],data:function(){return{list:[],name:"",loading:!1}},methods:{jumpToCarDetail:function(e){this.$router.push({path:"/car/edit",query:{id:e.pid}})},viewNotes:function(e){var t=this.$refs["my-note-editor"];t.setId(e.id),t.open()},research:function(){this.pagination.curPage=1,this.list=[],this.getList()},getList:function(){var e=this;return o()(r.a.mark(function t(){var a,n;return r.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,e.$http.post("/admin/finance/buylist",{p:e.pagination.curPage,name:e.name});case 3:a=t.sent,n=a.data,e.list=n.data.list,e.pagination.pageTotal=n.data.total,t.next=12;break;case 9:t.prev=9,t.t0=t.catch(0),console.log(t.t0);case 12:case"end":return t.stop()}},t,e,[[0,9]])}))()},formatDate:function(e){return Object(c.a)(e)},deal:function(e){var t=this;return o()(r.a.mark(function a(){return r.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return a.prev=0,a.next=3,t.$confirm("确认提交");case 3:return a.next=5,t.$http.post("/admin/finance/buycheck",{id:e.id});case 5:t.success("提交成功"),t.getList(),a.next=12;break;case 9:a.prev=9,a.t0=a.catch(0),console.log(a.t0);case 12:case"end":return a.stop()}},a,t,[[0,9]])}))()},appoint:function(e){var t=this;return o()(r.a.mark(function a(){return r.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return a.prev=0,a.next=3,t.$http.post("/admin/finance/saler2user",{id:e.id});case 3:t.success("分配成功"),t.getList(),a.next=10;break;case 7:a.prev=7,a.t0=a.catch(0),console.log(a.t0);case 10:case"end":return a.stop()}},a,t,[[0,7]])}))()}},created:function(){this.getList()}},u={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"page-car-rent"},[a("my-page-title",{attrs:{title:"I品车订单"}}),a("div",{staticClass:"bar"},[a("el-form",{attrs:{inline:!0},nativeOn:{click:function(e){e.preventDefault()}}},[a("el-form-item",[a("el-input",{attrs:{placeholder:"请输入搜索信息"},model:{value:e.name,callback:function(t){e.name=t},expression:"name"}})],1),a("el-form-item",[a("my-button",{attrs:{type:"primary",loading:e.loading,click:e.research}},[e._v("搜索")])],1)],1)],1),a("div",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}],staticClass:"content"},[a("el-table",{staticStyle:{width:"100%"},attrs:{data:e.list,border:"border"}},[a("el-table-column",{attrs:{align:"center",type:"index"}}),a("el-table-column",{attrs:{align:"center",label:"意向车辆",prop:"pid"}}),a("el-table-column",{attrs:{align:"center",label:"姓名",prop:"name"}}),a("el-table-column",{attrs:{align:"center",label:"电话",prop:"phone"}}),a("el-table-column",{attrs:{align:"center",label:"填表时间",prop:"created"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v(e._s(e.formatDate(new Date(1e3*t.row.created))))]}}])}),a("el-table-column",{attrs:{align:"center",label:"指定销售",prop:"saler_id"}}),a("el-table-column",{attrs:{align:"center",label:"是否成交",prop:""},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v(e._s(1===t.row.is_deal?"已成交":"未成交"))]}}])}),a("el-table-column",{attrs:{align:"center",label:"成交车辆",prop:""}}),a("el-table-column",{attrs:{align:"center",label:"成交金额",prop:""}}),a("el-table-column",{attrs:{align:"center",label:"操作",prop:""},scopedSlots:e._u([{key:"default",fn:function(t){return[a("el-button",{attrs:{type:"text"},on:{click:function(a){e.viewNotes(t.row)}}},[e._v("备注")]),a("el-button",{attrs:{type:"text"},on:{click:function(a){e.jumpToCarDetail(t.row)}}},[e._v("车辆信息")]),1!==t.row.is_deal?a("el-button",{attrs:{type:"text"},on:{click:function(a){e.appoint(t.row)}}},[e._v("分配销售")]):e._e()]}}])})],1),a("div",{staticClass:"pager"},[a("el-pagination",{attrs:{"page-sizes":[20],layout:"total,slot,prev,pager,next","current-page":e.pagination.curPage,"page-size":e.pagination.pageSize,total:e.pagination.pageTotal},on:{"update:currentPage":function(t){e.$set(e.pagination,"curPage",t)},"current-change":e.pageCurPageChange,"size-change":e.pageSizeChange}})],1)],1),a("my-note-editor",{ref:"my-note-editor",attrs:{"list-url":"/mobile/finance/buylogs","add-url":"/admin/finance/buylog","post-key":"bid"}})],1)},staticRenderFns:[]};var p=a("7jd7")(s,u,!1,function(e){a("e3HP")},"data-v-343ca4b0",null);t.default=p.exports},e3HP:function(e,t){}});
//# sourceMappingURL=11.4e0908fc9f6850cbee55.js.map