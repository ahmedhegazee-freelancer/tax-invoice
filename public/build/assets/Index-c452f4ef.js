import{l as m,y as b,z as f,A as v,c as w,w as c,o as i,d as t,t as e,b as s,a as r,e as d,L as x,g as _,m as y,B as g,F as C,C as k,_ as B,D as I,p as L}from"./app-e352f1f9.js";import{_ as M}from"./AuthenticatedLayout-1edc6954.js";const j={class:"intro-y text-lg font-medium mt-10"},D={class:"grid grid-cols-12 gap-6 mt-5"},N={class:"intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"},T={class:"intro-y col-span-12 overflow-auto lg:overflow-visible"},V={class:"table table-report -mt-2"},$={class:"whitespace-nowrap"},A={class:"whitespace-nowrap"},F={class:"whitespace-nowrap"},R={class:"whitespace-nowrap"},z={class:"whitespace-nowrap"},E={class:"whitespace-nowrap"},O={class:"text-center whitespace-nowrap"},P={class:"table-report__action w-56"},S={class:"flex justify-center items-center"},q=["onClick"],Q={__name:"Index",props:{credentials:Array,branch:Object},setup(h){const n=h,{t:a}=m();return I.branch=n.branch.id,b.value="credential",f.value="dashboard.credential.destroy",v.value="credentials",(p,G)=>{const u=L("Trash2Icon");return i(),w(M,null,{default:c(()=>[t("h2",j,e(s(a)("sidebar.branchs")),1),t("div",D,[t("div",N,[r(s(x),{class:"btn btn-primary shadow-md mr-2",href:p.route("dashboard.credential.create",{branch:n.branch.id})},{default:c(()=>[d(e(s(a)("admin.add")+" "+s(a)("validation.attributes.credential")),1)]),_:1},8,["href"])]),t("div",T,[t("table",V,[t("thead",null,[t("tr",null,[t("th",$,e(s(a)("validation.attributes.id")),1),t("th",A,e(s(a)("validation.attributes.device_serial_number")),1),t("th",F,e(s(a)("validation.attributes.client_id")),1),t("th",R,e(s(a)("validation.attributes.client_secret")),1),t("th",z,e(s(a)("validation.attributes.pos_os_version")),1),t("th",E,e(s(a)("validation.attributes.is_prod")),1),t("th",O,e(s(a)("admin.actions")),1)])]),t("tbody",null,[(i(!0),_(C,null,y(n.credentials,(o,l)=>(i(),_("tr",{key:l,class:"intro-x"},[t("td",null,e(l),1),t("td",null,e(o.device_serial_number),1),t("td",null,e(o.client_id),1),t("td",null,e(o.client_secret),1),t("td",null,e(o.pos_os_version),1),t("td",null,e(o.is_prod),1),t("td",P,[t("div",S,[t("a",{class:"flex items-center text-danger",href:"javascript:;",onClick:H=>s(g)(o.id)},[r(u,{class:"w-4 h-4 mr-1"}),d(" "+e(s(a)("admin.delete")),1)],8,q)])])]))),128))])])])]),r(B,{deleteConfirmationModal:s(k)},null,8,["deleteConfirmationModal"])]),_:1})}}};export{Q as default};
