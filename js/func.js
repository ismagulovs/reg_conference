function openbox(id){
	var display = document.getElementById(id).style.display;
	document.getElementById(id).style.display='block';
//	if(display=='none'){
//		document.getElementById(id).style.display='block';
//	}else{
//		document.getElementById(id).style.display='none';
//	}
}
function closebox(id){
	var display = document.getElementById(id).style.display;
	document.getElementById(id).style.display='none';
}
function key(type, id){
	document.getElementById("d"+id).className = "form-group panel panel-default";
	document.getElementById("t"+id).innerHTML = "";
}
function allcheck() {
    var chkBoxes = $("input[name=SelectItem]");
    chkBoxes.prop("checked", !chkBoxes.prop("checked"));
}

 
$( document ).ready(function() {

$('.btn[data-radio-name]').click(function() {
    $('.btn[data-radio-name="'+$(this).data('radioName')+'"]').removeClass('active');
    $('input[name="'+$(this).data('radioName')+'"]').val(
        $(this).text()
    );
});

$('#db_qwerty').click(function() {
	var inname = $('#inname').val();
	var infam = $('#infam').val();
	var infath = $('#infath').val();
	var injob = $('#injob').val();
	var intheme = $('#intheme').val();
	var invist = $('#invist').val();
	var insection = $('#insection').val();
	var inmclass1 = $('#inmclass1').val();
	var inmclass2 = $('#inmclass2').val();
	var instatus = $('#instatus').val();
	var indate = $('#indate').val();
		$.post("http://conference.testcenter.kz/kz/admin", 
		{
			inname : inname,
			infam : infam,
			infath : infath,
			injob : injob,
			intheme : intheme,
			invist : invist,
			insection : insection,
			inmclass1 : inmclass1,
			inmclass2 : inmclass2,
			instatus : instatus,
			indate : indate,
			sql : '1'
		},function(data){
			location.reload();
		});
});

$('.btn[data-checkbox-name]').click(function() {
    $('input[name="'+$(this).data('checkboxName')+'"]').val(
        $(this).hasClass('active') ? 0 : 1
    );
});

$("#btn").click(
	function(){
	document.getElementById("btn").value = "отправка запроса...";
	document.getElementById("btn").disabled = true;
	var fam = '';
	var name = '';
	var fath = '';
	var job  = '';
	var theme = '';
	var email = '';
	var section = '0';
	var vistup = 0;
	var m1 = $('#cm1').val();
	var m2 = $('#cm2').val();
	var sect = $('#sect').val();
	var mclass1 = '0';
	var mclass2 = '0';
	section = $( "input:radio[name=section]:checked" ).val();
	if(sect == 'Да' || sect == 'Иә' || sect == 'Yes'){
		vistup = 1;
	}else{
		vistup = 0;
	}
	if(m1 == 'Да' || m1 == 'Иә' || m1 == 'Yes'){
		mclass1 = 1;
	}else{
		mclass1 = 0;
	}
	
	if(m2 == 'Да' || m2 == 'Иә' || m2 == 'Yes'){
		mclass2 = 1;
	}else{
		mclass2 = 0;
	}
	
	//if(m1 == 'да'){
	//	mclass1 = $( "input:radio[name=mclass1]:checked" ).val();
	//}
	//if(m1 == 'да'){
	//	mclass2 = $( "input:radio[name=mclass2]:checked" ).val();
	//}
	fam = $('#fam').val();
	name = $('#name').val();
	fath = $('#fath').val();
	job  = $('#job').val();
	theme = $('#theme').val();
	email = $('#email').val();
		$.post("./func/func.php", 
		{
			fam: fam,
			name: name,
			fath: fath, 
			job: job,
			theme: theme,
			email: email,
			mclass2: mclass2,
			section: section,
			mclass1: mclass1,
			vistup: vistup
		},function(data){
			if(data.status == 'error'){
				document.getElementById("d"+data.id).className = "form-group panel panel-danger";
				$( "#"+data.id).trigger( "select" );
				var offset = $('#d'+data.id).offset().top;
				$('body').scrollTop(offset);
				document.getElementById("btn").value = "ok";
				document.getElementById("btn").disabled = false;
				document.getElementById("t"+data.id).innerHTML = data.text;
				alert(data.text);
			}else if(data.status == 'error_service'){
				alert("ошибка:"+data.id);			
				document.getElementById("btn").value = "ok";
				document.getElementById("btn").disabled = false;
			}else{
				document.getElementById('dbtn').innerHTML = data.id;
				//'<h3 class="text-center"> на вашу почту было выслано письмо для подтверждения </h3>';
			}
		} , "json");
	}
);

$("#sel_mail").click(
	function(){
	var num =  document.querySelectorAll("input[name=SelectItem]:checked").length;
	var check =  document.querySelectorAll("input[name=SelectItem]:checked");
	var text = document.getElementById("text_email").value;
	var itm = [];
	for(var i = 0; i < num; i++){
		itm[i] = $(check[i]).val();
	}
	$.post("/../func/send_mail.php", 
		{
			id: itm,
			text: text
		},function(data){
			alert(data);
		});
});
});


