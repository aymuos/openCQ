const main = document.querySelector('main');
const form = document.querySelector('form');
const chapter = document.querySelector('#new_chapter');
// const teacher = document.querySelector("body > div:nth-child(3) > div > div > span > div > div:nth-child(1) > p")
let cat = {};
const fetchChapterAll = 
async()=>{
    let response = await fetch("fetchChapterAll.php");
    if(response.status!=200){
        throw new Error('cannot fetch data');
    }
    let data = await response.json();
    if(data.status!="OK"){
        throw new Error(`${data.comment}`);
    }
    // data.result.forEach(element => {
    //     displayChapter(element.id,element.name,element.numberOfQuestions);
    // });
    return data;
}

const addChapter =
async(text)=>{
    let response = await fetch(
        "addChapter.php",
        {
            method: "POST",
            body: JSON.stringify({text: text}),
            headers:{
                "Content-Type": "application/json"
            }
        }
        );
    if(response.status!=200){
        throw new Error('cannot fetch data');
    }
    let data = await response.json();
    if(data.status!="OK"){
        throw new Error(`${data.comment}`);
    }
    displayChapter(data.id,text,0);
}

const modifyChapter = 
async(id,text,ref)=>{
  let response = await fetch(
    "modifyChapter.php",
    {
        method: "POST",
        body: JSON.stringify({id: id,text: text}),
        headers:{
            "Content-Type": "application/json"
        }
    }
    );
    if(response.status!=200){
        throw new Error('cannot fetch data');
    }
    let data = await response.json();
    if(data.status!="OK"){
        throw new Error(`${data.comment}`);
    }
    displayChapter(id,text,"dummy",ref);
    return;
}
// let catcher = {};
const deleteChapter = 
async(id,ref)=>{
  let response = await fetch(
    "deleteChapter.php",
    {
        method: "POST",
        body: JSON.stringify({id: id}),
        headers:{
            "Content-Type": "application/json"
        }
    }
    );
    if(response.status!=200){
        throw new Error('cannot fetch data');
    }
    let data = await response.json();

    if(data.status!="OK"){
        throw new Error(`${data.comment}`);
    }
    ref.parentElement.parentElement.parentElement.parentElement.remove();
    return;
}
modify = (id)=>{
  let ref = document.querySelector(`[data-id = '${id}']`);
  modifyChapter(id,ref.children[1].value,ref).then(
    ()=>{
      if(ref.classList.contains('edit')){
        ref.classList.toggle('edit');
      }
    }
  ).catch(
    (err)=>{
      sessionStorage.setItem('error',`${err.message}`);
      window.location.href = 'tdberrormessage.htm';
    }
  )
};
const displayChapter = 
(id,text,number,ref=0)=>{
    if(ref===0){
        let chapter = 
        `<div class="row">
        <div class="col s8 offset-s2 ">
          <div class="card subcardsize blue accent-4">
            <div class="card-content white-text">
            <div class="col s8 chapter" data-id=${id}>
              <span class="card-title thick">${text}</span>
              <textarea class="form-control modifyChapter" rows="7" onchange= "modify(${id})">${text}</textarea>
            </div>
             
              <div class="col s1"> <span class="badge"><a class="waves-effect waves-light btn-small black white-text">${number}</a></span></div>
    
               <div class="col s1"><button class="btn-floating  btn-large waves-effect waves-light teal lighten-4 black-text" type="submit" name="action">GO
        <i class="material-icons right">arrow_forward</i>
      </button></div>
    
              <div class="col s1">
                <a class="btn-floating btn-large waves-effect waves-light  green darken-4"><i class="material-icons">edit</i></a>
              </div>
              <div class="col s1">
              <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">delete_forever</i></a>
              </div>
            </div>
          </div>
        </div>
      </div>`;
      main.innerHTML+=chapter;
    }
    else{
        let children = ref.children;
        children[0].textContent = text;
        children[1].textContent = text;
        ref.classList.toggle('edit');
    }
  




};

fetchChapterAll().then(
  (data)=>{
    data.result.forEach(element => {
        displayChapter(element.id,element.name,element.numberOfQuestions);
    });
    
  }
).catch((err)=>{
  sessionStorage.setItem('error',`${err.message}`);
  window.location.href = 'tdberrormessage.htm';
})
let catcher = {};
form.addEventListener('submit',
async(e)=>{
  e.preventDefault();
  addChapter(chapter.value).then(
    ()=>{
      chapter.value = "";
    }
  ).catch(
    (err)=>{
      sessionStorage.setItem('error',`${err.message}`);
      window.location.href = 'tdberrormessage.htm'; 
    }
  )
}
)

main.addEventListener('click',
async(e)=>{
  if(e.target.tagName==="I"){
    if(e.target.parentElement.classList.contains('green')){
      e.target
      .parentElement
      .parentElement
      .parentElement
      .firstElementChild.classList.toggle('edit');
    }
    if(e.target.parentElement.classList.contains('red')){
      let card = e.target
      .parentElement
      .parentElement
      .parentElement
      .firstElementChild;
      deleteChapter(card.getAttribute('data-id'),card)
      .catch(
        (err)=>{
          sessionStorage.setItem('error',`${err.message}`);
          window.location.href = 'tdberrormessage.htm'; 
        }
      )
    }
  }
  else if(e.target.tagName=="BUTTON"){
    // cat = e;
    let card = e.target.parentElement.parentElement.firstElementChild;
    id = card.getAttribute('data-id');
    text = card.firstElementChild.textContent;
    let response = await fetch(
      "redirectQuestion.php",
      {
          method: "POST",
          body: JSON.stringify({id: id,text: text}),
          headers:{
              "Content-Type": "application/json"
          }
      }
      );
      if(response.status!=200){
          throw new Error('cannot fetch data');
      }
      let data = await response.json();
  
      if(data.status!="OK"){
          throw new Error(`${data.comment}`);
      }
      // cat = "success";
      window.location.href = "teacher_view_question.php";
  }

}
)

