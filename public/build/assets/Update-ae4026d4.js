import{l as b,q as g,u as y,k as h,i as x,c as k,w,o as $,d as t,t as l,b as e,j as u,v as d,a as c,s as q,p as M}from"./app-e352f1f9.js";import{_ as V}from"./AuthenticatedLayout-1edc6954.js";import{_ as F}from"./InputError-c7ee7193.js";import{u as N,c as B,r as C}from"./index.esm-cda8abb8.js";const U={class:"intro-y flex items-center mt-8"},j={class:"text-lg font-medium mr-auto"},D={class:"grid grid-cols-12 gap-6 mt-5"},E={class:"intro-y col-span-12 lg:col-span-6"},I={class:"intro-y box p-5"},S={for:"crud-form-1",class:"form-label"},O={for:"crud-form-1",class:"form-label"},T={class:"text-right mt-5"},J={__name:"Update",props:{setting:{type:Object,required:!0}},setup(m){const i=m,{t:o}=b();g(null);const s=y({value:"",key:""}),p=h(()=>({value:{required:B.withMessage(o("validation.required",{attribute:"value"}),C)}})),n=N(p,s),v=async()=>{await n.value.$validate()&&s.put(route("dashboard.business-setting.update",{setting:i.setting.id}),{onSuccess:()=>{q.Inertia.visit(route("dashboard.business-setting.index"))}})};return x(()=>{s.value=i.setting.value,s.key=i.setting.key}),(f,a)=>{const _=M("FrontErrorMessage");return $(),k(V,null,{default:w(()=>[t("div",U,[t("h2",j,l(e(o)("admin.add")+" "+e(o)("validation.attributes.setting")),1)]),t("div",D,[t("div",E,[t("div",I,[t("div",null,[t("label",S,l(e(o)("validation.attributes.key")),1),u(t("input",{id:"crud-form-1",type:"text",class:"form-control w-full",disabled:"","onUpdate:modelValue":a[0]||(a[0]=r=>e(s).key=r),placeholder:"Name"},null,512),[[d,e(s).key]])]),t("div",null,[t("label",O,l(e(o)("validation.attributes.value")),1),u(t("input",{id:"crud-form-1",type:"text",class:"form-control w-full","onUpdate:modelValue":a[1]||(a[1]=r=>e(s).value=r),placeholder:"Name"},null,512),[[d,e(s).value]]),c(F,{class:"mt-2",message:e(s).errors.value},null,8,["message"]),c(_,{errors:e(n).value.$errors},null,8,["errors"])]),t("div",T,[t("button",{type:"button",class:"btn btn-primary w-24",onClick:a[2]||(a[2]=r=>v())},l(e(o)("admin.update")),1)])])])])]),_:1})}}};export{J as default};