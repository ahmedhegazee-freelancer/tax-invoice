import{u as m,c as d,w as t,o as l,a,b as o,H as c,d as e,e as f,n as u,f as p}from"./app-e352f1f9.js";import{_}from"./GuestLayout-2ec3b4c2.js";import{_ as w}from"./InputError-c7ee7193.js";import{_ as b,a as h}from"./TextInput-8ed2db98.js";import{_ as x}from"./PrimaryButton-6fe47f49.js";const g=e("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),V=["onSubmit"],v={class:"flex justify-end mt-4"},F={__name:"ConfirmPassword",setup(y){const s=m({password:""}),i=()=>{s.post(route("password.confirm"),{onFinish:()=>s.reset()})};return(C,r)=>(l(),d(_,null,{default:t(()=>[a(o(c),{title:"Confirm Password"}),g,e("form",{onSubmit:p(i,["prevent"])},[e("div",null,[a(b,{for:"password",value:"Password"}),a(h,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:o(s).password,"onUpdate:modelValue":r[0]||(r[0]=n=>o(s).password=n),required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),a(w,{class:"mt-2",message:o(s).errors.password},null,8,["message"])]),e("div",v,[a(x,{class:u(["ml-4",{"opacity-25":o(s).processing}]),disabled:o(s).processing},{default:t(()=>[f(" Confirm ")]),_:1},8,["class","disabled"])])],40,V)]),_:1}))}};export{F as default};