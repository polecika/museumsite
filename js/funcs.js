$(function() {
	$(".phone_recall").mask("+7(999) 999-9999");
});

function s_frm_cart_main(kind)
{
	if(kind==1)
	{
		//с главной
		$inputnamre=$('#inputnamre').val();
		$inputphone=$('#inputphone').val();
		
		$error='';

		if($inputnamre=='')
		{
			$error+='Вы не ввели имя\r\n';
		}
		
		if($inputphone=='')
		{
			$error+='Вы не ввели номер телефона\r\n';
		}
		
		if($error!="")
		{
			alert($error);
		}
		else
		{
			$.ajax({
				type: "POST",
				url: "/obr.php",
				datatype: "json",
				data: "inputnamre="+$inputnamre+"&inputphone="+$inputphone,
				cache: false,
				success: function(html){
					alert(html);
					location.reload(true);
				}
			});
		}
	}
	
	if(kind==2)
	{
		//форма главная горизонтальная
		
		$inputnamre=$('#inputnamre1').val();
		$inputphone=$('#inputphone1').val();
		
		$error='';

		if($inputnamre=='')
		{
			$error+='Вы не ввели имя\r\n';
		}
		
		if($inputphone=='')
		{
			$error+='Вы не ввели номер телефона\r\n';
		}
		
		if($error!="")
		{
			alert($error);
		}
		else
		{
			$.ajax({
				type: "POST",
				url: "/obr.php",
				datatype: "json",
				data: "inputnamre="+$inputnamre+"&inputphone="+$inputphone,
				cache: false,
				success: function(html){
					alert(html);
					location.reload(true);
				}
			});
		}
	}
	
	if(kind==3)
	{
		//форма обратного звонка
		
		$inputnamre=$('#exampleName').val();
		$inputmail=$('#exampleEmail').val();
		
		$error='';

		if($inputnamre=='')
		{
			$error+='Вы не ввели имя\r\n';
		}
		
		if($inputmail=='')
		{
			$error+='Вы не ввели номер телефона\r\n';
		}
		
		if($error!="")
		{
			alert($error);
		}
		else
		{
			$.ajax({
				type: "POST",
				url: "/obr.php",
				datatype: "json",
				data: "inputnamre="+$inputnamre+"&inputmail="+$inputmail+"&inputtext="+$inputtext,
				cache: false,
				success: function(html){
					alert(html);
					location.reload(true);
				}
			});
		}
	}
	
}

function comms(tovar)
{
	alert(tovar);
	$ot_fio=$('#ot_fio').val();
	$ot_mail=$('#ot_mail').val();
	$ot_text=$('#ot_text').val();
	
	$error='';

	if($ot_fio=='')
	{
		$error+='Вы не ввели имя\r\n';
	}
	
	if($ot_mail=='')
	{
		$error+='Вы не ввели email\r\n';
	}
	
	if($ot_text=='')
	{
		$error+='Вы не ввели комментарий\r\n';
	}
	
	if($error!="")
	{
		alert($error);
	}
	else
	{
		$.ajax({
			type: "POST",
			url: "/obr.php",
			datatype: "json",
			data: "ot_fio="+$ot_fio+"&ot_mail="+$ot_mail+"&ot_text="+$ot_text+"&ot_tovar="+tovar,
			cache: false,
			success: function(html){
				alert(html);
				location.reload(true);
			}
		});
	}
}