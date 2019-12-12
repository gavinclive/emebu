(window.webpackJsonp=window.webpackJsonp||[]).push([[29],{65:function(t,s,a){"use strict";a.r(s);var e=a(0),r=a.n(e),o=a(7),i=a.n(o),l=a(10),n=a.n(l),m={middleware:"guest",metaInfo:function(){return{title:this.$t("register")}},data:function(){return{form:new i.a({username:"",name:"",email:"",password:"",password_confirmation:"",role:"",status:"active"}),mustVerifyEmail:!1}},methods:{register:function(){var t;return r.a.async((function(s){for(;;)switch(s.prev=s.next){case 0:return s.next=2,r.a.awrap(this.form.post("/api/register"));case 2:t=s.sent,t.data.status&&n()("#verifyEmail").modal("show");case 5:case"end":return s.stop()}}),null,this)}}},c=a(1),d=Object(c.a)(m,(function(){var t=this,s=t.$createElement,a=t._self._c||s;return a("div",[a("form",{on:{submit:function(s){return s.preventDefault(),t.register(s)},keydown:function(s){return t.form.onKeydown(s)}}},[a("div",{staticClass:"modal fade",attrs:{id:"verifyEmail",tabindex:"-1",role:"dialog","aria-hidden":"true"}},[a("div",{staticClass:"modal-dialog modal-dialog-scrollable modal-dialog-centered",attrs:{role:"document"}},[a("div",{staticClass:"modal-content"},[a("div",{staticClass:"modal-header"},[a("h5",{staticClass:"modal-title"},[t._v(t._s(t.$t("register")))]),t._v(" "),t._m(0)]),t._v(" "),a("div",{staticClass:"modal-body d-flex justify-content-center flex-wrap text-justify"},[a("div",{staticClass:"alert alert-success",attrs:{role:"alert"}},[t._v("\n              "+t._s(t.$t("verify_email_address"))+"\n            ")])])])])]),t._v(" "),a("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[a("div",{staticClass:"col-md-9"},[a("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[a("v-img",{staticClass:"mr-2",attrs:{src:"/dist/assets/type.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),a("select",{directives:[{name:"model",rawName:"v-model",value:t.form.role,expression:"form.role"}],staticClass:"custom-select col-md-11 py-0",class:{"is-invalid":t.form.errors.has("username")},on:{change:function(s){var a=Array.prototype.filter.call(s.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.form,"role",s.target.multiple?a:a[0])}}},[a("option",{attrs:{selected:"",disabled:"",value:""}},[t._v(t._s(t.$t("register_as")))]),t._v(" "),a("option",{attrs:{value:"3"}},[t._v(t._s(t.$t("organizer")))]),t._v(" "),a("option",{attrs:{value:"1"}},[t._v(t._s(t.$t("member")))])])],1),t._v(" "),a("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"role"}})],1)]),t._v(" "),a("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[a("div",{staticClass:"col-md-9"},[a("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[a("v-img",{staticClass:"mr-2",attrs:{src:"1"===t.form.role?"/dist/assets/users.svg":"/dist/assets/user.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.name,expression:"form.name"}],staticClass:"form-control col-md-11",class:{"is-invalid":t.form.errors.has("name")},attrs:{type:"text",name:"name",placeholder:""===t.form.role?t.$t("name"):"2"===t.form.role?t.$t("full_name"):t.$t("organizer_name")},domProps:{value:t.form.name},on:{input:function(s){s.target.composing||t.$set(t.form,"name",s.target.value)}}})],1),t._v(" "),a("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"name"}})],1)]),t._v(" "),a("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[a("div",{staticClass:"col-md-9"},[a("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[a("v-img",{staticClass:"mr-2",attrs:{src:"/dist/assets/mail.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.email,expression:"form.email"}],staticClass:"form-control col-md-11",class:{"is-invalid":t.form.errors.has("email")},attrs:{type:"email",name:"email",placeholder:t.$t("email")},domProps:{value:t.form.email},on:{input:function(s){s.target.composing||t.$set(t.form,"email",s.target.value)}}})],1),t._v(" "),a("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"email"}})],1)]),t._v(" "),a("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[a("div",{staticClass:"col-md-9"},[a("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[a("v-img",{staticClass:"mr-2",attrs:{src:"/dist/assets/key.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.password,expression:"form.password"}],staticClass:"form-control col-md-11",class:{"is-invalid":t.form.errors.has("password")},attrs:{type:"password",name:"password",placeholder:t.$t("password")},domProps:{value:t.form.password},on:{input:function(s){s.target.composing||t.$set(t.form,"password",s.target.value)}}})],1),t._v(" "),a("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"password"}})],1)]),t._v(" "),a("div",{staticClass:"form-group row d-flex justify-content-center mb-0"},[a("div",{staticClass:"col-md-9"},[a("div",{staticClass:"col-md-12 d-flex align-items-center py-1"},[a("v-img",{staticClass:"mr-2",attrs:{src:"/dist/assets/key.svg","max-width":"25","max-height":"25",contain:""}}),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.form.password_confirmation,expression:"form.password_confirmation"}],staticClass:"form-control col-md-11",class:{"is-invalid":t.form.errors.has("password_confirmation")},attrs:{type:"password",name:"password_confirmation",placeholder:t.$t("confirm_password")},domProps:{value:t.form.password_confirmation},on:{input:function(s){s.target.composing||t.$set(t.form,"password_confirmation",s.target.value)}}})],1),t._v(" "),a("has-error",{staticClass:"d-block pl-5 text-left",attrs:{form:t.form,field:"password_confirmation"}})],1)]),t._v(" "),a("div",{staticClass:"form-group row d-flex justify-content-center px-3"},[a("div",{staticClass:"d-flex col-md-12 justify-content-center"},[a("v-button",{staticClass:"col-md-9",attrs:{loading:t.form.busy}},[t._v("\n          "+t._s(t.$t("register"))+"\n        ")])],1)])])])}),[function(){var t=this.$createElement,s=this._self._c||t;return s("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"}},[s("span",{attrs:{"aria-hidden":"true"}},[this._v("×")])])}],!1,null,null,null);s.default=d.exports}}]);