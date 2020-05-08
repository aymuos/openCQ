
function delete_test(id){
	if(confirm("Are you sure you want to delete the exam?") == true){
		$.get('teacher_exam_delete.php?e='+id,function (data, textStatus){		// success callback
			console.log(data);
			var res = JSON.parse(data);
			//M.toast({html: res.comment+"! :(",classes: 'rounded'});
			if(res.status == "OK"){
				location.reload()
			}
		});
	}
}

function calculate(){
	document.getElementById("nxt").value = +document.getElementById("join").value + 4;
}

function submit(){
	var year = document.getElementById("nxt").value;
	var x=0;
	if(document.getElementById("stream1").checked == true){
		x+=1;
	}
	if(document.getElementById("stream2").checked == true){
		x+=2;
	}if(document.getElementById("stream3").checked == true){
		x+=4;
	}
	var desc = document.getElementById("desc").value;
	$.get('teacher_exam_add.php?year='+year+"&stm="+x+"&desc="+encodeURIComponent(desc),function (data, textStatus){		// success callback
		console.log(data);
		var res = JSON.parse(data);
		//M.toast({html: res.comment+"! :(",classes: 'rounded'});
		if(res.status == "OK"){
			//M.toast({html: res.comment+"! :(",classes: 'rounded'});
			//location.reload()
			$('#modal1').modal('close');
			$('#modal2').modal('open');
		}
		else{
			if(res.comment == "incorrect stream: 0")
			M.toast({html: "Incorrect Stream! :(",classes: 'rounded'});
			else M.toast({html: res.comment+"! :(",classes: 'rounded'});
		}
	});
	
}

function modify_test(x){
	window.location.href = "teacher_modify_test.php?e="+x;
}








