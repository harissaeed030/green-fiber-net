// Cloudflare Worker API for Green Fiber Net website
// Bind a D1 database as DB. Never put secrets/API keys in frontend code.
const cors = {
 "Access-Control-Allow-Origin": "*",
 "Access-Control-Allow-Methods": "GET, POST, OPTIONS",
 "Access-Control-Allow-Headers": "Content-Type"
};
function response(data,status=200){return new Response(JSON.stringify(data),{status,headers:{"Content-Type":"application/json",...cors}})}
export default {
 async fetch(request,env){
  const url=new URL(request.url);
  if(request.method==="OPTIONS")return new Response(null,{headers:cors});
  if(url.pathname==="/api/health"&&request.method==="GET")return response({ok:true,service:"Green Fiber Net API"});
  if(url.pathname==="/api/leads"&&request.method==="POST"){
   try{
    const body=await request.json();
    const name=String(body.name||"").trim().slice(0,100);
    const phone=String(body.phone||"").trim().slice(0,40);
    const requestType=String(body.requestType||"Other").slice(0,50);
    const message=String(body.message||"").trim().slice(0,2000);
    if(!name||!phone||!message)return response({error:"Name, phone and message required"},400);
    await env.DB.prepare("INSERT INTO leads (name, phone, request_type, message, created_at) VALUES (?, ?, ?, ?, datetime('now'))").bind(name,phone,requestType,message).run();
    return response({ok:true});
   }catch(e){return response({error:"Could not save request"},500)}
  }
  return response({error:"Not found"},404);
 }
};