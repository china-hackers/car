webpackJsonp([39],{"6VpE":function(e,t){},CWyp:function(e,t){},F3Dd:function(e,t){},Hwta:function(e,t){},J1DO:function(e,t){},MwFm:function(e,t){},NHnr:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var a={};n.d(a,"gas",function(){return me}),n.d(a,"model",function(){return ve}),n.d(a,"color",function(){return ge}),n.d(a,"gearBox",function(){return be}),n.d(a,"hubMaterial",function(){return ye}),n.d(a,"inlet",function(){return xe}),n.d(a,"fuel",function(){return we}),n.d(a,"fuelLabel",function(){return ke}),n.d(a,"brake",function(){return Ce}),n.d(a,"drivingModel",function(){return _e}),n.d(a,"steeringSystem",function(){return Se}),n.d(a,"suspensionSystem",function(){return Ve});var i=n("8kJB"),r=n.n(i),o=n("8eaC"),l=n("uduo"),c=n.n(l),s=n("l7Nj"),u=n.n(s).a.create({timeout:15e3,headers:{"X-Requested-With":"XMLHttpRequest"}});u.interceptors.request.use(function(e){return e}),u.interceptors.response.use(function(e){if(e.data)return 200===e.data.code?e.data:(o.a.prototype.$dialog.alert({message:e.data.message}),r.a.reject(e.data))},function(e){return o.a.prototype.$dialog.alert({message:"网络错误"}),r.a.reject(e)}),u.openWindow=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=[];c()(t).forEach(function(e){n.push(e+"="+t[e])}),n=n.join("&"),e=-1===e.indexOf("?")?e+"?"+n:e+"&"+n;var a=document.createElement("a");a.target="_blank",a.href=e,a.click(),a.remove()};var d={install:function(e){e.prototype.$http=u}},h={name:"background-image",config:{update:function(e,t){t.value!==t.oldValue&&""!==t.value&&(e.style.backgroundImage="url("+t.value+")")},bind:function(e,t){t.value!==t.oldValue&&""!==t.value&&(e.style.backgroundImage="url("+t.value+")")}}},p={install:function(e){[h].forEach(function(t){e.directive(t.name,t.config)})}},f=n("1p1D"),m=n.n(f),v=window.wxConfig;wx.config(m()({},v,{jsApiList:["onMenuShareTimeline","onMenuShareAppMessage","onMenuShareQQ","onMenuShareWeibo","updateAppMessageShareData","updateTimelineShareData"]}));var g={title:"加入I品车，更多车源更多客户",desc:"加入I品车，更多车源更多客户",link:"#/my/qr",imgUrl:v.headimgurl};wx.ready(function(){wx.checkJsApi({jsApiList:["updateAppMessageShareData","updateTimelineShareData"],success:function(e){e.checkResult.updateAppMessageShareData?(wx.updateAppMessageShareData(g),wx.updateTimelineShareData(g)):(wx.onMenuShareTimeline(g),wx.onMenuShareAppMessage(g),wx.onMenuShareQQ(g),wx.onMenuShareWeibo(g))}})});var b={props:{value:{type:String,default:""}},watch:{value:{handler:function(e){this.text=e},immediate:!0}},data:function(){return{text:""}},methods:{handleSearch:function(){console.log("search"),-1!==window.location.hash.indexOf("main/home")?this.$router.push({path:"/main/car",query:{title:this.text}}):this.$emit("input",this.text)}}},y={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"comp-header"},[n("div",{staticClass:"wrap flex"},[n("div",{staticClass:"location flex"},[e._v("成都")]),n("van-field",{staticClass:"search",attrs:{clearable:"clearable",type:"search","left-icon":"search",placeholder:"搜索您要搜索的车"},on:{search:e.handleSearch},model:{value:e.text,callback:function(t){e.text=t},expression:"text"}}),n("div",{staticClass:"call flex"},[n("van-icon",{attrs:{name:"phone"}})],1)],1)])},staticRenderFns:[]};var x=n("7jd7")(b,y,!1,function(e){n("WuCS")},"data-v-645d4579",null).exports,w={props:{list:{type:Array,default:function(){return[]}}},data:function(){return{curIndex:0}},methods:{handleItemClick:function(){this.$emit("item-click",this.curIndex)},handleChange:function(e){this.curIndex=e}}},k={render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"comp-banner",on:{click:this.handleItemClick}},[t("van-swipe",{attrs:{autoplay:3e3},on:{change:this.handleChange}},this._l(this.list,function(e,n){return t("van-swipe-item",{key:e.id},[t("div",{directives:[{name:"lazy",rawName:"v-lazy:background-image",value:e.img,expression:"item.img",arg:"background-image"}],staticClass:"bg img"})])}))],1)},staticRenderFns:[]};var C=n("7jd7")(w,k,!1,function(e){n("r+O4")},"data-v-9856ef44",null).exports,_={render:function(){var e=this.$createElement;return(this._self._c||e)("div",{staticClass:"comp-box"},[this._t("default")],2)},staticRenderFns:[]};var S=n("7jd7")(null,_,!1,function(e){n("F3Dd")},"data-v-4a614ee2",null).exports,V={props:{title:{type:String,default:""},showRight:{type:Boolean,default:!1},rightText:{type:String,default:""}},methods:{handleRightClick:function(){this.$emit("right-click")}}},T={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"comp-title"},[n("div",{staticClass:"title"},[e._v(e._s(e.title))]),e.showRight?n("div",{staticClass:"right",on:{click:e.handleRightClick}},[n("span",[e._v(e._s(e.rightText))]),n("van-icon",{staticClass:"icon",attrs:{name:"arrow"}})],1):e._e()])},staticRenderFns:[]};var M=n("7jd7")(V,T,!1,function(e){n("MwFm")},"data-v-705dccc4",null).exports,$=n("5/aF"),R=n.n($),E=n("Z34F"),j=n.n(E),F={props:{click:{type:Function,default:function(){}}},data:function(){return{loading:!1}},methods:{handleClick:function(){var e=this;return j()(R.a.mark(function t(){return R.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(e.loading){t.next=10;break}return t.prev=1,e.loading=!0,t.next=5,e.click();case 5:t.next=10;break;case 7:t.prev=7,t.t0=t.catch(1),console.log(t.t0);case 10:e.loading=!1;case 11:case"end":return t.stop()}},t,e,[[1,7]])}))()}}},I={render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"comp-bottom-bar"},[t("div",{staticClass:"wrap flex",on:{click:this.handleClick}},[this._t("default")],2)])},staticRenderFns:[]};var P=n("7jd7")(F,I,!1,function(e){n("J1DO")},null,null).exports,W={props:{title:{type:String,default:""},rightIcon:{type:String,default:""}},methods:{handleLeftClick:function(){history.back()},onClickRight:function(){this.$emit("right-click")}}},A={render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"comp-my-nav-bar"},[t("van-nav-bar",{attrs:{fixed:!0,title:this.title,"left-text":"返回","left-arrow":"left-arrow"},on:{"click-left":this.handleLeftClick,"click-right":this.onClickRight}},[this.rightIcon?t("van-icon",{attrs:{slot:"right",name:this.rightIcon},slot:"right"}):this._e()],1)],1)},staticRenderFns:[]};var D=n("7jd7")(W,A,!1,function(e){n("k8ah")},"data-v-d7b49ffa",null).exports,L={props:{list:{type:Array,default:function(){return[]}}}},N={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"van-cell comp-key-value"},e._l(e.list,function(t){return n("div",{staticClass:"item"},[n("div",{staticClass:"key"},[e._v(e._s(t.key))])])}))},staticRenderFns:[]};var q=n("7jd7")(L,N,!1,function(e){n("ij/3")},"data-v-5d1a8c8e",null).exports,O={props:{src:{type:String,default:""}}},z={render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"comp-avatar"},[""===this.src?t("van-icon",{staticClass:"icon",attrs:{name:"contact"}}):t("div",{directives:[{name:"lazy",rawName:"v-lazy:background-image",value:this.src,expression:"src",arg:"background-image"}],staticClass:"img bg"})],1)},staticRenderFns:[]};var Q=n("7jd7")(O,z,!1,function(e){n("OaeT")},"data-v-5c54b5aa",null).exports,B={props:{label:{type:String,default:""},actions:{type:Array,default:function(){return[{name:"1"}]}},placeholder:{type:String,default:""},value:{type:String,default:""}},watch:{value:{handler:function(e){var t=this.actions.find(function(t){return t.value===e});t&&(this.myValue=t.value,this.valueText=t.name)},immediate:!0}},computed:{displayValue:function(){return this.valueText||this.placeholder}},data:function(){return{myValue:"",valueText:"",show:!1}},methods:{onSelect:function(e){this.myValue=e.value,this.valueText=e.name,this.show=!1,this.$emit("input",this.myValue)}}},H={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"comp-form-select"},[n("van-cell",{class:{noval:""===e.myValue},attrs:{title:e.label,value:e.displayValue,"is-link":"is-link"},on:{click:function(t){e.show=!0}}}),n("van-actionsheet",{attrs:{actions:e.actions},on:{select:e.onSelect},model:{value:e.show,callback:function(t){e.show=t},expression:"show"}})],1)},staticRenderFns:[]};var U=n("7jd7")(B,H,!1,function(e){n("CWyp")},null,null).exports,J=n("58XF"),X=n.n(J),Y={},K={},Z={props:{label:{type:String,default:""},data:{type:Array,default:function(){return[]}},placeholder:{type:String,default:""},value:{type:Number,default:1}},watch:{value:{handler:function(e){this.countValue()},immediate:!0},data:function(){this.countValue()}},computed:{displayValue:function(){return this.valueText||this.placeholder},columns:function(){var e,t,n={};e={className:"c1",defaultIndex:this.index0,values:this.data.map(function(e,t){return Y[e.label]=t,e.label})};var a=this.data[this.index0];if(t={className:"c2",defaultIndex:this.index1,values:a?a.children.map(function(e,t){return K[e.label]=t,e.label}):[]},a){var i=a.children[this.index1];n={className:"c3",defaultIndex:this.index2,values:i?i.children.map(function(e){return{text:e.label,value:e.value}}):[]}}return[e,t,n]}},data:function(){return{myValue:"",valueText:"",show:!1,index0:0,index1:0,index2:0}},methods:{handleConfirm:function(e){var t=X()(e,3)[2];this.myValue=t.value,this.valueText=t.text,this.show=!1,this.$emit("input",this.myValue)},handleCancel:function(){this.show=!1},handleChange:function(e,t){var n=X()(t,3),a=n[0],i=n[1];n[2];this.index0=Y[a],this.index1=K[i]},countValue:function(){var e=this;this.data.length&&this.data.forEach(function(t,n){t.children.forEach(function(t,a){t.children.forEach(function(t,i){t.value===e.value&&(e.index0=n,e.index1=a,e.index2=i,e.valueText=t.label)})})})}}},G={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"comp-form-select"},[n("van-cell",{class:{noval:""===e.myValue},attrs:{title:e.label,value:e.displayValue,"is-link":"is-link"},on:{click:function(t){e.show=!0}}}),n("van-popup",{attrs:{position:"bottom"},model:{value:e.show,callback:function(t){e.show=t},expression:"show"}},[n("van-picker",{attrs:{columns:e.columns,"show-toolbar":!0},on:{change:e.handleChange,confirm:e.handleConfirm,cancel:e.handleCancel}})],1)],1)},staticRenderFns:[]};var ee=n("7jd7")(Z,G,!1,function(e){n("OTaQ")},null,null).exports,te={props:{label:{type:String,default:""},placeholder:{type:String,default:""},value:{type:String,default:""}},watch:{value:function(e){this.myValue=e}},computed:{displayValue:function(){return this.myValue||this.placeholder}},data:function(){return{myValue:"",show:!1}},methods:{onRead:function(e){var t=this;return j()(R.a.mark(function n(){var a,i,r,o;return R.a.wrap(function(n){for(;;)switch(n.prev=n.next){case 0:return n.prev=0,(a=new FormData).append("UploadModel[image]",e.file),i={headers:{"Content-Type":"multipart/form-data"}},n.next=6,t.$http.post("/mobile/site/safeimg",a,i);case 6:r=n.sent,o=r.data,t.myValue=o[0],n.next=14;break;case 11:n.prev=11,n.t0=n.catch(0),console.log(n.t0);case 14:case"end":return n.stop()}},n,t,[[0,11]])}))()}}},ne={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"van-cell comp-form-select",class:{noval:""===e.myValue},on:{click:function(t){e.show=!0}}},[n("div",{staticClass:"van-cell__title"},[n("span",[e._v(e._s(e.label))])]),n("div",{staticClass:"van-cell__value"},[n("van-uploader",{attrs:{"after-read":e.onRead,accept:"image/*"}},[n("span",[e._v(e._s(e.displayValue))])])],1)])},staticRenderFns:[]};var ae=n("7jd7")(te,ne,!1,function(e){n("Hwta")},null,null).exports,ie={props:{phone:{type:String,default:""},value:{type:String,default:""}},watch:{value:{handler:function(e){this.myValue=e},immediate:!0},myValue:function(){this.$emit("input",this.myValue)}},data:function(){return{myValue:"",count:60,doing:!1}},methods:{sendCode:function(){var e=this;return j()(R.a.mark(function t(){return R.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(t.prev=0,""!==e.phone){t.next=4;break}return e.fail("电话号码不能为空"),t.abrupt("return");case 4:return e.doing=!0,t.next=7,e.$http.post("/mobile/user/sendcode",{phone:e.phone});case 7:return t.next=9,e.startCount();case 9:t.next=15;break;case 11:t.prev=11,t.t0=t.catch(0),e.doing=!1,console.log(t.t0);case 15:e.doing=!1;case 16:case"end":return t.stop()}},t,e,[[0,11]])}))()},startCount:function(){var e=this;return new r.a(function(t){var n=setInterval(function(){e.count-=1,0===e.count&&(e.count=60,clearInterval(n),t(!0),e.doing=!1)},1e3)})}}},re={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("van-field",{attrs:{label:"验证码",placeholder:"请输入验证码"},model:{value:e.myValue,callback:function(t){e.myValue=t},expression:"myValue"}},[n("van-button",{attrs:{slot:"button",size:"small",type:"primary",disabled:e.doing},on:{click:e.sendCode},slot:"button"},[e._v(e._s(e.doing?e.count+"s":"发送验证码"))])],1)},staticRenderFns:[]},oe=n("7jd7")(ie,re,!1,null,null,null).exports,le={props:{label:{type:String,default:""},placeholder:{type:String,default:""}},computed:{displayValue:function(){return this.valueText||this.placeholder}},data:function(){return{myValue:"",valueText:"",show:!1,searchText:"",loading:!1,finished:!1,curPage:1,list:[]}},methods:{onSelect:function(e){this.myValue=e.id,this.valueText=e.title,this.show=!1,this.$emit("input",this.myValue)},handleLeftClick:function(){this.show=!1},research:function(){this.finished=!1,this.list=[],this.curPage=1,this.loading=!1},onLoad:function(){var e=this;return j()(R.a.mark(function t(){var n,a;return R.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:if(e.loading){t.next=16;break}return e.loading=!0,t.prev=2,t.next=5,e.$http.post("/mobile/business/productlist",{state:0,p:e.curPage,title:e.searchText});case 5:n=t.sent,a=n.data,e.list=e.list.concat(a.list),e.list.length>=a.total&&(e.finished=!0),e.curPage+=1,t.next=15;break;case 12:t.prev=12,t.t0=t.catch(2),console.log(t.t0);case 15:e.loading=!1;case 16:case"end":return t.stop()}},t,e,[[2,12]])}))()}}},ce={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"comp"},[n("van-cell",{class:{noval:""===e.myValue},attrs:{title:e.label,value:e.displayValue,"is-link":"is-link"},on:{click:function(t){e.show=!0}}}),n("van-popup",{staticClass:"pop",attrs:{position:"right"},model:{value:e.show,callback:function(t){e.show=t},expression:"show"}},[n("van-nav-bar",{attrs:{fixed:!0,title:"选择车辆","left-text":"返回","left-arrow":"left-arrow"},on:{"click-left":e.handleLeftClick}}),n("van-search",{attrs:{placeholder:"请输入车辆标题"},on:{search:e.research},model:{value:e.searchText,callback:function(t){e.searchText=t},expression:"searchText"}}),n("van-list",{staticClass:"list",attrs:{loading:e.loading,finished:e.finished,offset:600},on:{load:e.onLoad}},e._l(e.list,function(t,a){return n("van-swipe-cell",{key:t.id,staticClass:"item"},[n("div",{staticClass:"cell flex"},[n("div",{directives:[{name:"lazy",rawName:"v-lazy:background-image",value:t.img,expression:"item.img",arg:"background-image"}],staticClass:"cover bg"}),n("div",{staticClass:"info"},[n("div",{staticClass:"title"},[e._v(e._s(t.title))]),n("div",{staticClass:"btns"},[n("van-button",{attrs:{size:"mini",type:"primary"},on:{click:function(n){e.onSelect(t)}}},[e._v("选择")])],1)])])])}))],1)],1)},staticRenderFns:[]};var se=n("7jd7")(le,ce,!1,function(e){n("itQq")},"data-v-7063309c",null).exports;n("6VpE"),n("WWTk");o.a.use(d),o.a.use(p),document.querySelector("html").style.fontSize=document.documentElement.offsetWidth/25+"px",o.a.config.productionTip=!1,o.a.component("my-header",x),o.a.component("my-banner",C),o.a.component("my-box",S),o.a.component("my-title",M),o.a.component("my-bottom-bar",P),o.a.component("my-nav-bar",D),o.a.component("my-key-value",q),o.a.component("my-avatar",Q),o.a.component("my-form-select",U),o.a.component("my-form-uploader",ae),o.a.component("my-form-car-model-picker",ee),o.a.component("my-form-valid-code",oe),o.a.component("my-form-car-selector",se);var ue=n("13Ec"),de=n("YTv0");o.a.use(de.a);var he=o.a.component("routerview",{template:"<div class=fullheight><router-view></router-view></div>"}),pe=new de.a({routes:[{path:"",redirect:"/main"},{path:"/main",component:function(){return n.e(18).then(n.bind(null,"3QXn"))},children:[{path:"",redirect:"home"},{path:"home",component:function(){return Promise.all([n.e(0),n.e(3)]).then(n.bind(null,"Hc+b"))}},{path:"car",component:function(){return Promise.all([n.e(0),n.e(2)]).then(n.bind(null,"ppkr"))}},{path:"life",component:function(){return n.e(6).then(n.bind(null,"f+MZ"))}},{path:"profile",component:function(){return n.e(7).then(n.bind(null,"Wp6a"))}}]},{path:"/car",component:he,children:[{path:"detail",component:function(){return n.e(13).then(n.bind(null,"sCYH"))}},{path:"form",component:function(){return Promise.all([n.e(0),n.e(10)]).then(n.bind(null,"RfwK"))}},{path:"param",component:function(){return n.e(16).then(n.bind(null,"/MC1"))}}]},{path:"/my",component:he,children:[{path:"qr",component:function(){return n.e(15).then(n.bind(null,"XS3x"))}},{path:"ioan",component:function(){return n.e(4).then(n.bind(null,"5NO3"))}},{path:"car-insurance",component:function(){return n.e(5).then(n.bind(null,"c9yx"))}},{path:"invite",component:function(){return n.e(23).then(n.bind(null,"4hSK"))}},{path:"mycar",component:function(){return n.e(24).then(n.bind(null,"1zo2"))}},{path:"join",component:function(){return n.e(20).then(n.bind(null,"acEt"))}},{path:"bind",component:function(){return n.e(25).then(n.bind(null,"GlhC"))}},{path:"collect",component:function(){return Promise.all([n.e(0),n.e(17)]).then(n.bind(null,"w9CM"))}}]},{path:"/loan",component:he,children:[{path:"",component:function(){return n.e(21).then(n.bind(null,"YPid"))}},{path:"form",component:function(){return n.e(11).then(n.bind(null,"QLAm"))}}]},{path:"/safe",component:he,children:[{path:"",component:function(){return n.e(9).then(n.bind(null,"N06H"))}},{path:"form",component:function(){return n.e(22).then(n.bind(null,"ys8N"))}}]},{path:"/business",component:he,children:[{path:"",component:function(){return n.e(8).then(n.bind(null,"+RZA"))}},{path:"new",component:function(){return Promise.all([n.e(0),n.e(27)]).then(n.bind(null,"is3c"))}},{path:"edit",component:function(){return n.e(30).then(n.bind(null,"b8B+"))}},{path:"edit/desc",component:function(){return n.e(34).then(n.bind(null,"WBH/"))}},{path:"edit/base-info",component:function(){return Promise.all([n.e(0),n.e(37)]).then(n.bind(null,"UnCt"))}},{path:"edit/base-param",component:function(){return Promise.all([n.e(0),n.e(36)]).then(n.bind(null,"IR0r"))}},{path:"edit/engine-param",component:function(){return Promise.all([n.e(0),n.e(32)]).then(n.bind(null,"c7Nc"))}},{path:"edit/dipan-param",component:function(){return Promise.all([n.e(0),n.e(33)]).then(n.bind(null,"UgGs"))}},{path:"edit/brake-param",component:function(){return Promise.all([n.e(0),n.e(35)]).then(n.bind(null,"cELK"))}},{path:"edit/file-info",component:function(){return Promise.all([n.e(0),n.e(31)]).then(n.bind(null,"uVMV"))}},{path:"edit/images",component:function(){return Promise.all([n.e(0),n.e(19)]).then(n.bind(null,"W3xj"))}},{path:"cars",component:function(){return n.e(1).then(n.bind(null,"+Uq6"))}},{path:"cars",component:function(){return n.e(1).then(n.bind(null,"+Uq6"))}},{path:"salers",component:function(){return n.e(26).then(n.bind(null,"afsw"))}},{path:"info",component:function(){return n.e(29).then(n.bind(null,"563v"))}},{path:"customers",component:function(){return n.e(14).then(n.bind(null,"UqDo"))}},{path:"customers/deal",component:function(){return n.e(28).then(n.bind(null,"pW5F"))}},{path:"qr",component:function(){return n.e(12).then(n.bind(null,"Aa4z"))}}]}]}),fe=n("xag5"),me=["国一","国二","国三","国四","国五","国六"],ve=["两厢轿车","三厢轿车","跑车","SUV","MPV","面包车","皮卡"],ge=["白色","深灰色","橙色","蓝色","紫色","多彩色","黑色","银灰色","红色","绿色","咖啡色","香槟色","黄色"],be=["手动","自动"],ye=["铸铁","铝合金"],xe=["普通","涡轮增压"],we=["汽油","柴油","电动","油电混合","其他"],ke=["92号","95号"],Ce=["通风盘式","鼓式"],_e=["前驱","后驱","四驱"],Se=["机械式液压动力","电子液压助力","电动助力"],Ve=["非独立悬挂","横臂式独立悬挂","多连杆式独立悬挂","纵臂式独立悬挂","烛式独立悬挂","麦弗逊式独立悬挂","主动悬挂"];o.a.use(fe.a);var Te=new fe.a.Store({state:{brands:[],carModels:[],carConfig:a},mutations:{setBrands:function(e,t){e.brands=t},setCarModels:function(e,t){e.carModels=t}},actions:{getBrands:function(e){var t=this,n=e.commit;return j()(R.a.mark(function e(){var a,i;return R.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,o.a.prototype.$http.post("/mobile/car/brands",{p:1});case 3:a=e.sent,i=a.data,n("setBrands",i),e.next=11;break;case 8:e.prev=8,e.t0=e.catch(0),console.log(e.t0);case 11:case"end":return e.stop()}},e,t,[[0,8]])}))()},getCarModels:function(e){var t=this,n=e.commit;return j()(R.a.mark(function e(){var a,i;return R.a.wrap(function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,o.a.prototype.$http.post("/admin/car/cars",{p:1});case 3:a=e.sent,i=a.data,n("setCarModels",i),e.next=11;break;case 8:e.prev=8,e.t0=e.catch(0),console.log(e.t0);case 11:case"end":return e.stop()}},e,t,[[0,8]])}))()}}});Te.dispatch("getBrands"),Te.dispatch("getCarModels");var Me=Te;n("hvYL");ue.e.methods.readFile=function(){return new r.a(function(e){e("")})},o.a.use(ue.f),o.a.use(ue.c),console.log(ue.f),o.a.prototype.success=ue.d.success,o.a.prototype.fail=ue.d.fail,o.a.prototype.alert=function(e){return ue.a.alert({message:e})},o.a.prototype.confirm=function(e){return ue.a.confirm({message:e})},o.a.prototype.ImagePreview=ue.b,o.a.prototype.loading={show:function(e){ue.d.loading({mask:!0,message:e})},clear:function(){ue.d.clear()}},o.a.config.productionTip=!1;var $e=o.a.component("Index",{template:"<div class=frame><router-view></router-view></div>"});new o.a({el:"#app",router:pe,store:Me,components:{Index:$e},template:"<Index />"})},OTaQ:function(e,t){},OaeT:function(e,t){},WWTk:function(e,t){},WuCS:function(e,t){},hvYL:function(e,t){},"ij/3":function(e,t){},itQq:function(e,t){},k8ah:function(e,t){},"r+O4":function(e,t){}},["NHnr"]);
//# sourceMappingURL=app.js.map