webpackJsonp([0],{"0wMN":function(t,e,i){"use strict";e.a={data:function(){return{pagination:{curPage:1,pageSize:20,pageTotal:1}}},methods:{pageSizeChange:function(t){this.pagination.pageSize=t,this.req()},pageCurPageChange:function(t){this.pagination.curPage=t,this.req()},req:function(){}}}},Quz9:function(t,e,i){"use strict";e.a={data:function(){return{visible:!1,type:"new"}},computed:{titleText:function(){return"new"===this.type?"新增":"编辑"}},methods:{open:function(){this.clear&&this.clear(),this.setDefaultValues&&this.setDefaultValues(),this.visible=!0},clear:function(){},setDefaultValues:function(){},close:function(){this.visible=!1},setEditorType:function(t){this.type=t},setId:function(t){this.form.id=t,this.setEditorType("edit")}}}}});
//# sourceMappingURL=0.81a26a1052517d8f9e25.js.map