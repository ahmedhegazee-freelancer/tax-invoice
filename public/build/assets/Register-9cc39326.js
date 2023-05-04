import{u as c,c as p,w as n,o as _,a,b as s,H as w,d as r,e as d,L as g,n as V,f as v}from"./app-e352f1f9.js";import{_ as b}from"./GuestLayout-2ec3b4c2.js";import{_ as t}from"./InputError-c7ee7193.js";import{_ as m,a as i}from"./TextInput-8ed2db98.js";import{_ as y}from"./PrimaryButton-6fe47f49.js";const x=["onSubmit"],k={class:"mt-4"},$={class:"mt-4"},h={class:"mt-4"},q={class:"flex items-center justify-end mt-4"},H={__name:"Register",setup(N){const e=c({name:"",email:"",password:"",password_confirmation:"",terms:!1}),u=()=>{e.post(route("register"),{onFinish:()=>e.reset("password","password_confirmation")})};return(f,o)=>(_(),p(b,null,{default:n(()=>[a(s(w),{title:"Register"}),r("form",{onSubmit:v(u,["prevent"])},[r("div",null,[a(m,{for:"name",value:"Name"}),a(i,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(e).name,"onUpdate:modelValue":o[0]||(o[0]=l=>s(e).name=l),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),a(t,{class:"mt-2",message:s(e).errors.name},null,8,["message"])]),r("div",k,[a(m,{for:"email",value:"Email"}),a(i,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":o[1]||(o[1]=l=>s(e).email=l),required:"",autocomplete:"username"},null,8,["modelValue"]),a(t,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),r("div",$,[a(m,{for:"password",value:"Password"}),a(i,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":o[2]||(o[2]=l=>s(e).password=l),required:"",autocomplete:"new-password"},null,8,["modelValue"]),a(t,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),r("div",h,[a(m,{for:"password_confirmation",value:"Confirm Password"}),a(i,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:s(e).password_confirmation,"onUpdate:modelValue":o[3]||(o[3]=l=>s(e).password_confirmation=l),required:"",autocomplete:"new-password"},null,8,["modelValue"]),a(t,{class:"mt-2",message:s(e).errors.password_confirmation},null,8,["message"])]),r("div",q,[a(s(g),{href:f.route("login"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:n(()=>[d(" Already registered? ")]),_:1},8,["href"]),a(y,{class:V(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:n(()=>[d(" Register ")]),_:1},8,["class","disabled"])])],40,x)]),_:1}))}};export{H as default};