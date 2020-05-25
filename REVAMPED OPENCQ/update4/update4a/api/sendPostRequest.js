const pre = document.querySelector('pre');
data = {
    key:"SaranyaIs100%PornStar",
    username:"soumyamukherjee",
    old_password:"root",
    new_password:"iWantToMarryDani",
    category:"2",

};
sendData = xwwwfurlenc(data);
// console.log(sendData);
url = "http://localhost:8080/opencq/api/change_password.php";

sendPostRequest(url,data).then(result=>{
    console.log(result);
    pre.textContent = JSON.stringify(result,null,4);
});

async function sendPostRequest(url,data){
    let result=await fetch(
        url,
        
        {
        method:'POST',
        headers:{
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body:sendData,
        }
        
        ).then(success=>{
        if(success.status != 200){
            return null;
        }
        else{
            return success.json();
        }
    }).then(res=>{
        return res;
    });
    return result;
}

function xwwwfurlenc(srcjson){
    console.log("i fired");
    if(typeof srcjson !== "object")
      if(typeof console !== "undefined"){
        console.log("\"srcjson\" is not a JSON object");
        return null;
      }
    u = encodeURIComponent;
    var urljson = "";
    var keys = Object.keys(srcjson);
    for(var i=0; i <keys.length; i++){
        urljson += u(keys[i]) + "=" + u(""+srcjson[keys[i]]);
        if(i < (keys.length-1))urljson+="&";
    }
    console.log(urljson);
    return urljson;
}