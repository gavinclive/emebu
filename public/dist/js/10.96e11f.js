(window.webpackJsonp=window.webpackJsonp||[]).push([[10],{46:function(t,e,s){"use strict";var r,o,a=s(0),n=s.n(a);function i(t,e){var s=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),s.push.apply(s,r)}return s}function l(t,e,s){return e in t?Object.defineProperty(t,e,{value:s,enumerable:!0,configurable:!0,writable:!0}):t[e]=s,t}function c(t){return(c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function m(t,e,s,r,o,a,n){try{var i=t[a](n),l=i.value}catch(t){return void s(t)}i.done?e(l):Promise.resolve(l).then(r,o)}function d(t,e){var s=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};"object"===c(t)&&(s=t,t=""),s=function(t){for(var e=1;e<arguments.length;e++){var s=null!=arguments[e]?arguments[e]:{};e%2?i(s,!0).forEach((function(e){l(t,e,s[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(s)):i(s).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(s,e))}))}return t}({url:t,title:e,width:600,height:720},s);var r=void 0!==window.screenLeft?window.screenLeft:window.screen.left,o=void 0!==window.screenTop?window.screenTop:window.screen.top,a=window.innerWidth||document.documentElement.clientWidth||window.screen.width,n=window.innerHeight||document.documentElement.clientHeight||window.screen.height;s.left=a/2-s.width/2+r,s.top=n/2-s.height/2+o;var m=Object.keys(s).reduce((function(t,e){return t.push("".concat(e,"=").concat(s[e])),t}),[]).join(","),d=window.open(t,e,m);return window.focus&&d.focus(),d}var u={name:"LoginWithGithub",computed:{githubAuth:function(){return window.config.githubAuth},url:function(){return"/api/oauth/github"}},mounted:function(){window.addEventListener("message",this.onMessage,!1)},beforeDestroy:function(){window.removeEventListener("message",this.onMessage)},methods:{login:(r=n.a.mark((function t(){var e,s;return n.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e=d("",this.$t("login")),t.next=3,this.$store.dispatch("auth/fetchOauthUrl",{provider:"github"});case 3:s=t.sent,e.location.href=s;case 5:case"end":return t.stop()}}),t,this)})),o=function(){var t=this,e=arguments;return new Promise((function(s,o){var a=r.apply(t,e);function n(t){m(a,s,o,n,i,"next",t)}function i(t){m(a,s,o,n,i,"throw",t)}n(void 0)}))},function(){return o.apply(this,arguments)}),onMessage:function(t){t.origin===window.origin&&t.data.token&&(this.$store.dispatch("auth/saveToken",{token:t.data.token}),this.$router.push({name:"home"}))}}},f=s(1),p=Object(f.a)(u,(function(){var t=this.$createElement,e=this._self._c||t;return this.githubAuth?e("button",{staticClass:"btn btn-dark ml-auto",attrs:{type:"button"},on:{click:this.login}},[this._v("\n  "+this._s(this.$t("login_with"))+"\n  "),e("fa",{attrs:{icon:["fab","github"]}})],1):this._e()}),[],!1,null,null,null);e.a=p.exports},66:function(t,e,s){"use strict";s.r(e);var r=s(0),o=s.n(r),a=s(7),n=s.n(a);function i(t,e,s,r,o,a,n){try{var i=t[a](n),l=i.value}catch(t){return void s(t)}i.done?e(l):Promise.resolve(l).then(r,o)}var l,c,m={middleware:"guest",components:{LoginWithGithub:s(46).a},metaInfo:function(){return{title:this.$t("register")}},data:function(){return{form:new n.a({username:"",name:"",email:"",password:"",password_confirmation:"",role:"",status:"active"}),mustVerifyEmail:!1}},methods:{register:(l=o.a.mark((function t(){return o.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,this.form.post("/api/register");case 2:t.sent.data.status&&(this.mustVerifyEmail=!0);case 5:case"end":return t.stop()}}),t,this)})),c=function(){var t=this,e=arguments;return new Promise((function(s,r){var o=l.apply(t,e);function a(t){i(o,s,r,a,n,"next",t)}function n(t){i(o,s,r,a,n,"throw",t)}a(void 0)}))},function(){return c.apply(this,arguments)})}},d=s(1),u=Object(d.a)(m,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"row"},[s("div",{staticClass:"col-lg-8 m-auto"},[t.mustVerifyEmail?s("card",{staticClass:"mt-5",attrs:{title:t.$t("register")}},[s("div",{staticClass:"alert alert-success",attrs:{role:"alert"}},[t._v("\n        "+t._s(t.$t("verify_email_address"))+"\n      ")])]):s("card",{attrs:{title:t.$t("register")}},[s("form",{on:{submit:function(e){return e.preventDefault(),t.register(e)},keydown:function(e){return t.form.onKeydown(e)}}},[s("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[s("div",{staticClass:"col-md-9"},[s("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[s("v-img",{staticClass:"mr-2",attrs:{src:"/dist/assets/type.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),s("select",{directives:[{name:"model",rawName:"v-model",value:t.form.role,expression:"form.role"}],staticClass:"custom-select col-md-11",class:{"is-invalid":t.form.errors.has("role")},on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.form,"role",e.target.multiple?s:s[0])}}},[s("option",{attrs:{selected:"",disabled:"",value:""}},[t._v(t._s(t.$t("register_as")))]),t._v(" "),s("option",{attrs:{value:"3"}},[t._v(t._s(t.$t("organizer")))]),t._v(" "),s("option",{attrs:{value:"1"}},[t._v(t._s(t.$t("attendee")))])])],1),t._v(" "),s("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"role"}})],1)]),t._v(" "),"1"!==t.form.role?s("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[s("div",{staticClass:"col-md-9"},[s("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[s("v-img",{staticClass:"mr-2",attrs:{src:"/dist/assets/gitlab.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.username,expression:"form.username"}],staticClass:"form-control col-md-11",class:{"is-invalid":t.form.errors.has("username")},attrs:{type:"text",name:"username",placeholder:t.$t("username")},domProps:{value:t.form.username},on:{input:function(e){e.target.composing||t.$set(t.form,"username",e.target.value)}}})],1),t._v(" "),s("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"username"}})],1)]):t._e(),t._v(" "),s("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[s("div",{staticClass:"col-md-9"},[s("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[s("v-img",{staticClass:"mr-2",attrs:{src:"3"===t.form.role?"/dist/assets/users.svg":"/dist/assets/user.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.name,expression:"form.name"}],staticClass:"form-control col-md-11",class:{"is-invalid":t.form.errors.has("name")},attrs:{type:"text",name:"name",placeholder:""===t.form.role?t.$t("name"):"1"===t.form.role?t.$t("full_name"):t.$t("organizer_name")},domProps:{value:t.form.name},on:{input:function(e){e.target.composing||t.$set(t.form,"name",e.target.value)}}})],1),t._v(" "),s("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"name"}})],1)]),t._v(" "),s("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[s("div",{staticClass:"col-md-9"},[s("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[s("v-img",{staticClass:"mr-2",attrs:{src:"/dist/assets/mail.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.email,expression:"form.email"}],staticClass:"form-control col-md-11",class:{"is-invalid":t.form.errors.has("email")},attrs:{type:"email",name:"email",placeholder:t.$t("email")},domProps:{value:t.form.email},on:{input:function(e){e.target.composing||t.$set(t.form,"email",e.target.value)}}})],1),t._v(" "),s("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"email"}})],1)]),t._v(" "),s("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[s("div",{staticClass:"col-md-9"},[s("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[s("v-img",{staticClass:"mr-2",attrs:{src:"/dist/assets/key.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.password,expression:"form.password"}],staticClass:"form-control col-md-11",class:{"is-invalid":t.form.errors.has("password")},attrs:{type:"password",name:"password",placeholder:t.$t("password")},domProps:{value:t.form.password},on:{input:function(e){e.target.composing||t.$set(t.form,"password",e.target.value)}}})],1),t._v(" "),s("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"password"}})],1)]),t._v(" "),s("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[s("div",{staticClass:"col-md-9"},[s("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[s("v-img",{staticClass:"mr-2",attrs:{src:"/dist/assets/key.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.password_confirmation,expression:"form.password_confirmation"}],staticClass:"form-control col-md-11",class:{"is-invalid":t.form.errors.has("password_confirmation")},attrs:{type:"password",name:"password_confirmation",placeholder:t.$t("confirm_password")},domProps:{value:t.form.password_confirmation},on:{input:function(e){e.target.composing||t.$set(t.form,"password_confirmation",e.target.value)}}})],1),t._v(" "),s("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"password_confirmation"}})],1)]),t._v(" "),s("div",{staticClass:"form-group row d-flex justify-content-center"},[s("div",{staticClass:"col-md-9 d-flex pl-5"},[s("v-button",{staticClass:"ml-3",attrs:{loading:t.form.busy}},[t._v("\n              "+t._s(t.$t("register"))+"\n            ")])],1)])])])],1)])}),[],!1,null,null,null);e.default=u.exports}}]);