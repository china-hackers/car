webpackJsonp([36],{IR0r:function(e,o,a){"use strict";Object.defineProperty(o,"__esModule",{value:!0});var r=a("5/aF"),t=a.n(r),l=a("1p1D"),c=a.n(l),s=a("Z34F"),n=a.n(s),i={mixins:[a("VHG+").a],data:function(){return{form:{model:"",color:"",gear_box:"",gear_model:"",chairs:5,doors:5,wheel:"",capacity:0,length:0,width:0,height:0,wheelbase:0,weight:0}}},methods:{save:function(){var e=this;return n()(t.a.mark(function o(){return t.a.wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.prev=0,o.next=3,e.$http.post("/mobile/product/basesave",c()({id:e.$route.query.id},e.form));case 3:e.success("保存成功"),history.back(),o.next=10;break;case 7:o.prev=7,o.t0=o.catch(0),console.log(o.t0);case 10:case"end":return o.stop()}},o,e,[[0,7]])}))()}},created:function(){var e=this;return n()(t.a.mark(function o(){var a,r;return t.a.wrap(function(o){for(;;)switch(o.prev=o.next){case 0:return o.prev=0,o.next=3,e.$http.post("/mobile/product/base",{id:e.$route.query.id});case 3:a=o.sent,r=a.data,console.log(r),e.form={model:r.model,color:r.color,gear_box:r.gear_box,gear_model:r.gear_model,chairs:r.chairs,doors:r.doors,wheel:r.wheel,capacity:r.capacity,length:r.length,width:r.width,height:r.height,wheelbase:r.wheelbase,weight:r.weight},o.next=12;break;case 9:o.prev=9,o.t0=o.catch(0),console.log(o.t0);case 12:case"end":return o.stop()}},o,e,[[0,9]])}))()}},m={render:function(){var e=this,o=e.$createElement,a=e._self._c||o;return a("div",{staticClass:"page"},[a("my-nav-bar",{attrs:{title:"基本参数"}}),a("van-cell-group",[a("my-form-select",{attrs:{label:"车型",placeholder:"请选择",actions:e.model},model:{value:e.form.model,callback:function(o){e.$set(e.form,"model",o)},expression:"form.model"}}),a("my-form-select",{attrs:{label:"颜色",placeholder:"请选择",actions:e.color},model:{value:e.form.color,callback:function(o){e.$set(e.form,"color",o)},expression:"form.color"}}),a("my-form-select",{attrs:{label:"变速箱",placeholder:"请选择",actions:e.gearBox},model:{value:e.form.gear_box,callback:function(o){e.$set(e.form,"gear_box",o)},expression:"form.gear_box"}}),a("van-field",{attrs:{label:"车门数",placeholder:"请输入",type:"number"},model:{value:e.form.doors,callback:function(o){e.$set(e.form,"doors",o)},expression:"form.doors"}}),a("van-field",{attrs:{label:"座位数",placeholder:"请输入",type:"number"},model:{value:e.form.chairs,callback:function(o){e.$set(e.form,"chairs",o)},expression:"form.chairs"}}),a("my-form-select",{attrs:{label:"轮毂材料",placeholder:"请选择",actions:e.hubMaterial},model:{value:e.form.wheel,callback:function(o){e.$set(e.form,"wheel",o)},expression:"form.wheel"}}),a("van-field",{attrs:{label:"长(mm)",placeholder:"请输入",type:"number"},model:{value:e.form.length,callback:function(o){e.$set(e.form,"length",o)},expression:"form.length"}}),a("van-field",{attrs:{label:"宽(mm)",placeholder:"请输入",type:"number"},model:{value:e.form.width,callback:function(o){e.$set(e.form,"width",o)},expression:"form.width"}}),a("van-field",{attrs:{label:"高(mm)",placeholder:"请输入",type:"number"},model:{value:e.form.height,callback:function(o){e.$set(e.form,"height",o)},expression:"form.height"}}),a("van-field",{attrs:{label:"轴距(mm)",placeholder:"请输入",type:"number"},model:{value:e.form.wheelbase,callback:function(o){e.$set(e.form,"wheelbase",o)},expression:"form.wheelbase"}}),a("van-field",{attrs:{label:"行李箱(L)",placeholder:"请输入",type:"number"},model:{value:e.form.capacity,callback:function(o){e.$set(e.form,"capacity",o)},expression:"form.capacity"}}),a("van-field",{attrs:{label:"重量(kg)",placeholder:"请输入",type:"number"},model:{value:e.form.weight,callback:function(o){e.$set(e.form,"weight",o)},expression:"form.weight"}})],1),a("my-bottom-bar",{staticClass:"bottom",attrs:{click:e.save}},[a("div",{staticClass:"g-bottom-btn"},[e._v("提交")])])],1)},staticRenderFns:[]},f=a("7jd7")(i,m,!1,null,null,null);o.default=f.exports}});
//# sourceMappingURL=36.e69516ec693e75e9b394.js.map