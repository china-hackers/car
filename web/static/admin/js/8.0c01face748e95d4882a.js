webpackJsonp([8],{AVyY:function(e,t){},"Y41/":function(e,t,a){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=a("5/aF"),r=a.n(n),i=a("Z34F"),l=a.n(i),o=a("0wMN"),s=a("CPGk"),c={mixins:[o.a],data:function(){return{list:[],name:"",loading:!1}},methods:{viewNotes:function(e){var t=this.$refs["my-note-editor"];t.setId(e.id),t.open()},research:function(){this.pagination.curPage=1,this.list=[],this.getList()},formatDate:function(e){return Object(s.a)(e)},getList:function(){var e=this;return l()(r.a.mark(function t(){var a,n;return r.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,e.$http.post("/admin/finance/safelist",{p:e.pagination.curPage,name:e.name});case 3:a=t.sent,n=a.data,e.list=n.data.list,e.pagination.pageTotal=n.data.total,t.next=12;break;case 9:t.prev=9,t.t0=t.catch(0),console.log(t.t0);case 12:case"end":return t.stop()}},t,e,[[0,9]])}))()},deal:function(e){var t=this;return l()(r.a.mark(function a(){return r.a.wrap(function(a){for(;;)switch(a.prev=a.next){case 0:return a.prev=0,a.next=3,t.$confirm("确认提交");case 3:return a.next=5,t.$http.post("/admin/finance/safecheck",{id:e.id});case 5:t.success("提交成功"),t.getList(),a.next=12;break;case 9:a.prev=9,a.t0=a.catch(0),console.log(a.t0);case 12:case"end":return a.stop()}},a,t,[[0,9]])}))()}},created:function(){this.getList()}},u={render:function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"page-employee"},[a("my-page-title",{attrs:{title:"I品车险"}}),a("div",{staticClass:"bar"},[a("el-form",{attrs:{inline:!0},nativeOn:{click:function(e){e.preventDefault()}}},[a("el-form-item",[a("el-input",{attrs:{placeholder:"请输入姓名"},model:{value:e.name,callback:function(t){e.name=t},expression:"name"}})],1),a("el-form-item",[a("my-button",{attrs:{type:"primary",loading:e.loading,click:e.research}},[e._v("搜索")])],1)],1)],1),a("div",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}],staticClass:"content"},[a("el-table",{staticStyle:{width:"100%"},attrs:{data:e.list,border:"border"}},[a("el-table-column",{attrs:{align:"center",type:"index"}}),a("el-table-column",{attrs:{align:"center",label:"姓名",prop:"name"}}),a("el-table-column",{attrs:{align:"center",label:"电话",prop:"phone"}}),a("el-table-column",{attrs:{align:"center",label:"车牌号",prop:"car_no"}}),a("el-table-column",{attrs:{align:"center",label:"行驶证",prop:"driver_card"},scopedSlots:e._u([{key:"default",fn:function(e){return[a("img",{attrs:{src:e.row.driver_card}})]}}])}),a("el-table-column",{attrs:{align:"center",label:"车险项目",prop:"option"}}),a("el-table-column",{attrs:{align:"center",label:"填表时间",prop:"created"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v(e._s(e.formatDate(new Date(1e3*t.row.created))))]}}])}),a("el-table-column",{attrs:{align:"center",label:"是否成交",prop:"is_deal"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v(e._s(1===t.row.is_deal?"已成交":"未成交"))]}}])}),a("el-table-column",{attrs:{align:"center",label:"操作",prop:""},scopedSlots:e._u([{key:"default",fn:function(t){return[a("el-button",{attrs:{type:"text"},on:{click:function(a){e.viewNotes(t.row)}}},[e._v("备注")]),0===t.row.is_deal?a("el-button",{attrs:{type:"text"},on:{click:function(a){e.deal(t.row)}}},[e._v("成交")]):e._e()]}}])})],1),a("div",{staticClass:"pager"},[a("el-pagination",{attrs:{"page-sizes":[20],layout:"total,slot,prev,pager,next","current-page":e.pagination.curPage,"page-size":e.pagination.pageSize,total:e.pagination.pageTotal},on:{"update:currentPage":function(t){e.$set(e.pagination,"curPage",t)},"current-change":e.pageCurPageChange,"size-change":e.pageSizeChange}})],1)],1),a("my-note-editor",{ref:"my-note-editor",attrs:{"list-url":"/mobile/finance/safelogs","add-url":"/admin/finance/safelog","post-key":"sid"}})],1)},staticRenderFns:[]};var p=a("7jd7")(c,u,!1,function(e){a("AVyY")},"data-v-79b6a334",null);t.default=p.exports}});
//# sourceMappingURL=8.0c01face748e95d4882a.js.map