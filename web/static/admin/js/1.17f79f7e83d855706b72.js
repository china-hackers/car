webpackJsonp([1],{"2svW":function(t,e){},Ayk8:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=s("5/aF"),n=s.n(r),a=s("Z34F"),i=s.n(a),c=s("gC1q"),o=s("T7Ta"),l=s.n(o),d={mixins:[s("Quz9").a],data:function(){return{id:"",letter:"",brand:"",model:"",star:0,keywords:[],inputValue:"",inputVisible:!1}},computed:{title:function(){return""===this.id?"新增车型":"修改车型"}},methods:{clear:function(){l()(this,{id:"",letter:"",brand:"",model:"",star:0,keywords:[],inputVisible:!1})},setLetter:function(t){this.letter=t},setBrand:function(t){this.brand=t},setEditData:function(t){t.keywords=t.keywords||[],l()(this,t)},handleClose:function(t){this.keywords.splice(this.keywords.indexOf(t),1)},showInput:function(){var t=this;this.inputVisible=!0,this.$nextTick(function(e){t.$refs.saveTagInput.$refs.input.focus()})},handleInputConfirm:function(){var t=this.inputValue;t&&this.keywords.push(t),this.inputVisible=!1,this.inputValue=""},saveNewType:function(){var t=this;return i()(n.a.mark(function e(){return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/add",{letter:t.letter,brand:t.brand,model:t.model,star:t.star,keywords:t.keywords});case 3:t.success("保存成功"),t.close(),t.$emit("save-success"),e.next=11;break;case 8:e.prev=8,e.t0=e.catch(0),console.log(e.t0);case 11:case"end":return e.stop()}},e,t,[[0,8]])}))()},saveEditType:function(){var t=this;return i()(n.a.mark(function e(){return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/edit",{id:t.id,letter:t.letter,brand:t.brand,model:t.model,star:t.star,keywords:t.keywords.join("|")});case 3:t.success("保存成功"),t.close(),t.$emit("save-success"),e.next=11;break;case 8:e.prev=8,e.t0=e.catch(0),console.log(e.t0);case 11:case"end":return e.stop()}},e,t,[[0,8]])}))()},save:function(){return""===this.id?this.saveNewType():this.saveEditType()}}},u={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("el-dialog",{attrs:{title:t.title,visible:t.visible,width:"600px"},on:{"update:visible":function(e){t.visible=e}}},[s("div",{staticClass:"comp-car-type-editor"},[s("el-form",{attrs:{"label-width":"80px","label-position":"left"}},[s("el-form-item",{attrs:{label:"品牌"}},[t._v(t._s(t.letter))]),s("el-form-item",{attrs:{label:"品牌"}},[t._v(t._s(t.brand))]),s("el-form-item",{attrs:{label:"车型名称"}},[s("el-input",{model:{value:t.model,callback:function(e){t.model=e},expression:"model"}})],1),s("el-form-item",{attrs:{label:"评分"}},[s("el-input-number",{attrs:{max:5,min:0,step:.01,precision:2},model:{value:t.star,callback:function(e){t.star=e},expression:"star"}})],1),s("el-form-item",{attrs:{label:"关键字"}},[t._l(t.keywords,function(e,r){return s("el-tag",{key:r,staticClass:"tag",attrs:{closable:"closable"},on:{close:function(s){t.handleClose(e)}}},[t._v(t._s(e))])}),t.inputVisible?s("el-input",{ref:"saveTagInput",staticClass:"tag input input-new-tag",attrs:{size:"small"},on:{blur:t.handleInputConfirm},nativeOn:{keyup:function(e){return"button"in e||!t._k(e.keyCode,"enter",13,e.key,"Enter")?t.handleInputConfirm(e):null}},model:{value:t.inputValue,callback:function(e){t.inputValue=e},expression:"inputValue"}}):s("el-button",{staticClass:"tag input button-new-tag",attrs:{size:"small"},on:{click:t.showInput}},[t._v("新增关键字")])],2),s("el-form-item",{attrs:{label:""}},[s("my-button",{attrs:{type:"primary",click:t.save}},[t._v("保存")])],1)],1)],1)])},staticRenderFns:[]};var p=s("7jd7")(d,u,!1,function(t){s("GvNW")},"data-v-402da023",null).exports,h={components:{"my-car-filter":c.a,"my-car-type-editor":p},data:function(){return{choosedLetter:"",letterList:[],choosedBrand:"",brandList:[],typeList:[]}},methods:{getLetterList:function(){var t=this;return i()(n.a.mark(function e(){var s,r;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/letterlist",{p:1});case 3:s=e.sent,r=s.data,t.letterList=r.data.list,t.chooseLetter("A"),e.next=12;break;case 9:e.prev=9,e.t0=e.catch(0),console.log(e.t0);case 12:case"end":return e.stop()}},e,t,[[0,9]])}))()},chooseLetter:function(t){this.choosedLetter=t,this.getBrandList()},getBrandList:function(){var t=this;return i()(n.a.mark(function e(){var s,r;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/brandlist",{letter:t.choosedLetter,p:1});case 3:s=e.sent,r=s.data,t.brandList=r.data.list,t.chooseBrand(r.data.list[0].brand),e.next=12;break;case 9:e.prev=9,e.t0=e.catch(0),console.log(e.t0);case 12:case"end":return e.stop()}},e,t,[[0,9]])}))()},chooseBrand:function(t){this.choosedBrand=t,this.getTypeList()},getTypeList:function(){var t=this;return i()(n.a.mark(function e(){var s,r;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/modellist",{brand:t.choosedBrand});case 3:s=e.sent,r=s.data,t.typeList=r.data.list,console.log(r),e.next=12;break;case 9:e.prev=9,e.t0=e.catch(0),console.log(e.t0);case 12:case"end":return e.stop()}},e,t,[[0,9]])}))()},addType:function(){var t=this;return i()(n.a.mark(function e(){var s;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:try{(s=t.$refs["my-car-type-editor"]).setLetter(t.choosedLetter),s.setBrand(t.choosedBrand),s.open()}catch(t){console.log(t)}case 1:case"end":return e.stop()}},e,t)}))()},editType:function(t){var e=this;return i()(n.a.mark(function s(){var r;return n.a.wrap(function(s){for(;;)switch(s.prev=s.next){case 0:try{(r=e.$refs["my-car-type-editor"]).setEditData(e._.cloneDeep(t)),r.open()}catch(t){console.log(t)}case 1:case"end":return s.stop()}},s,e)}))()},delType:function(t){var e=this;return i()(n.a.mark(function s(){return n.a.wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return s.prev=0,s.next=3,e.$confirm("确认删除该车型吗？");case 3:return s.next=5,e.$http.post("/admin/car/delete",{id:t.id});case 5:e.success("删除成功"),e.getTypeList(),s.next=12;break;case 9:s.prev=9,s.t0=s.catch(0),console.log(s.t0);case 12:case"end":return s.stop()}},s,e,[[0,9]])}))()}},created:function(){this.getLetterList()}},f={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"page-car-types"},[s("my-page-title",{attrs:{title:"车型管理",btnVisible:!1}}),s("div",{staticClass:"car-filter"},[s("div",{staticClass:"item"},[s("label",[t._v("首字母")]),s("div",{staticClass:"right"},t._l(t.letterList,function(e){return s("div",{staticClass:"choose-item",class:{choosed:e==t.choosedLetter},on:{click:function(s){t.chooseLetter(e)}}},[t._v(t._s(e))])}))]),s("div",{staticClass:"item"},[s("label",[t._v("品牌")]),s("div",{staticClass:"right"},t._l(t.brandList,function(e){return s("div",{staticClass:"choose-item",class:{choosed:e.brand==t.choosedBrand},on:{click:function(s){t.chooseBrand(e.brand)}}},[t._v(t._s(e.brand))])}))])]),s("el-button",{staticClass:"mb-20",attrs:{type:"primary"},on:{click:t.addType}},[t._v("新增车型")]),s("div",{staticClass:"types"},[s("el-table",{staticStyle:{width:"100%"},attrs:{data:t.typeList,border:"border"}},[s("el-table-column",{attrs:{align:"center",type:"index"}}),s("el-table-column",{attrs:{align:"center",label:"车型名称",prop:"model"}}),s("el-table-column",{attrs:{align:"center",label:"关键字",prop:"keywords"},scopedSlots:t._u([{key:"default",fn:function(e){return t._l(e.row.keywords,function(e,r){return s("el-tag",{key:r},[t._v(t._s(e))])})}}])}),s("el-table-column",{attrs:{align:"center",label:"评分",prop:"star"}}),s("el-table-column",{attrs:{align:"center",label:"操作",prop:""},scopedSlots:t._u([{key:"default",fn:function(e){return[s("el-button",{attrs:{type:"text"},on:{click:function(s){t.editType(e.row)}}},[t._v("修改")]),s("el-button",{attrs:{type:"text"},on:{click:function(s){t.delType(e.row)}}},[t._v("删除")])]}}])})],1)],1),s("my-car-type-editor",{ref:"my-car-type-editor",on:{"save-success":t.getTypeList}})],1)},staticRenderFns:[]};var v=s("7jd7")(h,f,!1,function(t){s("LcNz")},"data-v-7bf25d37",null);e.default=v.exports},GvNW:function(t,e){},LcNz:function(t,e){},gC1q:function(t,e,s){"use strict";var r=s("5/aF"),n=s.n(r),a=s("Z34F"),i=s.n(a),c={data:function(){return{choosedLetter:"",letterList:[],choosedBrand:"",brandList:[],typeList:[],choosedTypeId:"",price_from:0,price_to:300}},methods:{getLetterList:function(){var t=this;return i()(n.a.mark(function e(){var s,r;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/letterlist",{p:1});case 3:return s=e.sent,r=s.data,t.letterList=r.data.list,e.next=8,t.chooseLetter("A");case 8:e.next=13;break;case 10:e.prev=10,e.t0=e.catch(0),console.log(e.t0);case 13:case"end":return e.stop()}},e,t,[[0,10]])}))()},chooseLetter:function(t){var e=this;return i()(n.a.mark(function s(){return n.a.wrap(function(s){for(;;)switch(s.prev=s.next){case 0:return e.choosedLetter=t,e.choosedTypeId="",s.next=4,e.getBrandList();case 4:case"end":return s.stop()}},s,e)}))()},getBrandList:function(){var t=this;return i()(n.a.mark(function e(){var s,r;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/brandlist",{letter:t.choosedLetter,p:1});case 3:return s=e.sent,r=s.data,t.brandList=r.data.list,e.next=8,t.chooseBrand(r.data.list[0].brand);case 8:e.next=13;break;case 10:e.prev=10,e.t0=e.catch(0),console.log(e.t0);case 13:case"end":return e.stop()}},e,t,[[0,10]])}))()},chooseBrand:function(t){var e=this;return i()(n.a.mark(function s(){return n.a.wrap(function(s){for(;;)switch(s.prev=s.next){case 0:if(e.choosedBrand=t,""===t){s.next=4;break}return s.next=4,e.getTypeList();case 4:e.choosedTypeId="";case 5:case"end":return s.stop()}},s,e)}))()},getTypeList:function(){var t=this;return i()(n.a.mark(function e(){var s,r;return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,t.$http.post("/admin/car/modellist",{brand:t.choosedBrand});case 3:s=e.sent,r=s.data,t.typeList=r.data.list,console.log(r),e.next=12;break;case 9:e.prev=9,e.t0=e.catch(0),console.log(e.t0);case 12:case"end":return e.stop()}},e,t,[[0,9]])}))()},chooseType:function(t){this.choosedTypeId=t},newCar:function(){this.$emit("new-car")},startSearch:function(){this.$emit("start-search",{letter:this.choosedLetter,brand:this.choosedBrand,car_id:this.choosedTypeId,price_from:this.price_from,price_to:this.price_to})}},created:function(){var t=this;return i()(n.a.mark(function e(){return n.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,t.getLetterList();case 2:t.startSearch();case 3:case"end":return e.stop()}},e,t)}))()}},o={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"comp-car-filter"},[s("div",{staticClass:"item"},[s("label",[t._v("首字母")]),s("div",{staticClass:"right"},[s("div",{staticClass:"choose-item",class:{choosed:""==t.choosedLetter},on:{click:function(e){t.chooseLetter("")}}},[t._v("不限")]),t._l(t.letterList,function(e){return s("div",{staticClass:"choose-item",class:{choosed:e==t.choosedLetter},on:{click:function(s){t.chooseLetter(e)}}},[t._v(t._s(e))])})],2)]),s("div",{staticClass:"item"},[s("label",[t._v("品牌")]),s("div",{staticClass:"right"},[s("div",{staticClass:"choose-item",class:{choosed:""==t.choosedBrand},on:{click:function(e){t.chooseBrand("")}}},[t._v("不限")]),t._l(t.brandList,function(e){return s("div",{staticClass:"choose-item",class:{choosed:e.brand==t.choosedBrand},on:{click:function(s){t.chooseBrand(e.brand)}}},[t._v(t._s(e.brand))])})],2)]),s("div",{staticClass:"item"},[s("label",[t._v("车型")]),s("div",{staticClass:"right"},[s("div",{staticClass:"choose-item",class:{choosed:""==t.choosedTypeId},on:{click:function(e){t.chooseType("")}}},[t._v("不限")]),t._l(t.typeList,function(e){return s("div",{staticClass:"choose-item",class:{choosed:e.id==t.choosedTypeId},on:{click:function(s){t.chooseType(e.id)}}},[t._v(t._s(e.model))])})],2)]),s("div",{staticClass:"item"},[s("label",[t._v("价格")]),s("div",{staticClass:"right"},[s("div",{staticClass:"my-define"},[s("el-input-number",{attrs:{size:"small",min:0,"controls-position":"right",precision:2,step:.01,placeholder:"万元"},model:{value:t.price_from,callback:function(e){t.price_from=e},expression:"price_from"}}),s("div",{staticClass:"space"},[t._v("-")]),s("el-input-number",{attrs:{size:"small",min:0,"controls-position":"right",precision:2,step:.01,placeholder:"万元"},model:{value:t.price_to,callback:function(e){t.price_to=e},expression:"price_to"}})],1)])]),s("div",{staticClass:"item"},[s("label"),s("div",{staticClass:"right"},[s("el-button",{attrs:{type:"primary"},on:{click:t.startSearch}},[t._v("开始搜索")]),s("el-button",{attrs:{type:"primary"},on:{click:t.newCar}},[t._v("新增车")])],1)])])},staticRenderFns:[]};var l=s("7jd7")(c,o,!1,function(t){s("2svW")},"data-v-e3e8123e",null);e.a=l.exports}});
//# sourceMappingURL=1.17f79f7e83d855706b72.js.map