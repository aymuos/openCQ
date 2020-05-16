const pre = document.querySelector('pre');

data = {
    key:"SaranyaIs100%PornStar",
    stream:"1",
    batch_passout_year:"1",
    joining_year:"1"
};
url = "http://localhost:8080/opencq/api/student_group_info.php";

sendGetRequest(url,data).then(result=>{
    console.log(result);
    pre.textContent = JSON.stringify(result,null,4);
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
            console.log(success);
            return success.json();
        }
    },fail=>{
        return null;
    }).then(res=>{
        return res;
    }).catch(err=>console.log(err));
    return result;  
}