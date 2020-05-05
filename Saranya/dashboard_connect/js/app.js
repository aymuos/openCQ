const main = document.querySelector('main');
const addButton = document.querySelector('#selector>div>button');
const inputBox = document.getElementById("inp");
const heading = document.querySelector('h2.tname');
let catcher = {};
main.addEventListener('click',async(e)=>{
    try{

        if(e.target.tagName=="BUTTON"){
                
            codeToDelete = e.target.parentElement.parentElement.firstElementChild.textContent;
            let response = await fetch('codeDelete.php',
            {
                method:"POST",
                body: JSON.stringify({code: codeToDelete}),
                headers:{
                    "Content-Type": "application/json"
                }
            }
            );
            if(response.status!=200){
                throw new Error('cannot fetch data');
            }
            let data = await response.json();
            if(data.status=="OK"){
                obj[`${codeToDelete}`] = [codes.disp[`${codeToDelete}`],0];
                delete codes.disp[`${codeToDelete}`];
                codes.display();
                reload_list();
            }
            else{
                throw new Error(`${data.comment}`);
            }
        }
    }
    catch(e){
        //redirect
        sessionStorage.setItem('error',`${e.message}`);
        Redirect();
    }

})
addButton.addEventListener('click',
async()=>{
    subCodes = {
        codes: []
    }
    const inputs = document.querySelectorAll('#long-list>div');
    inputs.forEach(
        (element)=>{
            marked = element.firstElementChild;
            if(marked.checked){
                subCodes.codes.push(marked.value);
                element.remove();
            }
        }
    )
    
    try{

        let response = await fetch('addCodes.php',
        {
            method: "POST",
            body: JSON.stringify(subCodes),
            headers:{
                "Content-Type": "application/json"
            }
        }
        );
        if(response.status!=200){
            throw new Error('cannot fetch data');
        }
        data = await response.json();
        data = JSON.parse(data);
        if(data.status!="OK"){
            throw new Error(`${data.comment}`);
        }
        subCodes.codes.forEach((element)=>{
            codes.disp[`${element}`]=obj[`${element}`][0];
            delete obj[`${element}`];
        })
        codes.display();
        inputBox.value="";
    }
    catch(e){
        sessionStorage.setItem('error',`${e.message}`);
        Redirect();
    }
}
)
class Droppings{
    constructor(ref,tcodes,obj){
        this.ref = ref;
        this.tcodes = tcodes;
        this.obj = obj;
    }
    async init(){
        const response = await fetch('fetchCodesAll.php')
        if(response.status!=200){
            throw new Error("cannot fetch data");
        }
        // return response;
        let data =  await response.json();
        if(data.status!="OK"){
            throw new Error(`${data.comment}`);
        }
        let tc = new Set(this.tcodes.map(a=>a.code));
        // console.log(tc);
        // console.log(data);
        data = data.result.filter((element) => {
            let code = element.code;
            let name = element.name;
            return !tc.has(code);
        },tc);
        return data; 
    }
}
class Codes{
    constructor(ref){
        this.ref = ref;
        this.obj = [];
        this.disp = {};
    }
    async init(){
        const response = await fetch('fetchCodes.php')
        if(response.status!=200){
            throw new Error("cannot fetch data");
        }
        // return response;
        let data =  await response.json();
        // data = JSON.parse(data);
        if(data.status!="OK"){
            throw new Error(`${data.comment}`);
        }
        return data.result;
    }
    display(){
        this.ref.innerHTML = "";
        let cardKeys = Object.keys(codes.disp);
        cardKeys.sort(); 
        cardKeys.forEach(
            (element)=>{
                this.ref.innerHTML+=`<div class="card w-50 p-3 mt-4 mx-auto">
                <div class="card-header">
                  Subject Details
                </div>
                <div class="card-body ">
                  <h3 class="card-title ">${element}</h5>
                  <p class="card-text">${codes.disp[element]}</p>
                  <a href="#" class="btn btn-primary">Continue</a>
                  <div class="text-right">
                  <button class="btn btn-danger btn-rounded ">DELETE SUBJECT <i class="far fa-trash-alt"></i></button>
                    </div>
                </div>
              </div> `;
            }
        );
    }
}
codes = new Codes(main);
codes.init()
.then(
    (data)=>{
        // console.log(data);
        codes.obj = data;
        codes.obj.forEach(element=>{
            codes.disp[`${element.code}`]=`${element.name}`;
        });
        codes.display();
        let drop = new Droppings(20,codes.obj,obj);
        drop.init()
        .then(objArr=>{
            objArr.forEach(element => {
                drop.obj[`${element.code}`]=[`${element.name}`,0];
            });
        })
        .catch(
            (err)=>{
                sessionStorage.setItem('error',`${err.message}`);
                Redirect();
            }
        )
    }
)
.catch(
    (err)=>{
        sessionStorage.setItem('error',`${err.message}`);
        Redirect();
    }
);


fetch('findingNimo.php').then(
    (response)=>{
        if(response.status===200){

            response.json().then(
                (data)=>{
                    
    
                    heading.textContent=`Welcome, Faculty ${data.name}`;
        
    
                }
            )
        }
        else{
            heading.textContent=`Welcome, Faculty X`;
        }
    }
).catch(
    ()=>{heading.textContent=`Welcome, Faculty X`}
);


