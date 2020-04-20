data = {id:120,
    name:"tutoialswebsite",
    address:"Sultanpur, New Delhi",
    phone: 999999999
};
url = "http://localhost/opencq/api/receiver.php";

sendGetRequest(url,data).then(result=>{
    console.log(result);
});
// console.log(result);
async function sendGetRequest(url,data){
    url = url+'?';
    for(let p in data){
        url=url+p+"="+encodeURIComponent(data[p])+"&";
        

    }
    // console.log(typeof url);
    url=url.slice(0,url.length-1);
    let result = await fetch(url).then(success=>{
        if(success.status != 200){
            return null;
        }
        else{
            return success.json();
        }
    },fail=>{
        return null;
    }).then(res=>{
        return res;
    });
    return result;  
}