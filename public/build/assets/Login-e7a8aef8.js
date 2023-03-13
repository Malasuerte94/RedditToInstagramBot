import{u as g,o as i,e as d,b as t,h as s,w as l,F as w,H as h,t as x,f as u,a as o,c as k,g as c,L as y,n as v,m as V}from"./app-8e0074f6.js";import{A as F}from"./AuthenticationCard-68fad505.js";import{_ as $}from"./AuthenticationCardLogo-e460aff7.js";import{_ as B}from"./Checkbox-657f4090.js";import{_ as f,a as p}from"./TextInput-ffb18c2f.js";import{_ as b}from"./InputLabel-5e2ef0e7.js";import{_ as L}from"./PrimaryButton-0ce8e46d.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./logo-f4aaea87.js";const C={key:0,class:"mb-4 font-medium text-sm text-green-600"},N=["onSubmit"],S={class:"mt-4"},q={class:"block mt-4"},P={class:"flex items-center"},R=o("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),U={class:"flex items-center justify-end mt-4"},A=o("a",{type:"button",href:"auth/facebook",class:"ml-2 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-gray transition ease-in-out duration-150"}," Facebook ",-1),J={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(m){const e=g({email:"",password:"",remember:!1}),_=()=>{e.transform(n=>({...n,remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(n,a)=>(i(),d(w,null,[t(s(h),{title:"Log in"}),t(F,null,{logo:l(()=>[t($)]),default:l(()=>[m.status?(i(),d("div",C,x(m.status),1)):u("",!0),o("form",{onSubmit:V(_,["prevent"])},[o("div",null,[t(b,{for:"email",value:"Email"}),t(f,{id:"email",modelValue:s(e).email,"onUpdate:modelValue":a[0]||(a[0]=r=>s(e).email=r),type:"email",class:"mt-1 block w-full",required:"",autofocus:""},null,8,["modelValue"]),t(p,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),o("div",S,[t(b,{for:"password",value:"Password"}),t(f,{id:"password",modelValue:s(e).password,"onUpdate:modelValue":a[1]||(a[1]=r=>s(e).password=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password"},null,8,["modelValue"]),t(p,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),o("div",q,[o("label",P,[t(B,{checked:s(e).remember,"onUpdate:checked":a[2]||(a[2]=r=>s(e).remember=r),name:"remember"},null,8,["checked"]),R])]),o("div",U,[m.canResetPassword?(i(),k(s(y),{key:0,href:n.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:l(()=>[c(" Forgot your password? ")]),_:1},8,["href"])):u("",!0),A,t(L,{class:v(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:l(()=>[c(" Log in ")]),_:1},8,["class","disabled"])])],40,N)]),_:1})],64))}};export{J as default};
