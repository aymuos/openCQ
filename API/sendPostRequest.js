data = {id:120,
    name:"tutoialswebsite",
    address:"Sultanpur, New Delhi",
    phone: 999999999
};
sendData = xwwwfurlenc(data);
// console.log(sendData);
url = "http://localhost/opencq/api/receiver.php";

sendPostRequest(url,data).then(result=>{
    console.log(result);
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