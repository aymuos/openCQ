cat = {}
const error = document.querySelector('.error');
const result = document.querySelector('.result');
const input = document.querySelector('#last_name');
const dataList = document.querySelectorAll('main>.row>.col.s8:not(.line)>span,main>.row>.col.s7\\.5>span,main>.row>.col.s8.line>.confirm'); 
const form = document.querySelector('form');
error.style.display = "none";
result.style.display = "none";
form.addEventListener('submit',(e)=>{
    e.preventDefault();
    input.value = input.value.trim();
    if(input.value===""){
        ;
    }
    else{
        updateError("Loading...");
        fetchData(input.value)
        .then(data=>{
            if(data.status==="OK"){
                input.value="";
                updateResult(data.result);
            }
            else{
                updateError(data.comment);
            }
        })
        .catch(e=>updateError(e.message));
    }
})
const fetchData = async(rollNo)=>{
    try{
        let response = await fetch(
            `update1/form_view.php`
            ,
            {
                method: "POST",
                body: JSON.stringify({rollNo}),
                headers:
                {
                  "Content-Type": "application/json"
                } 
            }
        );
        let data = await response.json();
        return data;
    }
    catch(e){
        let status = "FAIL";
        let comment = e.message;
        return {status,comment};
    }
}

const updateResult = (value)=>{
    let data = [
        `${value.name}`,
        `B.tech ${value.semester}<sup>th</sup> semester`,
        `${value.department}`,
        `${value.rollNo}`,
        `${value.regNo}`,
        `<strong>${value.filled_offline_form}</strong>`,
        `${value.compulsory1}`,
        `${value.compulsory2}`,
        `${value.elective1}`,
        `${value.elective2}`,
        `${value.backlog1}`,
        `${value.backlog2}`,
        `${value.backlog3}`,
    ]
    dataList.forEach((value,index)=>{
        
            
        value.innerHTML = data[index];
        if((index==7 && data[2]!="IT") || (data[index]==="" && index>=10)){
            value.parentElement.parentElement.style.display = "none";
        }
        else{
            value.parentElement.parentElement.style.display = "";
        }
        

    })
    result.style.display="";
    error.style.display="none";
}

const updateError = (value)=>{
    error
    .firstElementChild
    .firstElementChild
    .firstElementChild
    .textContent = `${value}`;
    result.style.display="none";
    error.style.display="";
}

