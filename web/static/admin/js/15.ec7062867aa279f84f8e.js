webpackJsonp([15],{cSxv:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var n=a("5/aF"),i=a.n(n),r=a("Z34F"),l=a.n(r),o=a("0wMN"),s=a("OQXt"),c=a("CPGk"),u={mixins:[o.a,s.a],data:function(){return{list:[],name:"",loading:!1}},methods:{viewNotes:function(t){var e=this.$refs["my-note-editor"];e.setId(t.id),e.open()},research:function(){this.pagination.curPage=1,this.list=[],this.getList()},formatDate:function(t){return Object(c.a)(t)},getList:function(){var t=this;return l()(i.a.mark(function e(){var a,n;return i.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/finance/safelist",{p:t.pagination.curPage,name:t.name,state:4});case 3:a=e.sent,n=a.data,t.list=n.data.list,t.pagination.pageTotal=n.data.total,e.next=12;break;case 9:e.prev=9,e.t0=e.catch(0),console.log(e.t0);case 12:case"end":return e.stop()}},e,t,[[0,9]])}))()}},created:function(){this.getList()}},p={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"page-employee"},[a("my-page-title",{attrs:{title:"I品车险已成交"}}),a("div",{staticClass:"bar"},[a("el-form",{attrs:{inline:!0},nativeOn:{click:function(t){t.preventDefault()}}},[a("el-form-item",[a("el-input",{attrs:{placeholder:"请输入姓名"},model:{value:t.name,callback:function(e){t.name=e},expression:"name"}})],1),a("el-form-item",[a("my-button",{attrs:{type:"primary",loading:t.loading,click:t.research}},[t._v("搜索")])],1)],1)],1),a("div",{directives:[{name:"loading",rawName:"v-loading",value:t.loading,expression:"loading"}],staticClass:"content"},[a("el-table",{staticStyle:{width:"100%"},attrs:{data:t.list,border:"border"}},[a("el-table-column",{attrs:{align:"center",type:"index"}}),a("el-table-column",{attrs:{align:"center",label:"成交姓名",prop:"d_name"}}),a("el-table-column",{attrs:{align:"center",label:"成交电话",prop:"d_phone"}}),a("el-table-column",{attrs:{align:"center",label:"成交车牌号",prop:"d_car_no"}}),a("el-table-column",{attrs:{align:"center",label:"交强险到期时间",prop:"d_j_outdate"}}),a("el-table-column",{attrs:{align:"center",label:"商业险到期时间",prop:"d_s_outdate"}}),a("el-table-column",{attrs:{align:"center",label:"车险总价(元)",prop:"d_price"}}),a("el-table-column",{attrs:{align:"center",label:"操作",prop:""},scopedSlots:t._u([{key:"default",fn:function(e){return[a("el-button",{attrs:{type:"text"},on:{click:function(a){t.viewNotes(e.row)}}},[t._v("备注")]),4!==e.row.state?a("el-button",{attrs:{type:"text"},on:{click:function(a){t.changeStatus(e)}}},[t._v("修改状态")]):t._e(),a("el-button",{attrs:{type:"text"},on:{click:function(a){t.deal(e.row)}}},[t._v("修改")])]}}])})],1),a("div",{staticClass:"pager"},[a("el-pagination",{attrs:{"page-sizes":[20],layout:"total,slot,prev,pager,next","current-page":t.pagination.curPage,"page-size":t.pagination.pageSize,total:t.pagination.pageTotal},on:{"update:currentPage":function(e){t.$set(t.pagination,"curPage",e)},"current-change":t.pageCurPageChange,"size-change":t.pageSizeChange}})],1)],1),a("my-note-editor",{ref:"my-note-editor",attrs:{"list-url":"/mobile/finance/safelogs","add-url":"/admin/finance/safelog","post-key":"sid"}}),a("status-editor",{ref:"status-editor",attrs:{ftype:"safe"},on:{change:t.getList}}),a("insurance-dealer",{ref:"dealer-editor",on:{success:t.getList}})],1)},staticRenderFns:[]};var d=a("7jd7")(u,p,!1,function(t){a("dpUg")},"data-v-20739e35",null);e.default=d.exports},dpUg:function(t,e){}});
//# sourceMappingURL=15.ec7062867aa279f84f8e.js.map