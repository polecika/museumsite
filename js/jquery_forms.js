function s_frm_ooots()
{
    $req_name_otz=$('#otz_name').val();
    $req_text_otz=$('#otz_tex').val();
    
    $error='';

    if($req_name_otz=='')
    {
        $error+='Вы не ввели имя\r\n';
    }
    
    if($req_text_otz=='')
    {
        $error+='Вы не ввели текст отзыва\r\n';
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
            data: "req_name_otz="+$req_name_otz+"&req_text_otz="+$req_text_otz,
            cache: false,
            success: function(html){
                alert(html);
                location.reload(true);
            }
        });
    }
}

function s_frm()
{
    $req_name=$('input[name=name_cl]').val();
    $req_tel=$('input[name=tel_c]').val();
    
    $error='';

    if($req_name=='')
    {
        $error+='Вы не ввели имя\r\n';
    }
    
    if($req_tel=='')
    {
        $error+='Вы не ввели телефон\r\n';
    }
    
    
    if($error!="")
    {
        alert($error);
    }
    else
    {
        var $msg =$('#sfo').find("input[type='hidden'], :input:not(:hidden)").serializeArray();
        $string="";
        
        jQuery.each($msg, function(i, field){
                $string+=field.name+'|'+field.value+";";
        });
        
        $.ajax({
            type: "POST",
            url: "/obr.php",
            datatype: "json",
            data: "msg="+$string,
            cache: false,
            success: function(html){
                alert(html);
                location.reload(true);
            }
        });
    }
}

function s_frm_comms(tovar)
{
    $req_name=$('input[name=name_cl_coms]').val();
    $req_mess=$('input[name=ms_c_coms]').val();
    
    $error='';

    if($req_name=='')
    {
        $error+='Вы не ввели имя\r\n';
    }
    
    if($req_mess=='')
    {
        $error+='Вы не ввели сообщение\r\n';
    }
    
    
    if($error!="")
    {
        alert($error);
    }
    else
    {
        var $msg =$('#sfo_comment').find("input[type='hidden'], :input:not(:hidden)").serializeArray();
        $string="";
        
        jQuery.each($msg, function(i, field){
                $string+=field.name+'|'+field.value+";";
        });
        
        $.ajax({
            type: "POST",
            url: "/obr.php",
            datatype: "json",
            data: "msg_comms="+$string+"&msg_comms_tovar="+tovar,
            cache: false,
            success: function(html){
                alert(html);
                location.reload(true);
            }
        });
    }
}

function op_div(id)
{
	$('td[id^="vk"]').css("border", "none");
	$('#vk'+id).css("border", "1px solid red");
	$('div[id^="d"]').css("display", "none");
	$('#d'+id).css("display", "block");
}


function incart(tid)
{
    
    
    if($("input").is("#spinner"))
    {
        spinner=document.getElementById("spinner").value;
    }
    else
    {
        spinner=1;
    }
    
    
    if(spinner==0)
    {
	alert("Вы не ввели количество");
    }
    else
    {
	$.ajax({
	    type: "POST",
	    url: "/obr.php",
	    data: "sg_id="+tid+"&sg_spi="+spinner,
	    cache: false,
	    success: function(html){
		alert(html);
		location.reload(true);
	    }
	});
    }
}

function cl_scr_ad(act)
{
    if(act==1)
    {
        $("#scrollingDiv").hide();
        $("#scrollingDiv1").show();
    }
    
    if(act==2)
    {
        $("#scrollingDiv").show();
        $("#scrollingDiv1").hide();
    }
}

function send_ma()
{
    s_m_name=$("#s_m_name").val();
    s_m_mail=$("#s_m_mail").val();
    
    err="";
    
    if(s_m_name=="")
    {
        err+="Вы не ввели имя\r\n";
    }
    
    if(s_m_mail=="")
    {
        err+="Вы не ввели email\r\n";
    }
    
    if(err=="")
    {
        $.ajax({
            type: "POST",
            url: "/obr.php",
            data: "s_m_name="+s_m_name+"&s_m_mail="+s_m_mail,
            cache: false,
            success: function(html){
            alert(html);
            location.reload(true);
            }
        });
    }
    else
    {
        alert(err);
    }
}
