import{l as y,y as k,z as g,A as I,c as C,w as r,o as h,d as e,t as s,b as t,a as n,e as i,L as d,g as p,m as L,B as M,F as B,C as j,_ as N,p as c}from"./app-7a2c5f6c.js";import{_ as T}from"./AuthenticatedLayout-c791908e.js";const V={class:"intro-y text-lg font-medium mt-10"},$={class:"grid grid-cols-12 gap-6 mt-5"},D={class:"intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"},F={class:"intro-y col-span-12 overflow-auto lg:overflow-visible"},P={class:"table table-report -mt-2"},R={class:"whitespace-nowrap"},z={class:"whitespace-nowrap"},A={class:"whitespace-nowrap"},E={class:"whitespace-nowrap"},O={class:"text-center whitespace-nowrap"},S={class:"table-report__action w-56"},q={class:"flex justify-center items-center"},G=["onClick"],H={class:"intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"},W={__name:"Index",props:{branches:Object},setup(u){const _=u,{t:a}=y();return k.value="branch",g.value="dashboard.branch.destroy",I.value="branches",(l,J)=>{const f=c("Trash2Icon"),b=c("LockIcon"),v=c("MapPinIcon"),w=c("ListIcon"),x=c("pagination");return h(),C(T,null,{default:r(()=>[e("h2",V,s(t(a)("sidebar.branchs")),1),e("div",$,[e("div",D,[n(t(d),{class:"btn btn-primary shadow-md mr-2",href:l.route("dashboard.branch.create")},{default:r(()=>[i(s(t(a)("admin.add")+" "+t(a)("validation.attributes.branch")),1)]),_:1},8,["href"])]),e("div",F,[e("table",P,[e("thead",null,[e("tr",null,[e("th",R,s(t(a)("validation.attributes.id")),1),e("th",z,s(t(a)("validation.attributes.name")),1),e("th",A,s(t(a)("validation.attributes.branch_code")),1),e("th",E,s(t(a)("validation.attributes.activity_code")),1),e("th",O,s(t(a)("admin.actions")),1)])]),e("tbody",null,[(h(!0),p(B,null,L(_.branches.data,(o,m)=>(h(),p("tr",{key:m,class:"intro-x"},[e("td",null,s(m),1),e("td",null,s(o.name),1),e("td",null,s(o.branch_code),1),e("td",null,s(o.activity_code),1),e("td",S,[e("div",q,[e("a",{class:"flex items-center text-danger",href:"javascript:;",onClick:K=>t(M)(o.id)},[n(f,{class:"w-4 h-4 mr-1"}),i(" "+s(t(a)("admin.delete")),1)],8,G),n(t(d),{class:"flex items-center mr-3",href:l.route("dashboard.credential.index",{branch:o.id})},{default:r(()=>[n(b,{class:"w-4 h-4 mr-1"}),i(" "+s(t(a)("validation.attributes.credential")),1)]),_:2},1032,["href"]),n(t(d),{class:"flex items-center mr-3",href:l.route("dashboard.address.index",{branch:o.id})},{default:r(()=>[n(v,{class:"w-4 h-4 mr-1"}),i(" "+s(t(a)("validation.attributes.address")),1)]),_:2},1032,["href"]),n(t(d),{class:"flex items-center mr-3",href:l.route("dashboard.branch.invoices.index",{branch:o.id})},{default:r(()=>[n(w,{class:"w-4 h-4 mr-1"}),i(" Invoices ")]),_:2},1032,["href"])])])]))),128))])])]),e("div",H,[n(x,{links:_.branches.links},null,8,["links"])])]),n(N,{deleteConfirmationModal:t(j)},null,8,["deleteConfirmationModal"])]),_:1})}}};export{W as default};
