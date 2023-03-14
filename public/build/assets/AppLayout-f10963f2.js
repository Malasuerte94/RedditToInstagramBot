import{o,e as a,a as e,d as M,j as x,k as L,l as D,h as i,n as m,f as p,t as y,m as k,p as F,q as E,r as f,s as C,v as B,x as P,b as l,w as r,T as I,c as v,L as j,H as O,g as u,F as $,i as N,y as z}from"./app-1de24da3.js";import{_ as V}from"./logo-f4aaea87.js";import{_ as H}from"./_plugin-vue_export-helper-c27b6911.js";const R={},U={class:"flex items-center justify-center"},q=e("img",{class:"w-10 animate-spin",src:V,alt:""},null,-1),G=[q];function J(d,n){return o(),a("div",U,G)}const K=H(R,[["render",J]]),Q={class:"max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8"},W={class:"flex items-center justify-between flex-wrap"},X={class:"w-0 flex-1 flex items-center min-w-0"},Y={key:0,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},Z=e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),ee=[Z],te={key:1,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},se=e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"},null,-1),oe=[se],re={class:"ml-3 font-medium text-sm text-white truncate"},ne={class:"shrink-0 sm:ml-3"},ae=e("svg",{class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18L18 6M6 6l12 12"})],-1),ie=[ae],le={__name:"Banner",setup(d){const n=M(!0),s=x(()=>{var t;return((t=L().props.value.jetstream.flash)==null?void 0:t.bannerStyle)||"success"}),h=x(()=>{var t;return((t=L().props.value.jetstream.flash)==null?void 0:t.banner)||""});return D(h,async()=>{n.value=!0}),(t,_)=>(o(),a("div",null,[n.value&&i(h)?(o(),a("div",{key:0,class:m({"bg-indigo-500":i(s)=="success","bg-red-700":i(s)=="danger"})},[e("div",Q,[e("div",W,[e("div",X,[e("span",{class:m(["flex p-2 rounded-lg",{"bg-indigo-600":i(s)=="success","bg-red-600":i(s)=="danger"}])},[i(s)=="success"?(o(),a("svg",Y,ee)):p("",!0),i(s)=="danger"?(o(),a("svg",te,oe)):p("",!0)],2),e("p",re,y(i(h)),1)]),e("div",ne,[e("button",{type:"button",class:m(["-mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition",{"hover:bg-indigo-600 focus:bg-indigo-600":i(s)=="success","hover:bg-red-600 focus:bg-red-600":i(s)=="danger"}]),"aria-label":"Dismiss",onClick:_[0]||(_[0]=k(c=>n.value=!1,["prevent"]))},ie,2)])])])],2)):p("",!0)]))}},de={class:"relative"},A={__name:"Dropdown",props:{align:{type:String,default:"right"},width:{type:String,default:"48"},contentClasses:{type:Array,default:()=>["py-1","bg-white"]}},setup(d){const n=d;let s=M(!1);const h=c=>{s.value&&c.key==="Escape"&&(s.value=!1)};F(()=>document.addEventListener("keydown",h)),E(()=>document.removeEventListener("keydown",h));const t=x(()=>({48:"w-48"})[n.width.toString()]),_=x(()=>n.align==="left"?"origin-top-left left-0":n.align==="right"?"origin-top-right right-0":"origin-top");return(c,g)=>(o(),a("div",de,[e("div",{onClick:g[0]||(g[0]=T=>C(s)?s.value=!i(s):s=!i(s))},[f(c.$slots,"trigger")]),B(e("div",{class:"fixed inset-0 z-40",onClick:g[1]||(g[1]=T=>C(s)?s.value=!1:s=!1)},null,512),[[P,i(s)]]),l(I,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:r(()=>[B(e("div",{class:m(["absolute z-50 mt-2 rounded-md shadow-lg",[i(t),i(_)]]),style:{display:"none"},onClick:g[2]||(g[2]=T=>C(s)?s.value=!1:s=!1)},[e("div",{class:m(["rounded-md ring-1 ring-black ring-opacity-5",d.contentClasses])},[f(c.$slots,"content")],2)],2),[[P,i(s)]])]),_:3})]))}},ue={key:0,type:"submit",class:"block w-full px-4 py-2 text-sm leading-5 text-gray-700 text-left hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"},ce=["href"],w={__name:"DropdownLink",props:{href:String,as:String},setup(d){return(n,s)=>(o(),a("div",null,[d.as=="button"?(o(),a("button",ue,[f(n.$slots,"default")])):d.as=="a"?(o(),a("a",{key:1,href:d.href,class:"block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"},[f(n.$slots,"default")],8,ce)):(o(),v(i(j),{key:2,href:d.href,class:"block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"},{default:r(()=>[f(n.$slots,"default")]),_:3},8,["href"]))]))}},S={__name:"NavLink",props:{href:String,active:Boolean},setup(d){const n=d,s=x(()=>n.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition");return(h,t)=>(o(),v(i(j),{href:d.href,class:m(i(s))},{default:r(()=>[f(h.$slots,"default")]),_:3},8,["href","class"]))}},b={__name:"ResponsiveNavLink",props:{active:Boolean,href:String,as:String},setup(d){const n=d,s=x(()=>n.active?"block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition":"block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition");return(h,t)=>(o(),a("div",null,[d.as=="button"?(o(),a("button",{key:0,class:m([i(s),"w-full text-left"])},[f(h.$slots,"default")],2)):(o(),v(i(j),{key:1,href:d.href,class:m(i(s))},{default:r(()=>[f(h.$slots,"default")]),_:3},8,["href","class"]))]))}},he={class:"min-h-screen bg-gray-100"},pe={class:"bg-white border-b border-gray-100"},me={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},fe={class:"flex justify-between h-16"},ge={class:"flex"},ve={class:"shrink-0 flex items-center"},_e={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},be={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},ye={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},we={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},xe={class:"hidden sm:flex sm:items-center sm:ml-6"},ke={class:"ml-3 relative"},$e={class:"inline-flex rounded-md"},Se={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"},je=e("svg",{class:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"})],-1),Ce={class:"w-60"},Me=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Team ",-1),Te=e("div",{class:"border-t border-gray-100"},null,-1),Le=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Switch Teams ",-1),Be=["onSubmit"],Pe={class:"flex items-center"},Ne={key:0,class:"mr-2 h-5 w-5 text-green-400",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},ze=e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),Ae=[ze],De={class:"ml-3 relative"},Fe={key:0,class:"flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"},Ee=["src","alt"],Ie={key:1,class:"inline-flex rounded-md"},Oe={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"},Ve=e("svg",{class:"ml-2 -mr-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M4.5 12.75l6 6 9-13.5"})],-1),He=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Account ",-1),Re=e("div",{class:"border-t border-gray-100"},null,-1),Ue=["onSubmit"],qe={class:"-mr-2 flex items-center sm:hidden"},Ge={class:"h-6 w-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},Je={class:"pt-2 pb-3 space-y-1"},Ke={class:"pt-4 pb-1 border-t border-gray-200"},Qe={class:"flex items-center px-4"},We={key:0,class:"shrink-0 mr-3"},Xe=["src","alt"],Ye={class:"font-medium text-base text-gray-800"},Ze={class:"font-medium text-sm text-gray-500"},et={class:"mt-3 space-y-1"},tt=["onSubmit"],st=e("div",{class:"border-t border-gray-200"},null,-1),ot=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Team ",-1),rt=e("div",{class:"border-t border-gray-200"},null,-1),nt=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Switch Teams ",-1),at=["onSubmit"],it={class:"flex items-center"},lt={key:0,class:"mr-2 h-5 w-5 text-green-400",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},dt=e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),ut=[dt],ct={key:0,class:"bg-white shadow"},ht={class:"max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"},gt={__name:"AppLayout",props:{title:String},setup(d){const n=M(!1),s=t=>{z.Inertia.put(route("current-team.update"),{team_id:t.id},{preserveState:!1})},h=()=>{z.Inertia.post(route("logout"))};return(t,_)=>(o(),a("div",null,[l(i(O),{title:d.title},null,8,["title"]),l(le),e("div",he,[e("nav",pe,[e("div",me,[e("div",fe,[e("div",ge,[e("div",ve,[l(i(j),{href:t.route("dashboard")},{default:r(()=>[l(K,{class:"block h-9 w-auto"})]),_:1},8,["href"])]),e("div",_e,[l(S,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:r(()=>[u(" Dashboard ")]),_:1},8,["href","active"])]),e("div",be,[l(S,{href:t.route("posts"),active:t.route().current("posts")},{default:r(()=>[u(" Posts ")]),_:1},8,["href","active"])]),e("div",ye,[l(S,{href:t.route("reddit-scraper"),active:t.route().current("reddit-scraper")},{default:r(()=>[u(" Reddit Scraper ")]),_:1},8,["href","active"])]),e("div",we,[l(S,{href:t.route("instagram-uploader"),active:t.route().current("instagram-uploader")},{default:r(()=>[u(" Instagram Uploader ")]),_:1},8,["href","active"])])]),e("div",xe,[e("div",ke,[t.$page.props.jetstream.hasTeamFeatures?(o(),v(A,{key:0,align:"right",width:"60"},{trigger:r(()=>[e("span",$e,[e("button",Se,[u(y(t.$page.props.user.current_team.name)+" ",1),je])])]),content:r(()=>[e("div",Ce,[t.$page.props.jetstream.hasTeamFeatures?(o(),a($,{key:0},[Me,l(w,{href:t.route("teams.show",t.$page.props.user.current_team)},{default:r(()=>[u(" Team Settings ")]),_:1},8,["href"]),t.$page.props.jetstream.canCreateTeams?(o(),v(w,{key:0,href:t.route("teams.create")},{default:r(()=>[u(" Create New Team ")]),_:1},8,["href"])):p("",!0),Te,Le,(o(!0),a($,null,N(t.$page.props.user.all_teams,c=>(o(),a("form",{key:c.id,onSubmit:k(g=>s(c),["prevent"])},[l(w,{as:"button"},{default:r(()=>[e("div",Pe,[c.id==t.$page.props.user.current_team_id?(o(),a("svg",Ne,Ae)):p("",!0),e("div",null,y(c.name),1)])]),_:2},1024)],40,Be))),128))],64)):p("",!0)])]),_:1})):p("",!0)]),e("div",De,[l(A,{align:"right",width:"48"},{trigger:r(()=>[t.$page.props.jetstream.managesProfilePhotos?(o(),a("button",Fe,[e("img",{class:"h-8 w-8 rounded-full object-cover",src:t.$page.props.user.profile_photo_url,alt:t.$page.props.user.name},null,8,Ee)])):(o(),a("span",Ie,[e("button",Oe,[u(y(t.$page.props.user.name)+" ",1),Ve])]))]),content:r(()=>[He,l(w,{href:t.route("profile.show")},{default:r(()=>[u(" Profile ")]),_:1},8,["href"]),t.$page.props.jetstream.hasApiFeatures?(o(),v(w,{key:0,href:t.route("api-tokens.index")},{default:r(()=>[u(" API Tokens ")]),_:1},8,["href"])):p("",!0),Re,e("form",{onSubmit:k(h,["prevent"])},[l(w,{as:"button"},{default:r(()=>[u(" Log Out ")]),_:1})],40,Ue)]),_:1})])]),e("div",qe,[e("button",{class:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition",onClick:_[0]||(_[0]=c=>n.value=!n.value)},[(o(),a("svg",Ge,[e("path",{class:m({hidden:n.value,"inline-flex":!n.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),e("path",{class:m({hidden:!n.value,"inline-flex":n.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),e("div",{class:m([{block:n.value,hidden:!n.value},"sm:hidden"])},[e("div",Je,[l(b,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:r(()=>[u(" Dashboard ")]),_:1},8,["href","active"])]),e("div",Ke,[e("div",Qe,[t.$page.props.jetstream.managesProfilePhotos?(o(),a("div",We,[e("img",{class:"h-10 w-10 rounded-full object-cover",src:t.$page.props.user.profile_photo_url,alt:t.$page.props.user.name},null,8,Xe)])):p("",!0),e("div",null,[e("div",Ye,y(t.$page.props.user.name),1),e("div",Ze,y(t.$page.props.user.email),1)])]),e("div",et,[l(b,{href:t.route("profile.show"),active:t.route().current("profile.show")},{default:r(()=>[u(" Profile ")]),_:1},8,["href","active"]),t.$page.props.jetstream.hasApiFeatures?(o(),v(b,{key:0,href:t.route("api-tokens.index"),active:t.route().current("api-tokens.index")},{default:r(()=>[u(" API Tokens ")]),_:1},8,["href","active"])):p("",!0),e("form",{method:"POST",onSubmit:k(h,["prevent"])},[l(b,{as:"button"},{default:r(()=>[u(" Log Out ")]),_:1})],40,tt),t.$page.props.jetstream.hasTeamFeatures?(o(),a($,{key:1},[st,ot,l(b,{href:t.route("teams.show",t.$page.props.user.current_team),active:t.route().current("teams.show")},{default:r(()=>[u(" Team Settings ")]),_:1},8,["href","active"]),t.$page.props.jetstream.canCreateTeams?(o(),v(b,{key:0,href:t.route("teams.create"),active:t.route().current("teams.create")},{default:r(()=>[u(" Create New Team ")]),_:1},8,["href","active"])):p("",!0),rt,nt,(o(!0),a($,null,N(t.$page.props.user.all_teams,c=>(o(),a("form",{key:c.id,onSubmit:k(g=>s(c),["prevent"])},[l(b,{as:"button"},{default:r(()=>[e("div",it,[c.id==t.$page.props.user.current_team_id?(o(),a("svg",lt,ut)):p("",!0),e("div",null,y(c.name),1)])]),_:2},1024)],40,at))),128))],64)):p("",!0)])])],2)]),t.$slots.header?(o(),a("header",ct,[e("div",ht,[f(t.$slots,"header")])])):p("",!0),e("main",null,[f(t.$slots,"default")])])]))}};export{gt as _};