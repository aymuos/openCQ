cat = {};
function updateStudent(){
    M.toast({html: 'Updating.... Please Wait!  :)',classes:'rounded'});
    // first_name = document.getElementById("first_name").value;
    let name = document.getElementById("name").value;
    // let username = document.getElementById("username").value;
    // let group1 = document.getElementById("group1").value;
    //  address = document.getElementById("address").value;
    let registration_no = document.getElementById("reg_no").value;
    let joining_year = document.getElementById("start_yr").value;
    let email = document.getElementById("email").value;
    let contact_no = document.getElementById("phoneno").value;
    fetch(
        'update_student_details.php'
        ,
        {
            method: "POST",
            body: JSON.stringify({name,department,registration_no,joining_year,email,contact_no}),
            headers:
            {
              "Content-Type": "application/json"
            } 
        }
    )
    .then(
        (response)=>{
            if(response.status!=200){
                throw new Error("cannot fetch data");
            }
            return response.json();
        }
    )
    .then(
        (data)=>{
            if(data.status=="OK"){
                location.href = 'student_dashboard.php';
            }
            else{
                throw new Error(`${data.comment}`);
            }
        }
    )
    .catch(
        (e)=>{
            sessionStorage.setItem('error',`${e.message}`);
            location.href = 'tdberrormessage.htm';
        }
    );

    
}