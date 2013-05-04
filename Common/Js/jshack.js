// 解决框架问题
function reinitIframe(){
 
var iframe = document.getElementById("myframe");
 
try{
 
var bHeight = iframe.contentWindow.document.body.scrollHeight;
 
var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;
 
var height = Math.max(bHeight, dHeight);
 
iframe.height =  height;
 
}catch (ex){}
 
}
 
window.setInterval("reinitIframe()", 200);