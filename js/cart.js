$(function() {
    //чтобы работали спиннеры
    
    $( ".km" ).css( "display", "none" );
    
    var spinner = $("input[class^='spinner']").spinner({
        min:1,
        stop: function( event, ui ) 
        {
            $name=$(document.activeElement).attr("name");
            $arr=$name.split("_");
            $idt=$arr[1];
            $new_value=$("input[name='"+$name+"']").val();
            
            //обновляем значения сессии
            $.ajax({
                type: "POST",
                url: "/obr.php",
                data: "ncart_id="+$idt+"&ncart_spinner="+$new_value,
                cache: false,
                success: function(html){
                    //сумму рядом с товаром
                    $(".load_price_item_"+$idt).load("/obr.php",{ncart_price:$idt, ncart_price_spinner:$new_value});
                    $("div[name='prt']").load("/obr.php",{prt:$prt});
                    //тут надо обновить итоговую сумму
                    
                    var myradio = $('input:radio[name=adresat]:checked').val();
                    
                    if(myradio==1)
                    {
                        //Москва-МКАД
                        $city=$('input:radio[name=city]:checked').val();
                        
                        if($city==1)
                        {
                            $prt_d=1;
                            $("div[name='prt_d']").load("/obr.php",{prt_d:$prt_d});
                            $prt_i=1;
                            $("div[name='prt_i']").load("/obr.php",{prt_i:$prt_i});
                        }
                        
                        if($city==2)
                        {
                            $range=$( "#slider-range-max" ).slider( "value" );
                            $prt_d=2;
                            $("div[name='prt_d']").load("/obr.php",{prt_d:$prt_d, prt_d_km:$range});
                            $prt_i=2;
                            $("div[name=prt_i]").load("/obr.php",{prt_i:$prt_i, prt_i_km:$range});
                        }
                    }
                    
                    if(myradio==3)
                    {
                        //самовывоз
                        $prt_d=1;
                        $("div[name='prt_d']").load("/obr.php",{prt_d:$prt_d});
                        $prt_i=1;
                        $("div[name='prt_i']").load("/obr.php",{prt_i:$prt_i});
                    }
                    
                    //$prt_i=1;
                    //$("div[name='prt_i']").load("/obr.php",{prt_i:$prt_i});
                }
            });
        }
    });
    
    //изначально стоимость корзины
    $prt=1;
    $("div[name='prt']").load("/obr.php",{prt:$prt});
    
    //
    $("#phone_recall").mask("+7(999) 999-9999");
    $( "#datepicker" ).datepicker($.datepicker.regional["ru"]);
    $( "#slider-range" ).slider({
          range: true,
          min: 0,
          max: 24,
          values: [ 5, 22 ],
          slide: function( event, ui ) {
            $( "#amount" ).val("с " + ui.values[0] + ":00 до " + ui.values[1]+":00" );
            $("input[name=time_c_from]").val(ui.values[0]);
            $("input[name=time_c_to]").val(ui.values[1]);
          }
    });
    $( "#amount" ).val( "С " + $( "#slider-range" ).slider( "values", 0 ) +":00 до " + $( "#slider-range" ).slider( "values", 1 )+":00");
    $( "input[name=time_c_from]" ).val($( "#slider-range" ).slider( "values", 0 ));
    $( "input[name=time_c_to]" ).val($( "#slider-range" ).slider( "values", 1 ));
    
    //способ доставки
    $("input[name=adresat]:radio").change(function () {
        $fun= $('input[name=adresat]:checked').val();
        
        //самовывоз
        if($fun==3)
        {
            $("#adr_mos_mkad").css( "display", "none" );
            $("#adr_info").html("");
            
            $("#adr_info_sam").load("/obr.php",{adr_info_sam:$fun});
            
            
        }
        
        if($fun==1)
        {
            $("#adr_info_sam").html("");
            $("#adr_mos_mkad").css( "display", "block" );
        }
    })
    
    
    $("input[name=city]:radio").change(function () {
        $city= $("input[name=city]:checked").val();
        if($city==2)
        {
            $( ".km" ).css( "display", "block" );
            $range=1;
            //обновление доставки
            $prt_d=2;
            $("div[name='prt_d']").load("/obr.php",{prt_d:$prt_d, prt_d_km:$range});
            $prt_i=2;
            $("div[name=prt_i]").load("/obr.php",{prt_i:$prt_i, prt_i_km:$range});
        }
        else
        {
            $( ".km" ).css( "display", "none" );
            
            //обновление доставки
            $prt_d=1;
            $("div[name='prt_d']").load("/obr.php",{prt_d:$prt_d});
            $prt_i=1;
            $("div[name='prt_i']").load("/obr.php",{prt_i:$prt_i});
        }
    });
    
    
    $( "#slider-range-max" ).slider({
        range: "max",
        min: 1,
        max: 100,
        value: 1,
        slide: function( event, ui ) {
            $( "#amount1" ).val( ui.value+" км. от МКАД (15 руб/км - свыше 10 км.)" );
            $( "input[name=km_mkad]" ).val(ui.value);
            $prt_d=2;
            $("div[name=prt_d]").load("/obr.php",{prt_d:$prt_d, prt_d_km:ui.value});
            
            $range=ui.value;
            //alert($range);
            
            //проблема тут
            //$("div[name=prt_i]").load("/obr.php",{prt_i:$prt_d, prt_i_km:ui.value});
            
            $prt_i=2;
            $("div[name=prt_i]").load("/obr.php",{prt_i:$prt_i, prt_i_km:$range});
            
        }
    });
    
    $( "#amount1" ).val($( "#slider-range-max" ).slider( "value" )+" км. от МКАД (15 руб/км - свыше 10 км.)" );
    $( "input[name=km_mkad]" ).val($( "#slider-range-max" ).slider( "value" ));
    
    $( "#slider-range-max" ).css("width", "410px");
    $( "#slider-range-max" ).css("margin-left", "5px");
    
    $("input[name=order_pay]:radio").change(function () {
        $pay= $('input[name=order_pay]:checked').val();
        if($pay==1)
        {
           $( "#h_cash" ).css( "display", "block" );
        }
        else
        {
           $( "#h_cash" ).css( "display", "none" );
        }
    });
    
    
    $prt_d=1;
    $("div[name='prt_d']").load("/obr.php",{prt_d:$prt_d});
    
    $prt_i=1;
    $("div[name='prt_i']").load("/obr.php",{prt_i:$prt_i});
    
});

function del_t_list(item)
{
    $.ajax({
        type: "POST",
        url: "/obr.php",
        data: "dki="+item,
        cache: false,
        success: function(html){
            if(html!=0)
            {
                $("div[name="+item+"]").empty();
                $("div[name="+item+"]").remove();
                
                //пересчет стоимости товаров
                $prt=1;
                $("div[name='prt']").load("/obr.php",{prt:$prt});
                
                
                        
                $city_ch= $("input[name=city]:checked").val();
                if($city_ch==1)
                {
                    $prt_i=1;
                    $("div[name='prt_i']").load("/obr.php",{prt_i:$prt_i});
                }
                if($city_ch==2)
                {
                    $range=$( "#slider-range-max" ).slider( "value" );
                    $prt_i=2;
                    $("div[name=prt_i]").load("/obr.php",{prt_i:$prt_i, prt_i_km:$range});
                }    
            }
            else
            {
                location.reload(true);
            }
        }
    });
}



function s_frm_cart()
{
    
    
    $req_name=$('input[name=name_cl]').val();
    $req_tel=$('input[name=tel_c]').val();
    $req_email=$('input[name=mail_c]').val();
    
    $error='';
    
    if($req_name=='')
    {
        $error+='Вы не ввели имя\r\n';
    }
    
    if($req_tel=='')
    {
        $error+='Вы не ввели номер телефона\r\n';
    }
    
    if($req_email=='')
    {
        $error+='Вы не ввели email\r\n';
    }
    
    if($error!="")
    {
        alert($error);
    }
    else
    {
        var $msg =$('#ourf_cart').find("input[type='hidden'], :input:not(:hidden)").serializeArray();
        $string="";
        
        jQuery.each($msg, function(i, field){
            $string+=field.name+'|'+field.value+";";
        });
        
		
        $.ajax({
                type: "POST",
                url: "/obr.php",
                datatype: "json",
                data: "msg_p="+$string,
                cache: false,
                success: function(html){
                    alert(html);
                    location.reload(true);
                }
        });
    }
}




