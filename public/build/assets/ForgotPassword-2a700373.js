import{u,o as r,e as m,b as s,h as a,w as o,F as c,H as f,t as _,f as p,a as t,n as w,g,m as b}from"./app-8e0074f6.js";import{A as y}from"./AuthenticationCard-68fad505.js";import{_ as h}from"./AuthenticationCardLogo-e460aff7.js";import{_ as x,a as k}from"./TextInput-ffb18c2f.js";import{_ as V}from"./InputLabel-5e2ef0e7.js";import{_ as v}from"./PrimaryButton-0ce8e46d.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./logo-f4aaea87.js";const F=t("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1),N={key:0,class:"mb-4 font-medium text-sm text-green-600"},$=["onSubmit"],C={class:"flex items-center justify-end mt-4"},D={__name:"ForgotPassword",props:{status:String},setup(i){const e=u({email:""}),n=()=>{e.post(route("password.email"))};return(S,l)=>(r(),m(c,null,[s(a(f),{title:"Forgot Password"}),s(y,null,{logo:o(()=>[s(h)]),default:o(()=>[F,i.status?(r(),m("div",N,_(i.status),1)):p("",!0),t("form",{onSubmit:b(n,["prevent"])},[t("div",null,[s(V,{for:"email",value:"Email"}),s(x,{id:"email",modelValue:a(e).email,"onUpdate:modelValue":l[0]||(l[0]=d=>a(e).email=d),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"]),s(k,{class:"mt-2",message:a(e).errors.email},null,8,["message"])]),t("div",C,[s(v,{class:w({"opacity-25":a(e).processing}),disabled:a(e).processing},{default:o(()=>[g(" Email Password Reset Link ")]),_:1},8,["class","disabled"])])],40,$)]),_:1})],64))}};export{D as default};
