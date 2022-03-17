(function() {
  /**
   * Ajuste decimal de un número.
   *
   * @param {String}  tipo  El tipo de ajuste.
   * @param {Number}  valor El numero.
   * @param {Integer} exp   El exponente (el logaritmo 10 del ajuste base).
   * @returns {Number} El valor ajustado.
   */
  function decimalAdjust(type, value, exp) {
    // Si el exp no está definido o es cero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Si el valor no es un número o el exp no es un entero...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Decimal floor
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Decimal ceil
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
  }
})();


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};





$(document).ready(function(index) {

$('#mcp').hide();
var mcp= $('#mcp').text();



switch(mcp){

case '01': 
var mi = 1;
break;

case '02': 
var mi = 2;
break;

case '03': 
var mi = 3;
break;

case '04': 
var mi = 4;
break;

case '05': 
var mi = 5;
break;

case '06': 
var mi = 6;
break;

case '07': 
var mi = 7;
break;

case '08': 
var mi = 8;
break;

case '09': 
var mi = 9;
break;

case '10': 
var mi = 10;
break;

case '11': 
var mi = 11;
break;


default:
var mi =12;

}

console.log(mi);




var FechaInicio = getUrlParameter('FechaInicio');
var FechaFin = getUrlParameter('FechaFin');
var NomAnios = getUrlParameter('NomAnios');
var MesInicial = getUrlParameter('MesInicial');
var MesFinal = getUrlParameter('MesFinal');
var area = getUrlParameter('area');

//console.log(MesInicial,MesFinal);






$('#fi').text(FechaInicio);
$('#ff').text(FechaFin);
$('#m1').text(MesInicial);
$('#m2').text(MesFinal);
$('#seleccionomesi').val(MesInicial);
$('#seleccionomesf').val(MesFinal);

$('#elegidos').text(NomAnios);
$('#selectarea').val(area);


$('.uno').hide();
$('.dos').hide();
$('.tres').hide();
$('.cuatro').hide();


switch(NomAnios) {
  case '1':
   
    $('.uno').show();
    break;
  case '2':
  
    $('.uno').show();
    $('.dos').show();
    break;
  case '3':
 
    $('.uno').show();
    $('.dos').show();
    $('.tres').show();
    break;
  case '4':

    $('.uno').show();
    $('.dos').show();
    $('.tres').show();
    $('.cuatro').show();
    break;     

  default: $('.uno').show();
    
}





const formatterPeso = new Intl.NumberFormat('es-CO', {
       style: 'currency',
       currency: 'COP'
       ,minimumFractionDigits: 0
     })

//console.log(formatterPeso.format(12500.151555))


    var res1 = 0;
    var res2 = 0;
    var res3 = 0;
    var res4 = 0;
    var res5 = 0;
    var res6 = 0;
    var res7 = 0;
    var res8 = 0;
    var res9 = 0;
    var res10 = 0;
    var res11 = 0;
    var res12 = 0;
    var res13 = 0;
    var res14 = 0;
    var res15 = 0;
    var res16 = 0;
    var  res17=0;
    var  res18=0;
    var  res19=0;
    var  res20=0;
    var  res21=0;
    var  res22=0;
    var  res23=0;
    var  res24=0;
    var  res25=0;
    var  res26=0;
    var  res27=0;
    var  res28=0;
    var  res29=0;
    var  res30=0;
    var  res31=0;
    var  res32=0;
    var  res33=0;
    var  res34=0;
    var  res35=0;
    var  res36=0;
    var  res37=0;
    var  res38=0;
    var  res39=0;
    var  res40=0;
    var  res41=0;
    var  res42=0;
    var  res43=0;
    var  res44=0;
    var  res45=0;
    var  res46=0;
    var  res47=0;
    var  res48=0;
    var  res49=0;
    var  res50=0;
    var  res51=0;
    var  res52=0;
    var  res53=0;
    var  res54=0;
    var  res55=0;
    var  res56=0;
    var  res57=0;
    var  res58=0;
    var  res59=0;
    var  res60=0;
    var  res61=0;
    var  res62=0;
    var  res63=0;
    var  res64=0;
    var  res65=0;
    var  res66=0;
    var  res67=0;
    var  res68=0;
    var  res69=0;
    var  res70=0;
    var  res71=0;
    var  res72=0;
    var res73=0;
    var res74=0;
    var res75=0;
    var res76=0;
    var res77=0;
    var res78=0;
    var res79=0;
    var res80=0;
    var res81=0;
    var res82=0;
    var res83=0;
    var res84=0;
    var res85=0;
    var res86=0;
    var res87=0;
    var res88=0;
    var res89=0;
    var res90=0;
    var res91=0;
    var res92=0;
    var res93=0;
    var res94=0;
    var res95=0;
    var res96=0;
    var res97=0;
    var res98=0;
    var res99=0;
    //VARIABLES PARA EL 2022
    var res100=0;
    var res101=0;
    var res102=0;
    var res103=0;
    var res104=0;
    var res105=0;
    var res106=0;
    var res107=0;
    var res108=0;
    var res109=0;
    var res110=0;
    var res111=0;

    var acumulado=0;


    


    $('.valor1').each(function(index){


    //parseInt($(this).text()) < 10
    if (index >= 2) {
    
        $(this).append(' %');   
        res1 += parseFloat($(this).text().replace(',', '.'));
        

    }
    });


    $('.valor2').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res2 += parseFloat($(this).text().replace(',', '.'));

    }
    });


    $('.valor3').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res3 += parseFloat($(this).text().replace(',', '.'));

    }
    });


    $('.valor4').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res4 += parseFloat($(this).text().replace(',', '.'));

    }
    });


    $('.valor5').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res5 += parseFloat($(this).text().replace(',', '.'));

    }
    });


    $('.valor6').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res6 += parseFloat($(this).text().replace(',', '.'));

    }
    });


    $('.valor7').each(function(index){

    if (index >= 2 ) {
        $(this).append(' %');
        res7 += parseFloat($(this).text().replace(',', '.'));

    }
    });


    $('.valor8').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res8 += parseFloat($(this).text().replace(',', '.'));

    }
    });

   $('.valor9').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res9 += parseFloat($(this).text().replace(',', '.'));

    }
    });

       $('.valor10').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res10 += parseFloat($(this).text().replace(',', '.'));

    }
    });

    $('.valor11').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res11 += parseFloat($(this).text().replace(',', '.'));

    }
    });

    $('.valor12').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res12 += parseFloat($(this).text().replace(',', '.'));

    }
    });

    $('.valor13').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res13 += parseFloat($(this).text().replace(',', '.'));

    }
    });

    $('.valor14').each(function(index){
    
    if (index >= 2) {
        $(this).append(' %');
        res14 += parseFloat($(this).text().replace(',', '.'));

    }
    });


        var leer=0; var Costo1=0;var Per1=0;
      $('.NEnero2015').each(function(index){
        
            res15 += parseFloat($(this).text().replace(',', '.'));

      
            

        if(index < 2)
        {
            leer += parseFloat($(this).text().replace(',', '.'));
           
             $('.PEnero2015').eq(index).text(0).append('%');        
        } else {
        $('.PEnero2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer * 100,-2)).append('%'); 

        }

        switch (index) {
          case 9:
                 Costo1 = parseFloat($(this).text().replace(',', '.'));
               break;
          default:
                 Per1 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTEnero2015').text(formatterPeso.format(Math.round10(Costo1/Per1)));
            //console.log(Costo1,Per1,$('.CTEnero2015').text(formatterPeso.format(Math.round10(Costo1/Per1))))
     

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
      });

       




       var leer1=0; var Costo2=0;var Per2=0;
    $('.NFebrero2015').each(function(index){
    
        res16 += parseFloat($(this).text().replace(',', '.'));
        
        


        if(index < 2)
        {
         leer1 += parseFloat($(this).text().replace(',', '.'));
           
             $('.PFebrero2015').eq(index).text(0).append('%');
                   
        } else {
        $('.PFebrero2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer1 * 100,-2)).append('%'); 
        
        }

          switch (index) {
          case 9:
                 Costo2 = parseFloat($(this).text().replace(',', '.'));
               break;
          default:
                 Per2 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTFebrero2015').text(formatterPeso.format(Math.round10(Costo2/Per2)));
            


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });


   
      


   


       var leer2=0; var Costo3; var Per3;
    $('.NMarzo2015').each(function(index){ 


        res17+= parseFloat($(this).text().replace(',', '.'));

        

        if(index < 2)
        {
         leer2+= parseFloat($(this).text().replace(',', '.'));
           
             $('.PMarzo2015').eq(index).text(0).append('%');
             //console.log("Marzo :" +leer2);
             
        } else {
            $('.PMarzo2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer2 * 100,-2)).append('%'); 
        }


        switch (index) {
          case 9:
                 Costo3 = parseFloat($(this).text().replace(',', '.'));
               break;
          default:
                 Per3 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMarzo2015').text(formatterPeso.format(Math.round10(Costo3/Per3)));    


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  

    });

    var leer3=0;var Costo4; var Per4;

    $('.NAbril2015').each(function(index){ res18+= parseFloat($(this).text().replace(',', '.'));
        
        if(index < 2)
        {
         leer3+= parseFloat($(this).text().replace(',', '.'));
           
             $('.PAbril2015').eq(index).text(0).append('%');
             //console.log("abril :" +leer3);
             
        } else {
            $('.PAbril2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer3 * 100,-2)).append('%'); 
        }

                switch (index) {
          case 9:
                 Costo4 = parseFloat($(this).text().replace(',', '.'));
               break;
          default:
                 Per4 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAbril2015').text(formatterPeso.format(Math.round10(Costo4/Per4)));    

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });
    var leer4=0;var Costo5; var Per5;
$('.NMayo2015').each(function(index){ res19+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer4+= parseFloat($(this).text().replace(',', '.'));$('.PMayo2015').eq(index).text(0).append('%');} else {
            $('.PMayo2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer4* 100,-2)).append('%'); 
        }

         switch (index) {
          case 9:
                 Costo5 = parseFloat($(this).text().replace(',', '.'));
               break;
          default:
                 Per5 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMayo2015').text(formatterPeso.format(Math.round10(Costo5/Per5)));    
   

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });
var leer5=0;var Costo6; var Per6;
$('.NJunio2015').each(function(index){ res20+= parseFloat($(this).text().replace(',', '.'));
       if(index < 2)
        {leer5+= parseFloat($(this).text().replace(',', '.'));$('.PJunio2015').eq(index).text(0).append('%');} else {
            $('.PJunio2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer5* 100,-2)).append('%'); 
        }

          switch (index) {
          case 9:
                 Costo6 = parseFloat($(this).text().replace(',', '.'));
               break;
          default:
                 Per6 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJunio2015').text(formatterPeso.format(Math.round10(Costo6/Per6)));    


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer6=0;var Costo7; var Per7;
$('.NJulio2015').each(function(index){ res21+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer6+= parseFloat($(this).text().replace(',', '.'));$('.PJulio2015').eq(index).text(0).append('%');} else {
            $('.PJulio2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer6* 100,-2)).append('%'); 
        }


          switch (index) {
          case 9:
                 Costo7 = parseFloat($(this).text().replace(',', '.'));
               break;
          default:
                 Per7 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJulio2015').text(formatterPeso.format(Math.round10(Costo7/Per7)));

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer7=0;var Costo8; var Per8;
$('.NAgosto2015').each(function(index){ res22+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer7+= parseFloat($(this).text().replace(',', '.'));$('.PAgosto2015').eq(index).text(0).append('%');} else {
            $('.PAgosto2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer7* 100,-2)).append('%'); 
        }

        switch (index) {
          case 9:
                 Costo8 = parseFloat($(this).text().replace(',', '.'));
               break;
          default:
                 Per8 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAgosto2015').text(formatterPeso.format(Math.round10(Costo8/Per8)));    

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer8=0;var Costo9; var Per9;
$('.NSeptiembre2015').each(function(index){ res23+= parseFloat($(this).text().replace(',', '.'));
       if(index < 2)
        {leer8+= parseFloat($(this).text().replace(',', '.'));$('.PSeptiembre2015').eq(index).text(0).append('%');} else {
            $('.PSeptiembre2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer8* 100,-2)).append('%'); 
        }

        switch (index) {
          case 9:
                 Costo9 = parseFloat($(this).text().replace(',', '.'));
               break;
          default:
                 Per9 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTSeptiembre2015').text(formatterPeso.format(Math.round10(Costo9/Per9)));    


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer9=0;var Costo10; var Per10;
$('.NOctubre2015').each(function(index){ res24+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer9+= parseFloat($(this).text().replace(',', '.'));$('.POctubre2015').eq(index).text(0).append('%');} else {
            $('.POctubre2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer9* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo10= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per10 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        switch (index) {case 9: 
            Costo10= parseFloat($(this).text().replace(',', '.'));break;
          default:
            Per10 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

            
        $('.CTOctubre2015').text(formatterPeso.format(Math.round10(Costo10/Per10)));

  
    });

var leer10=0;var Costo11=0; var Per11=0;

$('.NNoviembre2015').each(function(index){ res25+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer10+= parseFloat($(this).text().replace(',', '.'));$('.PNoviembre2015').eq(index).text(0).append('%');} else {
            $('.PNoviembre2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer10* 100,-2)).append('%'); 
        }

        switch (index) {case 9:  Costo11= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per11 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTNoviembre2015').text(formatterPeso.format(Math.round10(Costo11/Per11)));

    
        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer11=0;var Costo12=0; var Per12=0;

$('.NDiciembre2015').each(function(index){ res26+= parseFloat($(this).text().replace(',', '.'));
       if(index < 2)
        {leer11+= parseFloat($(this).text().replace(',', '.'));$('.PDiciembre2015').eq(index).text(0).append('%');} else {
            $('.PDiciembre2015').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer11* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo12= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per12 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTDiciembre2015').text(formatterPeso.format(Math.round10(Costo12/Per12)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer12=0;var Costo13=0; var Per13=0;

$('.NEnero2016').each(function(index){ res27+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer12+= parseFloat($(this).text().replace(',', '.'));$('.PEnero2016').eq(index).text(0).append('%');} else {
            $('.PEnero2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer12* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo13= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per13 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTEnero2016').text(formatterPeso.format(Math.round10(Costo13/Per13)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer13=0; var Costo14=0;    var Per14=0;

$('.NFebrero2016').each(function(index){ res28+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer13+= parseFloat($(this).text().replace(',', '.'));$('.PFebrero2016').eq(index).text(0).append('%');} else {
            $('.PFebrero2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer13* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo14= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per14 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTFebrero2016').text(formatterPeso.format(Math.round10(Costo14/Per14)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer14=0;var Costo15=0; var Per15=0;

$('.NMarzo2016').each(function(index){ res29+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer14+= parseFloat($(this).text().replace(',', '.'));$('.PMarzo2016').eq(index).text(0).append('%');} else {
            $('.PMarzo2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer14* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo15= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per15 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMarzo2016').text(formatterPeso.format(Math.round10(Costo15/Per15)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });
var leer15=0;var Costo16=0; var Per16=0;

$('.NAbril2016').each(function(index){ res30+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer15+= parseFloat($(this).text().replace(',', '.'));$('.PAbril2016').eq(index).text(0).append('%');} else {
            $('.PAbril2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer15* 100,-2)).append('%'); 
        }

      switch (index) {case 9: Costo16= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per16 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAbril2016').text(formatterPeso.format(Math.round10(Costo16/Per16)));
    

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer16=0;var Costo17=0; var Per17=0;


$('.NMayo2016').each(function(index){ res31+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer16+= parseFloat($(this).text().replace(',', '.'));$('.PMayo2016').eq(index).text(0).append('%');} else {
            $('.PMayo2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer16* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo17= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per17 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMayo2016').text(formatterPeso.format(Math.round10(Costo17/Per17)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer17=0;var Costo18=0; var Per18=0;

$('.NJunio2016').each(function(index){ res32+= parseFloat($(this).text().replace(',', '.'));
       if(index < 2)
        {leer17+= parseFloat($(this).text().replace(',', '.'));$('.PJunio2016').eq(index).text(0).append('%');} else {
            $('.PJunio2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer17* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo18= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per18 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJunio2016').text(formatterPeso.format(Math.round10(Costo18/Per18)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer18=0;var Costo19=0; var Per19=0;

$('.NJulio2016').each(function(index){ res33+= parseFloat($(this).text().replace(',', '.'));
        
        if(index < 2)
        {leer18+= parseFloat($(this).text().replace(',', '.'));$('.PJulio2016').eq(index).text(0).append('%');} else {
            $('.PJulio2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer18* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo19= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per19 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJulio2016').text(formatterPeso.format(Math.round10(Costo19/Per19)));



        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer19=0;var Costo20=0; var Per20=0;


$('.NAgosto2016').each(function(index){ res34+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer19+= parseFloat($(this).text().replace(',', '.'));$('.PAgosto2016').eq(index).text(0).append('%');} else {
            $('.PAgosto2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer19* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo20= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per20 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAgosto2016').text(formatterPeso.format(Math.round10(Costo20/Per20)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer20=0;var Costo21=0; var Per21=0;

$('.NSeptiembre2016').each(function(index){ res35+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer20+= parseFloat($(this).text().replace(',', '.'));$('.PSeptiembre2016').eq(index).text(0).append('%');} else {
            $('.PSeptiembre2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer20* 100,-2)).append('%'); 
        }
switch (index) {case 9: Costo21= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per21 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTSeptiembre2016').text(formatterPeso.format(Math.round10(Costo21/Per21)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer21=0;var Costo22=0; var Per22=0;

$('.NOctubre2016').each(function(index){ res36+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer21+= parseFloat($(this).text().replace(',', '.'));$('.POctubre2016').eq(index).text(0).append('%');} else {
            $('.POctubre2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer21* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo22= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per22 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTOctubre2016').text(formatterPeso.format(Math.round10(Costo22/Per22)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer22=0;var Costo23=0; var Per23=0;

$('.NNoviembre2016').each(function(index){ res37+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer22+= parseFloat($(this).text().replace(',', '.'));$('.PNoviembre2016').eq(index).text(0).append('%');} else {
            $('.PNoviembre2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer22* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo23= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per23 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTNoviembre2016').text(formatterPeso.format(Math.round10(Costo23/Per23)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer23=0;var Costo24=0; var Per24=0;

$('.NDiciembre2016').each(function(index){ res38+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer23+= parseFloat($(this).text().replace(',', '.'));$('.PDiciembre2016').eq(index).text(0).append('%');} else {
            $('.PDiciembre2016').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer23* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo24= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per24 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTDiciembre2016').text(formatterPeso.format(Math.round10(Costo24/Per24)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer24=0;var Costo25=0; var Per25=0;

$('.NEnero2017').each(function(index){ res39+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer24+= parseFloat($(this).text().replace(',', '.'));$('.PEnero2017').eq(index).text(0).append('%');} else {
            $('.PEnero2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer24* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo25= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per25 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTEnero2017').text(formatterPeso.format(Math.round10(Costo25/Per25)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer25=0;var Costo26=0; var Per26=0;

$('.NFebrero2017').each(function(index){ res40+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer25+= parseFloat($(this).text().replace(',', '.'));$('.PFebrero2017').eq(index).text(0).append('%');} else {
            $('.PFebrero2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer25* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo26= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per26 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTFebrero2017').text(formatterPeso.format(Math.round10(Costo26/Per26)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer26=0;var Costo27=0; var Per27=0;

$('.NMarzo2017').each(function(index){ res41+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer26+= parseFloat($(this).text().replace(',', '.'));$('.PMarzo2017').eq(index).text(0).append('%');} else {
            $('.PMarzo2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer26* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo27= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per27 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMarzo2017').text(formatterPeso.format(Math.round10(Costo27/Per27)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer27=0;var Costo28=0; var Per28=0;

$('.NAbril2017').each(function(index){ res42+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer27+= parseFloat($(this).text().replace(',', '.'));$('.PAbril2017').eq(index).text(0).append('%');} else {
            $('.PAbril2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer27* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo28= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per28 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAbril2017').text(formatterPeso.format(Math.round10(Costo28/Per28)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer28=0;var Costo29=0; var Per29=0;

$('.NMayo2017').each(function(index){ res43+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer28+= parseFloat($(this).text().replace(',', '.'));$('.PMayo2017').eq(index).text(0).append('%');} else {
            $('.PMayo2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer28* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo29= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per29 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMayo2017').text(formatterPeso.format(Math.round10(Costo29/Per29)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer29=0;var Costo30=0; var Per30=0;

$('.NJunio2017').each(function(index){ res44+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer29+= parseFloat($(this).text().replace(',', '.'));$('.PJunio2017').eq(index).text(0).append('%');} else {
            $('.PJunio2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer29* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo30= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per30 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJunio2017').text(formatterPeso.format(Math.round10(Costo30/Per30)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer30=0;var Costo31=0; var Per31=0;

$('.NJulio2017').each(function(index){ res45+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer30+= parseFloat($(this).text().replace(',', '.'));$('.PJulio2017').eq(index).text(0).append('%');} else {
            $('.PJulio2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer30* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo31= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per31 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJulio2017').text(formatterPeso.format(Math.round10(Costo31/Per31)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer31=0;var Costo32=0; var Per32=0;

$('.NAgosto2017').each(function(index){ res46+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer31+= parseFloat($(this).text().replace(',', '.'));$('.PAgosto2017').eq(index).text(0).append('%');} else {
            $('.PAgosto2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer31* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo32= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per32 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAgosto2017').text(formatterPeso.format(Math.round10(Costo32/Per32)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer32=0;var Costo33=0; var Per33=0;

$('.NSeptiembre2017').each(function(index){ res47+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer32+= parseFloat($(this).text().replace(',', '.'));$('.PSeptiembre2017').eq(index).text(0).append('%');} else {
            $('.PSeptiembre2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer32* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo33= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per33 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTSeptiembre2017').text(formatterPeso.format(Math.round10(Costo33/Per33)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer33=0;var Costo34=0; var Per34=0;

$('.NOctubre2017').each(function(index){ res48+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer33+= parseFloat($(this).text().replace(',', '.'));$('.POctubre2017').eq(index).text(0).append('%');} else {
            $('.POctubre2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer33* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo34= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per34 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTOctubre2017').text(formatterPeso.format(Math.round10(Costo34/Per34)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer34=0;var Costo35=0; var Per35=0;

$('.NNoviembre2017').each(function(index){ res49+= parseFloat($(this).text().replace(',', '.'));
        
    if(index < 2)
        {leer34+= parseFloat($(this).text().replace(',', '.'));$('.PNoviembre2017').eq(index).text(0).append('%');} else {
            $('.PNoviembre2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer34* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo35= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per35 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTNoviembre2017').text(formatterPeso.format(Math.round10(Costo35/Per35)));



        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer35=0;var Costo36=0; var Per36=0;

$('.NDiciembre2017').each(function(index){ res50+= parseFloat($(this).text().replace(',', '.'));
    if(index < 2)
        {leer35+= parseFloat($(this).text().replace(',', '.'));$('.PDiciembre2017').eq(index).text(0).append('%');} else {
            $('.PDiciembre2017').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer35* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo36= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per36 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTDiciembre2017').text(formatterPeso.format(Math.round10(Costo36/Per36)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer36=0;var Costo37=0; var Per37=0;

$('.NEnero2018').each(function(index){ res51+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer36+= parseFloat($(this).text().replace(',', '.'));$('.PEnero2018').eq(index).text(0).append('%');} else {
            $('.PEnero2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer36* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo37= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per37 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTEnero2018').text(formatterPeso.format(Math.round10(Costo37/Per37)));
    



        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });
var leer37=0;var Costo38=0; var Per38=0;

$('.NFebrero2018').each(function(index){ res52+= parseFloat($(this).text().replace(',', '.'));
        
       if(index < 2)
        {leer37+= parseFloat($(this).text().replace(',', '.'));$('.PFebrero2018').eq(index).text(0).append('%');} else {
            $('.PFebrero2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer37* 100,-2)).append('%'); 
        }

       switch (index) {case 9: Costo38= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per38 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTFebrero2018').text(formatterPeso.format(Math.round10(Costo38/Per38)));

     

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer38=0;var Costo39=0; var Per39=0;

$('.NMarzo2018').each(function(index){ res53+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer38+= parseFloat($(this).text().replace(',', '.'));$('.PMarzo2018').eq(index).text(0).append('%');} else {
            $('.PMarzo2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer38* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo39= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per39 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMarzo2018').text(formatterPeso.format(Math.round10(Costo39/Per39)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer39=0;var Costo40=0; var Per40=0;

$('.NAbril2018').each(function(index){ res54+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer39+= parseFloat($(this).text().replace(',', '.'));$('.PAbril2018').eq(index).text(0).append('%');} else {
            $('.PAbril2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer39* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo40= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per40 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAbril2018').text(formatterPeso.format(Math.round10(Costo40/Per40)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });
var leer40=0;var Costo41=0; var Per41=0;

$('.NMayo2018').each(function(index){ res55+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer40+= parseFloat($(this).text().replace(',', '.'));$('.PMayo2018').eq(index).text(0).append('%');} else {
            $('.PMayo2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer40* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo41= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per41 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMayo2018').text(formatterPeso.format(Math.round10(Costo41/Per41)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer41=0;var Costo42=0; var Per42=0;

$('.NJunio2018').each(function(index){ res56+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer41+= parseFloat($(this).text().replace(',', '.'));$('.PJunio2018').eq(index).text(0).append('%');} else {
            $('.PJunio2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer41* 100,-2)).append('%'); 
        }

       switch (index) {case 9: Costo42= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per42 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJunio2018').text(formatterPeso.format(Math.round10(Costo42/Per42)));
 

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer42=0;var Costo43=0; var Per43=0;

$('.NJulio2018').each(function(index){ res57+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer42+= parseFloat($(this).text().replace(',', '.'));$('.PJulio2018').eq(index).text(0).append('%');} else {
            $('.PJulio2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer42* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo43= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per43 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJulio2018').text(formatterPeso.format(Math.round10(Costo43/Per43)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer43=0;var Costo44=0; var Per44=0;

$('.NAgosto2018').each(function(index){ res58+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer43+= parseFloat($(this).text().replace(',', '.'));$('.PAgosto2018').eq(index).text(0).append('%');} else {
            $('.PAgosto2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer43* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo44= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per44 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAgosto2018').text(formatterPeso.format(Math.round10(Costo44/Per44)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer44=0;var Costo45=0; var Per45=0;

$('.NSeptiembre2018').each(function(index){ res59+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer44+= parseFloat($(this).text().replace(',', '.'));$('.PSeptiembre2018').eq(index).text(0).append('%');} else {
            $('.PSeptiembre2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer44* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo45= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per45 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTSeptiembre2018').text(formatterPeso.format(Math.round10(Costo45/Per45)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer45=0;var Costo46=0; var Per46=0;

$('.NOctubre2018').each(function(index){ res60+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer45+= parseFloat($(this).text().replace(',', '.'));$('.POctubre2018').eq(index).text(0).append('%');} else {
            $('.POctubre2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer45* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo46= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per46 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTOctubre2018').text(formatterPeso.format(Math.round10(Costo46/Per46)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer46=0;var Costo47=0; var Per47=0;

$('.NNoviembre2018').each(function(index){ res61+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer46+= parseFloat($(this).text().replace(',', '.'));$('.PNoviembre2018').eq(index).text(0).append('%');} else {
            $('.PNoviembre2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer46* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo47= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per47 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTNoviembre2018').text(formatterPeso.format(Math.round10(Costo47/Per47)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer47=0;var Costo48=0; var Per48=0;

$('.NDiciembre2018').each(function(index){ res62+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer47+= parseFloat($(this).text().replace(',', '.'));$('.PDiciembre2018').eq(index).text(0).append('%');} else {
            $('.PDiciembre2018').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer47* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo48= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per48 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTDiciembre2018').text(formatterPeso.format(Math.round10(Costo48/Per48)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer48=0;var Costo49=0; var Per49=0;

$('.NEnero2019').each(function(index){ res63+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer48+= parseFloat($(this).text().replace(',', '.'));$('.PEnero2019').eq(index).text(0).append('%');} else {
            $('.PEnero2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer48* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo49= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per49 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTEnero2019').text(formatterPeso.format(Math.round10(Costo49/Per49)));



        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer49=0;var Costo50=0; var Per50=0;


$('.NFebrero2019').each(function(index){ res64+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer49+= parseFloat($(this).text().replace(',', '.'));$('.PFebrero2019').eq(index).text(0).append('%');} else {
            $('.PFebrero2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer49* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo50= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per50 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTFebrero2019').text(formatterPeso.format(Math.round10(Costo50/Per50)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer50=0;var Costo51=0; var Per51=0;

$('.NMarzo2019').each(function(index){ res65+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer50+= parseFloat($(this).text().replace(',', '.'));$('.PMarzo2019').eq(index).text(0).append('%');} else {
            $('.PMarzo2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer50* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo51= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per51 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMarzo2019').text(formatterPeso.format(Math.round10(Costo51/Per51)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer51=0;var Costo52=0; var Per52=0;

$('.NAbril2019').each(function(index){ res66+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer51+= parseFloat($(this).text().replace(',', '.'));$('.PAbril2019').eq(index).text(0).append('%');} else {
            $('.PAbril2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer51* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo52= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per52 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAbril2019').text(formatterPeso.format(Math.round10(Costo52/Per52)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer52=0;var Costo53=0; var Per53=0;

$('.NMayo2019').each(function(index){ res67+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer52+= parseFloat($(this).text().replace(',', '.'));$('.PMayo2019').eq(index).text(0).append('%');} else {
            $('.PMayo2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer52* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo53= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per53 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMayo2019').text(formatterPeso.format(Math.round10(Costo53/Per53)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer53=0;var Costo54=0; var Per54=0;

$('.NJunio2019').each(function(index){ res68+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer53+= parseFloat($(this).text().replace(',', '.'));$('.PJunio2019').eq(index).text(0).append('%');} else {
            $('.PJunio2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer53* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo54= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per54 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJunio2019').text(formatterPeso.format(Math.round10(Costo54/Per54)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer54=0;var Costo55=0; var Per55=0;

$('.NJulio2019').each(function(index){ res69+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer54+= parseFloat($(this).text().replace(',', '.'));$('.PJulio2019').eq(index).text(0).append('%');} else {
            $('.PJulio2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer54* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo55= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per55 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJulio2019').text(formatterPeso.format(Math.round10(Costo55/Per55)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer55=0;var Costo56=0; var Per56=0;

$('.NAgosto2019').each(function(index){ res70+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer55+= parseFloat($(this).text().replace(',', '.'));$('.PAgosto2019').eq(index).text(0).append('%');} else {
            $('.PAgosto2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer55* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo56= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per56 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
    
        $('.CTAgosto2019').text(formatterPeso.format(Math.round10(Costo56/Per56)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer56=0;var Costo57=0; var Per57=0;

$('.NSeptiembre2019').each(function(index){ res71+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer56+= parseFloat($(this).text().replace(',', '.'));$('.PSeptiembre2019').eq(index).text(0).append('%');} else {
            $('.PSeptiembre2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer56* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo57= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per57 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTSeptiembre2019').text(formatterPeso.format(Math.round10(Costo57/Per57)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer57=0;var Costo58=0; var Per58=0;

$('.NOctubre2019').each(function(index){ res72+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer57+= parseFloat($(this).text().replace(',', '.'));$('.POctubre2019').eq(index).text(0).append('%');} else {
            $('.POctubre2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer57* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo58= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per58 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTOctubre2019').text(formatterPeso.format(Math.round10(Costo58/Per58)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer58=0;var Costo59=0; var Per59=0;

$('.NNoviembre2019').each(function(index){ res73+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer58+= parseFloat($(this).text().replace(',', '.'));$('.PNoviembre2019').eq(index).text(0).append('%');} else {
            $('.PNoviembre2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer58* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo59= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per59 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTNoviembre2019').text(formatterPeso.format(Math.round10(Costo59/Per59)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer59=0;var Costo60=0; var Per60=0;

$('.NDiciembre2019').each(function(index){ res74+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer59+= parseFloat($(this).text().replace(',', '.'));$('.PDiciembre2019').eq(index).text(0).append('%');} else {
            $('.PDiciembre2019').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer59* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo60= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per60 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTDiciembre2019').text(formatterPeso.format(Math.round10(Costo60/Per60)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer60=0;var Costo61=0; var Per61=0;

$('.NEnero2020').each(function(index){ res75+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer60+= parseFloat($(this).text().replace(',', '.'));$('.PEnero2020').eq(index).text(0).append('%');} else {
            $('.PEnero2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer60* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo61= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per61 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTEnero2020').text(formatterPeso.format(Math.round10(Costo61/Per61)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer61=0;var Costo62=0; var Per62=0;

$('.NFebrero2020').each(function(index){ res76+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer61+= parseFloat($(this).text().replace(',', '.'));$('.PFebrero2020').eq(index).text(0).append('%');} else {
            $('.PFebrero2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer61* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo62= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per62 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTFebrero2020').text(formatterPeso.format(Math.round10(Costo62/Per62)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });


var leer62=0;var Costo63=0; var Per63=0;

$('.NMarzo2020').each(function(index){ res77+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer62+= parseFloat($(this).text().replace(',', '.'));$('.PMarzo2020').eq(index).text(0).append('%');} else {
            $('.PMarzo2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer62* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo63= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per63 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMarzo2020').text(formatterPeso.format(Math.round10(Costo63/Per63)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer63=0;var Costo64=0; var Per64=0;

$('.NAbril2020').each(function(index){ res78+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer63+= parseFloat($(this).text().replace(',', '.'));$('.PAbril2020').eq(index).text(0).append('%');} else {
            $('.PAbril2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer63* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo64= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per64 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAbril2020').text(formatterPeso.format(Math.round10(Costo64/Per64)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer64=0;var Costo65=0; var Per65=0;

$('.NMayo2020').each(function(index){ res79+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer64+= parseFloat($(this).text().replace(',', '.'));$('.PMayo2020').eq(index).text(0).append('%');} else {
            $('.PMayo2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer64* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo65= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per65 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTMayo2020').text(formatterPeso.format(Math.round10(Costo65/Per65)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer65=0;var Costo66=0; var Per66=0;

$('.NJunio2020').each(function(index){ res80+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer65+= parseFloat($(this).text().replace(',', '.'));$('.PJunio2020').eq(index).text(0).append('%');} else {
            $('.PJunio2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer65* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo66= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per66 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJunio2020').text(formatterPeso.format(Math.round10(Costo66/Per66)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer66=0;var Costo67=0; var Per67=0;

$('.NJulio2020').each(function(index){ res81+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer66+= parseFloat($(this).text().replace(',', '.'));$('.PJulio2020').eq(index).text(0).append('%');} else {
            $('.PJulio2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer66* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo67= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per67 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTJulio2020').text(formatterPeso.format(Math.round10(Costo67/Per67)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer67=0;var Costo68=0; var Per68=0;

$('.NAgosto2020').each(function(index){ res82+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer67+= parseFloat($(this).text().replace(',', '.'));$('.PAgosto2020').eq(index).text(0).append('%');} else {
            $('.PAgosto2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer67* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo68= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per68 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTAgosto2020').text(formatterPeso.format(Math.round10(Costo68/Per68)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer68=0;var Costo69=0; var Per69=0;

$('.NSeptiembre2020').each(function(index){ res83+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer68+= parseFloat($(this).text().replace(',', '.'));$('.PSeptiembre2020').eq(index).text(0).append('%');} else {
            $('.PSeptiembre2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer68* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo69= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per69 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTSeptiembre2020').text(formatterPeso.format(Math.round10(Costo69/Per69)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer69=0;var Costo70=0; var Per70=0;

$('.NOctubre2020').each(function(index){ res84+= parseFloat($(this).text().replace(',', '.'));
       if(index < 2)
        {leer69+= parseFloat($(this).text().replace(',', '.'));$('.POctubre2020').eq(index).text(0).append('%');} else {
            $('.POctubre2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer69* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo70= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per70 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTOctubre2020').text(formatterPeso.format(Math.round10(Costo70/Per70)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer70=0;var Costo71=0; var Per71=0;

$('.NNoviembre2020').each(function(index){ res85+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer70+= parseFloat($(this).text().replace(',', '.'));$('.PNoviembre2020').eq(index).text(0).append('%');} else {
            $('.PNoviembre2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer70* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo71= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per71 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTNoviembre2020').text(formatterPeso.format(Math.round10(Costo71/Per71)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer71=0;var Costo72=0; var Per72=0;


$('.NDiciembre2020').each(function(index){ res86+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer71+= parseFloat($(this).text().replace(',', '.'));$('.PDiciembre2020').eq(index).text(0).append('%');} else {
            $('.PDiciembre2020').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer71* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo72= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per72 = parseFloat($(this).text().replace(',', '.'));
                 break;
            }

        
        
        $('.CTDiciembre2020').text(formatterPeso.format(Math.round10(Costo72/Per72)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer72=0;var Costo73=0; var Per73=0;

$('.NEnero2021').each(function(index){ res87+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer72+= parseFloat($(this).text().replace(',', '.'));$('.PEnero2021').eq(index).text(0).append('%');} else {
            $('.PEnero2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer72* 100,-2)).append('%'); 
        }

        switch (index) 
        {case 9: Costo73= parseFloat($(this).text().replace(',', '.'));
         
                    break;
        default:
                 Per73 = parseFloat($(this).text().replace(',', '.'));


        }


        
        $('.CTEnero2021').text(formatterPeso.format(Math.round10(Costo73/Per73)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));

    });

console.log(Costo73,Per73);

var leer73=0;var Costo74=0; var Per74=0;


$('.NFebrero2021').each(function(index){ res88+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer73+= parseFloat($(this).text().replace(',', '.'));$('.PFebrero2021').eq(index).text(0).append('%');} else {
            $('.PFebrero2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer73* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo74= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per74 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTFebrero2021').text(formatterPeso.format(Math.round10(Costo74/Per74)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer74=0;var Costo75=0; var Per75=0;

$('.NMarzo2021').each(function(index){ res89+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer74+= parseFloat($(this).text().replace(',', '.'));$('.PMarzo2021').eq(index).text(0).append('%');} else {
            $('.PMarzo2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer74* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo75= parseFloat($(this).text().replace(',', '.'));break;
        default:
                 Per75 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
    
        $('.CTMarzo2021').text(formatterPeso.format(Math.round10(Costo75/Per75)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer75=0;var Costo76=0; var Per76=0;

$('.NAbril2021').each(function(index){ res90+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer75+= parseFloat($(this).text().replace(',', '.'));$('.PAbril2021').eq(index).text(0).append('%');} else {
            $('.PAbril2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer75* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo76= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per76 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTAbril2021').text(formatterPeso.format(Math.round10(Costo76/Per76)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer76=0;var Costo77=0; var Per77=0;

$('.NMayo2021').each(function(index){ res91+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer76+= parseFloat($(this).text().replace(',', '.'));$('.PMayo2021').eq(index).text(0).append('%');} else {
            $('.PMayo2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer76* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo77= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per77 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTMayo2021').text(formatterPeso.format(Math.round10(Costo77/Per77)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer77=0;var Costo78=0; var Per78=0;

$('.NJunio2021').each(function(index){ res92+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer77+= parseFloat($(this).text().replace(',', '.'));$('.PJunio2021').eq(index).text(0).append('%');} else {
            $('.PJunio2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer77* 100,-2)).append('%'); 
        }

switch (index) {case 9: Costo78= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per78= parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTJunio2021').text(formatterPeso.format(Math.round10(Costo78/Per78)));



        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer78=0;var Costo79=0; var Per79=0;

$('.NJulio2021').each(function(index){ res93+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer78+= parseFloat($(this).text().replace(',', '.'));$('.PJulio2021').eq(index).text(0).append('%');} else {
            $('.PJulio2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer78* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo79= parseFloat($(this).text().replace(',', '.'));break;
        default:
                 Per79 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTJulio2021').text(formatterPeso.format(Math.round10(Costo79/Per79)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer79=0;var Costo80=0; var Per80=0;

$('.NAgosto2021').each(function(index){ res94+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer79+= parseFloat($(this).text().replace(',', '.'));$('.PAgosto2021').eq(index).text(0).append('%');} else {
            $('.PAgosto2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer79* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo80= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per80 = parseFloat($(this).text().replace(',', '.'));

                
            }

        
        
        $('.CTAgosto2021').text(formatterPeso.format(Math.round10(Costo80/Per80)));

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer80=0;var Costo81=0; var Per81=0;

$('.NSeptiembre2021').each(function(index){ res95+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer80+= parseFloat($(this).text().replace(',', '.'));$('.PSeptiembre2021').eq(index).text(0).append('%');} else {
            $('.PSeptiembre2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer80* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo81= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per81 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTSeptiembre2021').text(formatterPeso.format(Math.round10(Costo81/Per81)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer81=0;var Costo82=0; var Per82=0;

$('.NOctubre2021').each(function(index){ res96+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer81+= parseFloat($(this).text().replace(',', '.'));$('.POctubre2021').eq(index).text(0).append('%');} else {
            $('.POctubre2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer81* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo82= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per82 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTOctubre2021').text(formatterPeso.format(Math.round10(Costo82/Per82)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer82=0;var Costo83=0; var Per83=0;

$('.NNoviembre2021').each(function(index){ res97+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer82+= parseFloat($(this).text().replace(',', '.'));$('.PNoviembre2021').eq(index).text(0).append('%');} else {
            $('.PNoviembre2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer82* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo83= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per83 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTNoviembre2021').text(formatterPeso.format(Math.round10(Costo83/Per83)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer83=0;var Costo84=0; var Per84=0;

$('.NDiciembre2021').each(function(index){ res98+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer83+= parseFloat($(this).text().replace(',', '.'));$('.PDiciembre2021').eq(index).text(0).append('%');} else {
            $('.PDiciembre2021').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer83* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo84= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per84 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTDiciembre2021').text(formatterPeso.format(Math.round10(Costo84/Per84)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

 var leer84=0;var Costo85=0; var Per85=0;
$('.NAcumulado').each(function(index){ res99+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer84+= parseFloat($(this).text().replace(',', '.'));$('.PAcumulado').eq(index).text(0).append('%');} else {
            $('.PAcumulado').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer84* 100,-2)).append('%'); 
        }

          switch (index) {case 9: Costo85= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per85 = parseFloat($(this).text().replace(',', '.'))/mi;
                
            }

        
        
        $('.CTAcumulado').text(formatterPeso.format(Math.round10(Costo85/Per85)));

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });


//Anio2022

var leer85=0;var Costo86=0; var Per86=0;

$('.NEnero2022').each(function(index){ res100+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer85+= parseFloat($(this).text().replace(',', '.'));$('.PEnero2022').eq(index).text(0).append('%');} else {
            $('.PEnero2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer85* 100,-2)).append('%'); 
        }

        switch (index) 
        {case 9: Costo86= parseFloat($(this).text().replace(',', '.'));
         
                    break;
        default:
                 Per86 = parseFloat($(this).text().replace(',', '.'));


        }


        
        $('.CTEnero2022').text(formatterPeso.format(Math.round10(Costo86/Per86)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));

    });



var leer86=0;var Costo87=0; var Per87=0;


$('.NFebrero2022').each(function(index){ res101+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer86+= parseFloat($(this).text().replace(',', '.'));$('.PFebrero2022').eq(index).text(0).append('%');} else {
            $('.PFebrero2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer86* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo87= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per87 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTFebrero2022').text(formatterPeso.format(Math.round10(Costo87/Per87)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer87=0;var Costo88=0; var Per88=0;

$('.NMarzo2022').each(function(index){ res102+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer87+= parseFloat($(this).text().replace(',', '.'));$('.PMarzo2022').eq(index).text(0).append('%');} else {
            $('.PMarzo2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer87* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo88= parseFloat($(this).text().replace(',', '.'));break;
        default:
                 Per88 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
    
        $('.CTMarzo2022').text(formatterPeso.format(Math.round10(Costo88/Per88)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer88=0;var Costo89=0; var Per89=0;

$('.NAbril2022').each(function(index){ res103+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer88+= parseFloat($(this).text().replace(',', '.'));$('.PAbril2022').eq(index).text(0).append('%');} else {
            $('.PAbril2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer88* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo89= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per89 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTAbril2022').text(formatterPeso.format(Math.round10(Costo89/Per89)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer89=0;var Costo90=0; var Per90=0;

$('.NMayo2022').each(function(index){ res104+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer89+= parseFloat($(this).text().replace(',', '.'));$('.PMayo2022').eq(index).text(0).append('%');} else {
            $('.PMayo2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer89* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo90= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per90 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTMayo2022').text(formatterPeso.format(Math.round10(Costo90/Per90)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer90=0;var Costo91=0; var Per91=0;

$('.NJunio2022').each(function(index){ res105+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer90+= parseFloat($(this).text().replace(',', '.'));$('.PJunio2022').eq(index).text(0).append('%');} else {
            $('.PJunio2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer90* 100,-2)).append('%'); 
        }

switch (index) {case 9: Costo91= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per91= parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTJunio2022').text(formatterPeso.format(Math.round10(Costo91/Per91)));



        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer91=0;var Costo92=0; var Per92=0;

$('.NJulio2022').each(function(index){ res106+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer91+= parseFloat($(this).text().replace(',', '.'));$('.PJulio2022').eq(index).text(0).append('%');} else {
            $('.PJulio2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer91* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo92= parseFloat($(this).text().replace(',', '.'));break;
        default:
                 Per92 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTJulio2022').text(formatterPeso.format(Math.round10(Costo92/Per92)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer92=0;var Costo93=0; var Per93=0;

$('.NAgosto2022').each(function(index){ res107+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer92+= parseFloat($(this).text().replace(',', '.'));$('.PAgosto2022').eq(index).text(0).append('%');} else {
            $('.PAgosto2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer92* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo93= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per93 = parseFloat($(this).text().replace(',', '.'));

                
            }

        
        
        $('.CTAgosto2022').text(formatterPeso.format(Math.round10(Costo93/Per93)));

        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer93=0;var Costo94=0; var Per94=0;

$('.NSeptiembre2022').each(function(index){ res108+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer93+= parseFloat($(this).text().replace(',', '.'));$('.PSeptiembre2022').eq(index).text(0).append('%');} else {
            $('.PSeptiembre2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer93* 100,-2)).append('%'); 
        }

        switch (index) {case 9: Costo94= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per94 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTSeptiembre2022').text(formatterPeso.format(Math.round10(Costo94/Per94)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer94=0;var Costo95=0; var Per95=0;

$('.NOctubre2022').each(function(index){ res109+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer94+= parseFloat($(this).text().replace(',', '.'));$('.POctubre2022').eq(index).text(0).append('%');} else {
            $('.POctubre2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer94* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo95= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per95 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTOctubre2022').text(formatterPeso.format(Math.round10(Costo95/Per95)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer95=0;var Costo96=0; var Per96=0;

$('.NNoviembre2022').each(function(index){ res110+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer95+= parseFloat($(this).text().replace(',', '.'));$('.PNoviembre2022').eq(index).text(0).append('%');} else {
            $('.PNoviembre2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer95* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo96= parseFloat($(this).text().replace(',', '.'));break;
           default:
                 Per96 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTNoviembre2022').text(formatterPeso.format(Math.round10(Costo96/Per96)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });

var leer96=0;var Costo97=0; var Per97=0;

$('.NDiciembre2022').each(function(index){ res111+= parseFloat($(this).text().replace(',', '.'));
        if(index < 2)
        {leer96+= parseFloat($(this).text().replace(',', '.'));$('.PDiciembre2022').eq(index).text(0).append('%');} else {
            $('.PDiciembre2022').eq(index).text(Math.round10(parseFloat($(this).text().replace(',', '.'))/leer96* 100,-2)).append('%'); 
        }


        switch (index) {case 9: Costo97= parseFloat($(this).text().replace(',', '.'));break;
          default:
                 Per97 = parseFloat($(this).text().replace(',', '.'));
                
            }

        
        
        $('.CTDiciembre2022').text(formatterPeso.format(Math.round10(Costo97/Per97)));


        $(this).text(formatterPeso.format(parseFloat($(this).text().replace(',', '.'))));
  
    });






    ////console.log(res1);

    $('.res1').text(Math.round10(res1,-2)).append(' %');
    $('.res2').text(Math.round10(res2,-2)).append(' %');
    $('.res3').text(Math.round10(res3,-2)).append(' %');
    $('.res4').text(Math.round10(res4,-2)).append(' %');
    $('.res5').text(Math.round10((res4-res2)/res2 * 100,-2)).append(' %');
    $('.res6').text(Math.round10((res4-res3)/res3 * 100,-2)).append(' %');
    $('.res7').text(Math.round10((res4-res3),-2)).append(' %');
    $('.res8').text(Math.round10(res8,-2)).append(' %');
    $('.res9').text(Math.round10(res9,-2)).append(' %');
    $('.res10').text(Math.round10(res10,-2)).append(' %');
    $('.res11').text(Math.round10(res11,-2)).append(' %');
    $('.res12').text(Math.round10((res11-res9)/res9 * 100,-2)).append(' %');
    $('.res13').text(Math.round10((res11-res10)/res10 * 100,-2)).append(' %');
    $('.res14').text(Math.round10((res11-res10),-2)).append(' %');

    $('.TEnero2015').text(formatterPeso.format(Math.round10(res15)));
    
    $('.TFebrero2015').text(formatterPeso.format(Math.round10(res16)));
    
    $('.TMarzo2015').text(formatterPeso.format(Math.round10(res17)));
    $('.TAbril2015').text(formatterPeso.format(Math.round10(res18)));
    $('.TMayo2015').text(formatterPeso.format(Math.round10(res19)));
    $('.TJunio2015').text(formatterPeso.format(Math.round10(res20)));
    $('.TJulio2015').text(formatterPeso.format(Math.round10(res21)));
    $('.TAgosto2015').text(formatterPeso.format(Math.round10(res22)));
    $('.TSeptiembre2015').text(formatterPeso.format(Math.round10(res23)));
    $('.TOctubre2015').text(formatterPeso.format(Math.round10(res24)));
    $('.TNoviembre2015').text(formatterPeso.format(Math.round10(res25)));
    $('.TDiciembre2015').text(formatterPeso.format(Math.round10(res26)));
    $('.TEnero2016').text(formatterPeso.format(Math.round10(res27)));
    $('.TFebrero2016').text(formatterPeso.format(Math.round10(res28)));
    $('.TMarzo2016').text(formatterPeso.format(Math.round10(res29)));
    $('.TAbril2016').text(formatterPeso.format(Math.round10(res30)));
    $('.TMayo2016').text(formatterPeso.format(Math.round10(res31)));
    $('.TJunio2016').text(formatterPeso.format(Math.round10(res32)));
    $('.TJulio2016').text(formatterPeso.format(Math.round10(res33)));
    $('.TAgosto2016').text(formatterPeso.format(Math.round10(res34)));
    $('.TSeptiembre2016').text(formatterPeso.format(Math.round10(res35)));
    $('.TOctubre2016').text(formatterPeso.format(Math.round10(res36)));
    $('.TNoviembre2016').text(formatterPeso.format(Math.round10(res37)));
    $('.TDiciembre2016').text(formatterPeso.format(Math.round10(res38)));
    $('.TEnero2017').text(formatterPeso.format(Math.round10(res39)));
    $('.TFebrero2017').text(formatterPeso.format(Math.round10(res40)));
    $('.TMarzo2017').text(formatterPeso.format(Math.round10(res41)));
    $('.TAbril2017').text(formatterPeso.format(Math.round10(res42)));
    $('.TMayo2017').text(formatterPeso.format(Math.round10(res43)));
    $('.TJunio2017').text(formatterPeso.format(Math.round10(res44)));
    $('.TJulio2017').text(formatterPeso.format(Math.round10(res45)));
    $('.TAgosto2017').text(formatterPeso.format(Math.round10(res46)));
    $('.TSeptiembre2017').text(formatterPeso.format(Math.round10(res47)));
    $('.TOctubre2017').text(formatterPeso.format(Math.round10(res48)));
    $('.TNoviembre2017').text(formatterPeso.format(Math.round10(res49)));
    $('.TDiciembre2017').text(formatterPeso.format(Math.round10(res50)));
    $('.TEnero2018').text(formatterPeso.format(Math.round10(res51)));
    $('.TFebrero2018').text(formatterPeso.format(Math.round10(res52)));
    $('.TMarzo2018').text(formatterPeso.format(Math.round10(res53)));
    $('.TAbril2018').text(formatterPeso.format(Math.round10(res54)));
    $('.TMayo2018').text(formatterPeso.format(Math.round10(res55)));
    $('.TJunio2018').text(formatterPeso.format(Math.round10(res56)));
    $('.TJulio2018').text(formatterPeso.format(Math.round10(res57)));
    $('.TAgosto2018').text(formatterPeso.format(Math.round10(res58)));
    $('.TSeptiembre2018').text(formatterPeso.format(Math.round10(res59)));
    $('.TOctubre2018').text(formatterPeso.format(Math.round10(res60)));
    $('.TNoviembre2018').text(formatterPeso.format(Math.round10(res61)));
    $('.TDiciembre2018').text(formatterPeso.format(Math.round10(res62)));
    $('.TEnero2019').text(formatterPeso.format(Math.round10(res63)));
    $('.TFebrero2019').text(formatterPeso.format(Math.round10(res64)));
    $('.TMarzo2019').text(formatterPeso.format(Math.round10(res65)));
    $('.TAbril2019').text(formatterPeso.format(Math.round10(res66)));
    $('.TMayo2019').text(formatterPeso.format(Math.round10(res67)));
    $('.TJunio2019').text(formatterPeso.format(Math.round10(res68)));
    $('.TJulio2019').text(formatterPeso.format(Math.round10(res69)));
    $('.TAgosto2019').text(formatterPeso.format(Math.round10(res70)));
    $('.TSeptiembre2019').text(formatterPeso.format(Math.round10(res71)));
    $('.TOctubre2019').text(formatterPeso.format(Math.round10(res72)));
    $('.TNoviembre2019').text(formatterPeso.format(Math.round10(res73)));
    $('.TDiciembre2019').text(formatterPeso.format(Math.round10(res74)));
    $('.TEnero2020').text(formatterPeso.format(Math.round10(res75)));
    $('.TFebrero2020').text(formatterPeso.format(Math.round10(res76)));
    $('.TMarzo2020').text(formatterPeso.format(Math.round10(res77)));
    $('.TAbril2020').text(formatterPeso.format(Math.round10(res78)));
    $('.TMayo2020').text(formatterPeso.format(Math.round10(res79)));
    $('.TJunio2020').text(formatterPeso.format(Math.round10(res80)));
    $('.TJulio2020').text(formatterPeso.format(Math.round10(res81)));
    $('.TAgosto2020').text(formatterPeso.format(Math.round10(res82)));
    $('.TSeptiembre2020').text(formatterPeso.format(Math.round10(res83)));
    $('.TOctubre2020').text(formatterPeso.format(Math.round10(res84)));
    $('.TNoviembre2020').text(formatterPeso.format(Math.round10(res85)));
    $('.TDiciembre2020').text(formatterPeso.format(Math.round10(res86)));
    $('.TEnero2021').text(formatterPeso.format(Math.round10(res87)));
    $('.TFebrero2021').text(formatterPeso.format(Math.round10(res88)));
    $('.TMarzo2021').text(formatterPeso.format(Math.round10(res89)));
    $('.TAbril2021').text(formatterPeso.format(Math.round10(res90)));
    $('.TMayo2021').text(formatterPeso.format(Math.round10(res91)));
    $('.TJunio2021').text(formatterPeso.format(Math.round10(res92)));
    $('.TJulio2021').text(formatterPeso.format(Math.round10(res93)));
    $('.TAgosto2021').text(formatterPeso.format(Math.round10(res94)));
    $('.TSeptiembre2021').text(formatterPeso.format(Math.round10(res95)));
    $('.TOctubre2021').text(formatterPeso.format(Math.round10(res96)));
    $('.TNoviembre2021').text(formatterPeso.format(Math.round10(res97)));
    $('.TDiciembre2021').text(formatterPeso.format(Math.round10(res98)));

    $('.TEnero2022').text(formatterPeso.format(Math.round10(res100)));
    $('.TFebrero2022').text(formatterPeso.format(Math.round10(res101)));
    $('.TMarzo2022').text(formatterPeso.format(Math.round10(res102)));
    $('.TAbril2022').text(formatterPeso.format(Math.round10(res103)));
    $('.TMayo2022').text(formatterPeso.format(Math.round10(res104)));
    $('.TJunio2022').text(formatterPeso.format(Math.round10(res105)));
    $('.TJulio2022').text(formatterPeso.format(Math.round10(res106)));
    $('.TAgosto2022').text(formatterPeso.format(Math.round10(res107)));
    $('.TSeptiembre2022').text(formatterPeso.format(Math.round10(res108)));
    $('.TOctubre2022').text(formatterPeso.format(Math.round10(res109)));
    $('.TNoviembre2022').text(formatterPeso.format(Math.round10(res110)));
    $('.TDiciembre2022').text(formatterPeso.format(Math.round10(res111)));

    $('.TAcumulado').text(formatterPeso.format(Math.round10(res99)));



if (res15==0) {$('.HEnero2015').hide();} else {$('.HEnero2015').show();} 
if (res21==0) {$('.HPresupuesto').hide();} else {$('.HPresupuesto').show();} 
if (res16==0) {$('.HFebrero2015').hide();} else {$('.HFebrero2015').show();} 
if (res17==0) {$('.HMarzo2015').hide();} else {$('.HMarzo2015').show();} 
if (res18==0) {$('.HAbril2015').hide();} else {$('.HAbril2015').show();} 
if (res19==0) {$('.HMayo2015').hide();} else {$('.HMayo2015').show();} 
if (res20==0) {$('.HJunio2015').hide();} else {$('.HJunio2015').show();} 
if (res21==0) {$('.HJulio2015').hide();} else {$('.HJulio2015').show();} 
if (res22==0) {$('.HAgosto2015').hide();} else {$('.HAgosto2015').show();} 
if (res23==0) {$('.HSeptiembre2015').hide();} else {$('.HSeptiembre2015').show();} 
if (res24==0) {$('.HOctubre2015').hide();} else {$('.HOctubre2015').show();} 
if (res25==0) {$('.HNoviembre2015').hide();} else {$('.HNoviembre2015').show();} 
if (res26==0) {$('.HDiciembre2015').hide();} else {$('.HDiciembre2015').show();} 
if (res27==0) {$('.HEnero2016').hide();} else {$('.HEnero2016').show();} 
if (res28==0) {$('.HFebrero2016').hide();} else {$('.HFebrero2016').show();} 
if (res29==0) {$('.HMarzo2016').hide();} else {$('.HMarzo2016').show();} 
if (res30==0) {$('.HAbril2016').hide();} else {$('.HAbril2016').show();} 
if (res31==0) {$('.HMayo2016').hide();} else {$('.HMayo2016').show();} 
if (res32==0) {$('.HJunio2016').hide();} else {$('.HJunio2016').show();} 
if (res33==0) {$('.HJulio2016').hide();} else {$('.HJulio2016').show();} 
if (res34==0) {$('.HAgosto2016').hide();} else {$('.HAgosto2016').show();} 
if (res35==0) {$('.HSeptiembre2016').hide();} else {$('.HSeptiembre2016').show();} 
if (res36==0) {$('.HOctubre2016').hide();} else {$('.HOctubre2016').show();} 
if (res37==0) {$('.HNoviembre2016').hide();} else {$('.HNoviembre2016').show();} 
if (res38==0) {$('.HDiciembre2016').hide();} else {$('.HDiciembre2016').show();} 
if (res39==0) {$('.HEnero2017').hide();} else {$('.HEnero2017').show();} 
if (res40==0) {$('.HFebrero2017').hide();} else {$('.HFebrero2017').show();} 
if (res41==0) {$('.HMarzo2017').hide();} else {$('.HMarzo2017').show();} 
if (res42==0) {$('.HAbril2017').hide();} else {$('.HAbril2017').show();} 
if (res43==0) {$('.HMayo2017').hide();} else {$('.HMayo2017').show();} 
if (res44==0) {$('.HJunio2017').hide();} else {$('.HJunio2017').show();} 
if (res45==0) {$('.HJulio2017').hide();} else {$('.HJulio2017').show();} 
if (res46==0) {$('.HAgosto2017').hide();} else {$('.HAgosto2017').show();} 
if (res47==0) {$('.HSeptiembre2017').hide();} else {$('.HSeptiembre2017').show();} 
if (res48==0) {$('.HOctubre2017').hide();} else {$('.HOctubre2017').show();} 
if (res49==0) {$('.HNoviembre2017').hide();} else {$('.HNoviembre2017').show();} 
if (res50==0) {$('.HDiciembre2017').hide();} else {$('.HDiciembre2017').show();} 
if (res51==0) {$('.HEnero2018').hide();} else {$('.HEnero2018').show();} 
if (res52==0) {$('.HFebrero2018').hide();} else {$('.HFebrero2018').show();} 
if (res53==0) {$('.HMarzo2018').hide();} else {$('.HMarzo2018').show();} 
if (res54==0) {$('.HAbril2018').hide();} else {$('.HAbril2018').show();} 
if (res55==0) {$('.HMayo2018').hide();} else {$('.HMayo2018').show();} 
if (res56==0) {$('.HJunio2018').hide();} else {$('.HJunio2018').show();} 
if (res57==0) {$('.HJulio2018').hide();} else {$('.HJulio2018').show();} 
if (res58==0) {$('.HAgosto2018').hide();} else {$('.HAgosto2018').show();} 
if (res59==0) {$('.HSeptiembre2018').hide();} else {$('.HSeptiembre2018').show();} 
if (res60==0) {$('.HOctubre2018').hide();} else {$('.HOctubre2018').show();} 
if (res61==0) {$('.HNoviembre2018').hide();} else {$('.HNoviembre2018').show();} 
if (res62==0) {$('.HDiciembre2018').hide();} else {$('.HDiciembre2018').show();} 
if (res63==0) {$('.HEnero2019').hide();} else {$('.HEnero2019').show();} 
if (res64==0) {$('.HFebrero2019').hide();} else {$('.HFebrero2019').show();} 
if (res65==0) {$('.HMarzo2019').hide();} else {$('.HMarzo2019').show();} 
if (res66==0) {$('.HAbril2019').hide();} else {$('.HAbril2019').show();} 
if (res67==0) {$('.HMayo2019').hide();} else {$('.HMayo2019').show();} 
if (res68==0) {$('.HJunio2019').hide();} else {$('.HJunio2019').show();} 
if (res69==0) {$('.HJulio2019').hide();} else {$('.HJulio2019').show();} 
if (res70==0) {$('.HAgosto2019').hide();} else {$('.HAgosto2019').show();} 
if (res71==0) {$('.HSeptiembre2019').hide();} else {$('.HSeptiembre2019').show();} 
if (res72==0) {$('.HOctubre2019').hide();} else {$('.HOctubre2019').show();} 
if (res73==0) {$('.HNoviembre2019').hide();} else {$('.HNoviembre2019').show();} 
if (res74==0) {$('.HDiciembre2019').hide();} else {$('.HDiciembre2019').show();} 
if (res75==0) {$('.HEnero2020').hide();} else {$('.HEnero2020').show();} 
if (res76==0) {$('.HFebrero2020').hide();} else {$('.HFebrero2020').show();} 
if (res77==0) {$('.HMarzo2020').hide();} else {$('.HMarzo2020').show();} 
if (res78==0) {$('.HAbril2020').hide();} else {$('.HAbril2020').show();} 
if (res79==0) {$('.HMayo2020').hide();} else {$('.HMayo2020').show();} 
if (res80==0) {$('.HJunio2020').hide();} else {$('.HJunio2020').show();} 
if (res81==0) {$('.HJulio2020').hide();} else {$('.HJulio2020').show();} 
if (res82==0) {$('.HAgosto2020').hide();} else {$('.HAgosto2020').show();} 
if (res83==0) {$('.HSeptiembre2020').hide();} else {$('.HSeptiembre2020').show();} 
if (res84==0) {$('.HOctubre2020').hide();} else {$('.HOctubre2020').show();} 
if (res85==0) {$('.HNoviembre2020').hide();} else {$('.HNoviembre2020').show();} 
if (res86==0) {$('.HDiciembre2020').hide();} else {$('.HDiciembre2020').show();} 
if (res87==0) {$('.HEnero2021').hide();} else {$('.HEnero2021').show();} 
if (res88==0) {$('.HFebrero2021').hide();} else {$('.HFebrero2021').show();} 
if (res89==0) {$('.HMarzo2021').hide();} else {$('.HMarzo2021').show();} 
if (res90==0) {$('.HAbril2021').hide();} else {$('.HAbril2021').show();} 
if (res91==0) {$('.HMayo2021').hide();} else {$('.HMayo2021').show();} 
if (res92==0) {$('.HJunio2021').hide();} else {$('.HJunio2021').show();} 
if (res93==0) {$('.HJulio2021').hide();} else {$('.HJulio2021').show();} 
if (res94==0) {$('.HAgosto2021').hide();} else {$('.HAgosto2021').show();} 
if (res95==0) {$('.HSeptiembre2021').hide();} else {$('.HSeptiembre2021').show();} 
if (res96==0) {$('.HOctubre2021').hide();} else {$('.HOctubre2021').show();} 
if (res97==0) {$('.HNoviembre2021').hide();} else {$('.HNoviembre2021').show();} 
if (res98==0) {$('.HDiciembre2021').hide();} else {$('.HDiciembre2021').show();}

if (res100==0) {$('.HEnero2022').hide();} else {$('.HEnero2022').show();} 
if (res101==0) {$('.HFebrero2022').hide();} else {$('.HFebrero2022').show();} 
if (res102==0) {$('.HMarzo2022').hide();} else {$('.HMarzo2022').show();} 
if (res103==0) {$('.HAbril2022').hide();} else {$('.HAbril2022').show();} 
if (res104==0) {$('.HMayo2022').hide();} else {$('.HMayo2022').show();} 
if (res105==0) {$('.HJunio2022').hide();} else {$('.HJunio2022').show();} 
if (res106==0) {$('.HJulio2022').hide();} else {$('.HJulio2022').show();} 
if (res107==0) {$('.HAgosto2022').hide();} else {$('.HAgosto2022').show();} 
if (res108==0) {$('.HSeptiembre2022').hide();} else {$('.HSeptiembre2022').show();} 
if (res109==0) {$('.HOctubre2022').hide();} else {$('.HOctubre2022').show();} 
if (res110==0) {$('.HNoviembre2022').hide();} else {$('.HNoviembre2022').show();} 
if (res111==0) {$('.HDiciembre2022').hide();} else {$('.HDiciembre2022').show();}  




 // Rellena la suma de porcetajes

 var Enero2015=0;
       $('.PEnero2015').each(function(index){Enero2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPEnero2015').text(Math.round10(Enero2015,-2)).append('%');
  
    });
var Febrero2015=0;
       $('.PFebrero2015').each(function(index){Febrero2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPFebrero2015').text(Math.round10(Febrero2015,-2)).append('%');
  
    });
var Marzo2015=0;
       $('.PMarzo2015').each(function(index){Marzo2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMarzo2015').text(Math.round10(Marzo2015,-2)).append('%');
  
    });
var Abril2015=0;
       $('.PAbril2015').each(function(index){Abril2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAbril2015').text(Math.round10(Abril2015,-2)).append('%');
  
    });
var Mayo2015=0;
       $('.PMayo2015').each(function(index){Mayo2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMayo2015').text(Math.round10(Mayo2015,-2)).append('%');
  
    });
var Junio2015=0;
       $('.PJunio2015').each(function(index){Junio2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJunio2015').text(Math.round10(Junio2015,-2)).append('%');
  
    });
var Julio2015=0;
       $('.PJulio2015').each(function(index){Julio2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJulio2015').text(Math.round10(Julio2015,-2)).append('%');
  
    });
var Agosto2015=0;
       $('.PAgosto2015').each(function(index){Agosto2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAgosto2015').text(Math.round10(Agosto2015,-2)).append('%');
  
    });
var Septiembre2015=0;
       $('.PSeptiembre2015').each(function(index){Septiembre2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPSeptiembre2015').text(Math.round10(Septiembre2015,-2)).append('%');
  
    });
var Octubre2015=0;
       $('.POctubre2015').each(function(index){Octubre2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPOctubre2015').text(Math.round10(Octubre2015,-2)).append('%');
  
    });
var Noviembre2015=0;
       $('.PNoviembre2015').each(function(index){Noviembre2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPNoviembre2015').text(Math.round10(Noviembre2015,-2)).append('%');
  
    });
var Diciembre2015=0;
       $('.PDiciembre2015').each(function(index){Diciembre2015 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPDiciembre2015').text(Math.round10(Diciembre2015,-2)).append('%');
  
    });
var Enero2016=0;
       $('.PEnero2016').each(function(index){Enero2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPEnero2016').text(Math.round10(Enero2016,-2)).append('%');
  
    });
var Febrero2016=0;
       $('.PFebrero2016').each(function(index){Febrero2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPFebrero2016').text(Math.round10(Febrero2016,-2)).append('%');
  
    });
var Marzo2016=0;
       $('.PMarzo2016').each(function(index){Marzo2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMarzo2016').text(Math.round10(Marzo2016,-2)).append('%');
  
    });
var Abril2016=0;
       $('.PAbril2016').each(function(index){Abril2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAbril2016').text(Math.round10(Abril2016,-2)).append('%');
  
    });
var Mayo2016=0;
       $('.PMayo2016').each(function(index){Mayo2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMayo2016').text(Math.round10(Mayo2016,-2)).append('%');
  
    });
var Junio2016=0;
       $('.PJunio2016').each(function(index){Junio2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJunio2016').text(Math.round10(Junio2016,-2)).append('%');
  
    });
var Julio2016=0;
       $('.PJulio2016').each(function(index){Julio2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJulio2016').text(Math.round10(Julio2016,-2)).append('%');
  
    });
var Agosto2016=0;
       $('.PAgosto2016').each(function(index){Agosto2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAgosto2016').text(Math.round10(Agosto2016,-2)).append('%');
  
    });
var Septiembre2016=0;
       $('.PSeptiembre2016').each(function(index){Septiembre2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPSeptiembre2016').text(Math.round10(Septiembre2016,-2)).append('%');
  
    });
var Octubre2016=0;
       $('.POctubre2016').each(function(index){Octubre2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPOctubre2016').text(Math.round10(Octubre2016,-2)).append('%');
  
    });
var Noviembre2016=0;
       $('.PNoviembre2016').each(function(index){Noviembre2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPNoviembre2016').text(Math.round10(Noviembre2016,-2)).append('%');
  
    });
var Diciembre2016=0;
       $('.PDiciembre2016').each(function(index){Diciembre2016 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPDiciembre2016').text(Math.round10(Diciembre2016,-2)).append('%');
  
    });
var Enero2017=0;
       $('.PEnero2017').each(function(index){Enero2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPEnero2017').text(Math.round10(Enero2017,-2)).append('%');
  
    });
var Febrero2017=0;
       $('.PFebrero2017').each(function(index){Febrero2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPFebrero2017').text(Math.round10(Febrero2017,-2)).append('%');
  
    });
var Marzo2017=0;
       $('.PMarzo2017').each(function(index){Marzo2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMarzo2017').text(Math.round10(Marzo2017,-2)).append('%');
  
    });
var Abril2017=0;
       $('.PAbril2017').each(function(index){Abril2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAbril2017').text(Math.round10(Abril2017,-2)).append('%');
  
    });
var Mayo2017=0;
       $('.PMayo2017').each(function(index){Mayo2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMayo2017').text(Math.round10(Mayo2017,-2)).append('%');
  
    });
var Junio2017=0;
       $('.PJunio2017').each(function(index){Junio2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJunio2017').text(Math.round10(Junio2017,-2)).append('%');
  
    });
var Julio2017=0;
       $('.PJulio2017').each(function(index){Julio2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJulio2017').text(Math.round10(Julio2017,-2)).append('%');
  
    });
var Agosto2017=0;
       $('.PAgosto2017').each(function(index){Agosto2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAgosto2017').text(Math.round10(Agosto2017,-2)).append('%');
  
    });
var Septiembre2017=0;
       $('.PSeptiembre2017').each(function(index){Septiembre2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPSeptiembre2017').text(Math.round10(Septiembre2017,-2)).append('%');
  
    });
var Octubre2017=0;
       $('.POctubre2017').each(function(index){Octubre2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPOctubre2017').text(Math.round10(Octubre2017,-2)).append('%');
  
    });
var Noviembre2017=0;
       $('.PNoviembre2017').each(function(index){Noviembre2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPNoviembre2017').text(Math.round10(Noviembre2017,-2)).append('%');
  
    });
var Diciembre2017=0;
       $('.PDiciembre2017').each(function(index){Diciembre2017 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPDiciembre2017').text(Math.round10(Diciembre2017,-2)).append('%');
  
    });
var Enero2018=0;
       $('.PEnero2018').each(function(index){Enero2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPEnero2018').text(Math.round10(Enero2018,-2)).append('%');
  
    });
var Febrero2018=0;
       $('.PFebrero2018').each(function(index){Febrero2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPFebrero2018').text(Math.round10(Febrero2018,-2)).append('%');
  
    });
var Marzo2018=0;
       $('.PMarzo2018').each(function(index){Marzo2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMarzo2018').text(Math.round10(Marzo2018,-2)).append('%');
  
    });
var Abril2018=0;
       $('.PAbril2018').each(function(index){Abril2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAbril2018').text(Math.round10(Abril2018,-2)).append('%');
  
    });
var Mayo2018=0;
       $('.PMayo2018').each(function(index){Mayo2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMayo2018').text(Math.round10(Mayo2018,2)).append('%');
  
    });
var Junio2018=0;
       $('.PJunio2018').each(function(index){Junio2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJunio2018').text(Math.round10(Junio2018,-2)).append('%');
  
    });
var Julio2018=0;
       $('.PJulio2018').each(function(index){Julio2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJulio2018').text(Math.round10(Julio2018,-2)).append('%');
  
    });
var Agosto2018=0;
       $('.PAgosto2018').each(function(index){Agosto2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAgosto2018').text(Math.round10(Agosto2018,-2)).append('%');
  
    });
var Septiembre2018=0;
       $('.PSeptiembre2018').each(function(index){Septiembre2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPSeptiembre2018').text(Math.round10(Septiembre2018,-2)).append('%');
  
    });
var Octubre2018=0;
       $('.POctubre2018').each(function(index){Octubre2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPOctubre2018').text(Math.round10(Octubre2018,-2)).append('%');
  
    });
var Noviembre2018=0;
       $('.PNoviembre2018').each(function(index){Noviembre2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPNoviembre2018').text(Math.round10(Noviembre2018,-2)).append('%');
  
    });
var Diciembre2018=0;
       $('.PDiciembre2018').each(function(index){Diciembre2018 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPDiciembre2018').text(Math.round10(Diciembre2018,-2)).append('%');
  
    });
var Enero2019=0;
       $('.PEnero2019').each(function(index){Enero2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPEnero2019').text(Math.round10(Enero2019,-2)).append('%');
  
    });
var Febrero2019=0;
       $('.PFebrero2019').each(function(index){Febrero2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPFebrero2019').text(Math.round10(Febrero2019,-2)).append('%');
  
    });
var Marzo2019=0;
       $('.PMarzo2019').each(function(index){Marzo2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMarzo2019').text(Math.round10(Marzo2019,-2)).append('%');
  
    });
var Abril2019=0;
       $('.PAbril2019').each(function(index){Abril2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAbril2019').text(Math.round10(Abril2019,-2)).append('%');
  
    });
var Mayo2019=0;
       $('.PMayo2019').each(function(index){Mayo2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMayo2019').text(Math.round10(Mayo2019,-2)).append('%');
  
    });
var Junio2019=0;
       $('.PJunio2019').each(function(index){Junio2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJunio2019').text(Math.round10(Junio2019,-2)).append('%');
  
    });
var Julio2019=0;
       $('.PJulio2019').each(function(index){Julio2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJulio2019').text(Math.round10(Julio2019,-2)).append('%');
  
    });
var Agosto2019=0;
       $('.PAgosto2019').each(function(index){Agosto2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAgosto2019').text(Math.round10(Agosto2019,-2)).append('%');
  
    });
var Septiembre2019=0;
       $('.PSeptiembre2019').each(function(index){Septiembre2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPSeptiembre2019').text(Math.round10(Septiembre2019,-2)).append('%');
  
    });
var Octubre2019=0;
       $('.POctubre2019').each(function(index){Octubre2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPOctubre2019').text(Math.round10(Octubre2019,-2)).append('%');
  
    });
var Noviembre2019=0;
       $('.PNoviembre2019').each(function(index){Noviembre2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPNoviembre2019').text(Math.round10(Noviembre2019,-2)).append('%');
  
    });
var Diciembre2019=0;
       $('.PDiciembre2019').each(function(index){Diciembre2019 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPDiciembre2019').text(Math.round10(Diciembre2019,-2)).append('%');
  
    });
var Enero2020=0;
       $('.PEnero2020').each(function(index){Enero2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPEnero2020').text(Math.round10(Enero2020,-2)).append('%');
  
    });
var Febrero2020=0;
       $('.PFebrero2020').each(function(index){Febrero2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPFebrero2020').text(Math.round10(Febrero2020,-2)).append('%');
  
    });
var Marzo2020=0;
       $('.PMarzo2020').each(function(index){Marzo2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMarzo2020').text(Math.round10(Marzo2020,-2)).append('%');
  
    });
var Abril2020=0;
       $('.PAbril2020').each(function(index){Abril2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAbril2020').text(Math.round10(Abril2020,-2)).append('%');
  
    });
var Mayo2020=0;
       $('.PMayo2020').each(function(index){Mayo2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMayo2020').text(Math.round10(Mayo2020,-2)).append('%');
  
    });
var Junio2020=0;
       $('.PJunio2020').each(function(index){Junio2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJunio2020').text(Math.round10(Junio2020,-2)).append('%');
  
    });
var Julio2020=0;
       $('.PJulio2020').each(function(index){Julio2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJulio2020').text(Math.round10(Julio2020,-2)).append('%');
  
    });
var Agosto2020=0;
       $('.PAgosto2020').each(function(index){Agosto2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAgosto2020').text(Math.round10(Agosto2020,-2)).append('%');
  
    });
var Septiembre2020=0;
       $('.PSeptiembre2020').each(function(index){Septiembre2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPSeptiembre2020').text(Math.round10(Septiembre2020,-2)).append('%');
  
    });
var Octubre2020=0;
       $('.POctubre2020').each(function(index){Octubre2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPOctubre2020').text(Math.round10(Octubre2020,-2)).append('%');
  
    });
var Noviembre2020=0;
       $('.PNoviembre2020').each(function(index){Noviembre2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPNoviembre2020').text(Math.round10(Noviembre2020,-2)).append('%');
  
    });
var Diciembre2020=0;
       $('.PDiciembre2020').each(function(index){Diciembre2020 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPDiciembre2020').text(Math.round10(Diciembre2020,-2)).append('%');
  
    });
var Enero2021=0;
       $('.PEnero2021').each(function(index){Enero2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPEnero2021').text(Math.round10(Enero2021,-2)).append('%');
  
    });
var Febrero2021=0;
       $('.PFebrero2021').each(function(index){Febrero2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPFebrero2021').text(Math.round10(Febrero2021,-2)).append('%');
  
    });
var Marzo2021=0;
       $('.PMarzo2021').each(function(index){Marzo2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMarzo2021').text(Math.round10(Marzo2021,-2)).append('%');
  
    });
var Abril2021=0;
       $('.PAbril2021').each(function(index){Abril2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAbril2021').text(Math.round10(Abril2021,-2)).append('%');
  
    });
var Mayo2021=0;
       $('.PMayo2021').each(function(index){Mayo2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPMayo2021').text(Math.round10(Mayo2021,-2)).append('%');
  
    });
var Junio2021=0;
       $('.PJunio2021').each(function(index){Junio2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJunio2021').text(Math.round10(Junio2021,-2)).append('%');
  
    });
var Julio2021=0;
       $('.PJulio2021').each(function(index){Julio2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPJulio2021').text(Math.round10(Julio2021,-2)).append('%');
  
    });
var Agosto2021=0;
       $('.PAgosto2021').each(function(index){Agosto2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAgosto2021').text(Math.round10(Agosto2021,-2)).append('%');
  
    });
var Septiembre2021=0;
       $('.PSeptiembre2021').each(function(index){Septiembre2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPSeptiembre2021').text(Math.round10(Septiembre2021,-2)).append('%');
  
    });
var Octubre2021=0;
       $('.POctubre2021').each(function(index){Octubre2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPOctubre2021').text(Math.round10(Octubre2021,-2)).append('%');
  
    });
var Noviembre2021=0;
       $('.PNoviembre2021').each(function(index){Noviembre2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPNoviembre2021').text(Math.round10(Noviembre2021,-2)).append('%');
  
    });
var Diciembre2021=0;
       $('.PDiciembre2021').each(function(index){Diciembre2021 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPDiciembre2021').text(Math.round10(Diciembre2021,-2)).append('%');
  
    });

var Acumulado1=0;
       $('.PAcumulado').each(function(index){Acumulado1 += parseFloat($(this).text().replace(',', '.'));
       
       $('.TPAcumulado').text(Math.round10(Acumulado1,-2)).append('%');
  
    });

var PNeto=0;
       $('.PNeto').each(function(index){PNeto += parseFloat($(this).text().replace(',', '.'));
       
  
    });
var PNeto2=0;
       $('.Ppres').each(function(index){PNeto2 += parseFloat($(this).text().replace(',', '.'));
       
  
    });       


$('.PNeto').append('%');
$('.Porcentaje1').text(Math.round10(PNeto,-2)).append('%')
$('.Ppres').append('%');
$('.Porcentaje2').text(Math.round10(PNeto2,-2)).append('%')           

var Acum = $('#AcumuladoMes').text();
console.log(parseFloat(Acum));
if (Acum != 1 ) {
//Quita el signo precio de los empleados
$('.NEnero2015').last().text(Per1);
$('.NFebrero2015').last().text(Per2);
$('.NMarzo2015').last().text(Per3);
$('.NAbril2015').last().text(Per4);
$('.NMayo2015').last().text(Per5);
$('.NJunio2015').last().text(Per6);
$('.NJulio2015').last().text(Per7);
$('.NAgosto2015').last().text(Per8);
$('.NSeptiembre2015').last().text(Per9);
$('.NOctubre2015').last().text(Per10);
$('.NNoviembre2015').last().text(Per11);
$('.NDiciembre2015').last().text(Per12);
$('.NEnero2016').last().text(Per13);
$('.NFebrero2016').last().text(Per14);
$('.NMarzo2016').last().text(Per15);
$('.NAbril2016').last().text(Per16);
$('.NMayo2016').last().text(Per17);
$('.NJunio2016').last().text(Per18);
$('.NJulio2016').last().text(Per19);
$('.NAgosto2016').last().text(Per20);
$('.NSeptiembre2016').last().text(Per21);
$('.NOctubre2016').last().text(Per22);
$('.NNoviembre2016').last().text(Per23);
$('.NDiciembre2016').last().text(Per24);
$('.NEnero2017').last().text(Per25);
$('.NFebrero2017').last().text(Per26);
$('.NMarzo2017').last().text(Per27);
$('.NAbril2017').last().text(Per28);
$('.NMayo2017').last().text(Per29);
$('.NJunio2017').last().text(Per30);
$('.NJulio2017').last().text(Per31);
$('.NAgosto2017').last().text(Per32);
$('.NSeptiembre2017').last().text(Per33);
$('.NOctubre2017').last().text(Per34);
$('.NNoviembre2017').last().text(Per35);
$('.NDiciembre2017').last().text(Per36);
$('.NEnero2018').last().text(Per37);
$('.NFebrero2018').last().text(Per38);
$('.NMarzo2018').last().text(Per39);
$('.NAbril2018').last().text(Per40);
$('.NMayo2018').last().text(Per41);
$('.NJunio2018').last().text(Per42);
$('.NJulio2018').last().text(Per43);
$('.NAgosto2018').last().text(Per44);
$('.NSeptiembre2018').last().text(Per45);
$('.NOctubre2018').last().text(Per46);
$('.NNoviembre2018').last().text(Per47);
$('.NDiciembre2018').last().text(Per48);
$('.NEnero2019').last().text(Per49);
$('.NFebrero2019').last().text(Per50);
$('.NMarzo2019').last().text(Per51);
$('.NAbril2019').last().text(Per52);
$('.NMayo2019').last().text(Per53);
$('.NJunio2019').last().text(Per54);
$('.NJulio2019').last().text(Per55);
$('.NAgosto2019').last().text(Per56);
$('.NSeptiembre2019').last().text(Per57);
$('.NOctubre2019').last().text(Per58);
$('.NNoviembre2019').last().text(Per59);
$('.NDiciembre2019').last().text(Per60);
$('.NEnero2020').last().text(Per61);
$('.NFebrero2020').last().text(Per62);
$('.NMarzo2020').last().text(Per63);
$('.NAbril2020').last().text(Per64);
$('.NMayo2020').last().text(Per65);
$('.NJunio2020').last().text(Per66);
$('.NJulio2020').last().text(Per67);
$('.NAgosto2020').last().text(Per68);
$('.NSeptiembre2020').last().text(Per69);
$('.NOctubre2020').last().text(Per70);
$('.NNoviembre2020').last().text(Per71);
$('.NDiciembre2020').last().text(Per72);
$('.NEnero2021').last().text(Per73);
$('.NFebrero2021').last().text(Per74);
$('.NMarzo2021').last().text(Per75);
$('.NAbril2021').last().text(Per76);
$('.NMayo2021').last().text(Per77);
$('.NJunio2021').last().text(Per78);
$('.NJulio2021').last().text(Per79);
$('.NAgosto2021').last().text(Per80);
$('.NSeptiembre2021').last().text(Per81);
$('.NOctubre2021').last().text(Per82);
$('.NNoviembre2021').last().text(Per83);
$('.NDiciembre2021').last().text(Per84);

$('.NEnero2022').last().text(Per86);
$('.NFebrero2022').last().text(Per87);
$('.NMarzo2022').last().text(Per88);
$('.NAbril2022').last().text(Per89);
$('.NMayo2022').last().text(Per90);
$('.NJunio2022').last().text(Per91);
$('.NJulio2022').last().text(Per92);
$('.NAgosto2022').last().text(Per93);
$('.NSeptiembre2022').last().text(Per94);
$('.NOctubre2022').last().text(Per95);
$('.NNoviembre2022').last().text(Per96);
$('.NDiciembre2022').last().text(Per97);

$('.NAcumulado').last().text(Per85);

} else {

//Quita el signo precio de los empleados
$('.NEnero2015').last().text(Math.round10(Per1/1,0));
$('.NFebrero2015').last().text(Math.round10(Per2/2 ,0));
$('.NMarzo2015').last().text(Math.round10(Per3/3,0));
$('.NAbril2015').last().text(Math.round10(Per4/4,0));
$('.NMayo2015').last().text(Math.round10(Per5/5,0));
$('.NJunio2015').last().text(Math.round10(Per6/6,0));
$('.NJulio2015').last().text(Math.round10(Per7/7,0));
$('.NAgosto2015').last().text(Math.round10(Per8/8,0));
$('.NSeptiembre2015').last().text(Math.round10(Per9/9,0));
$('.NOctubre2015').last().text(Math.round10(Per10/10,0));
$('.NNoviembre2015').last().text(Math.round10(Per11/11,0));
$('.NDiciembre2015').last().text(Math.round10(Per12/12,0));
$('.NEnero2016').last().text(Math.round10(Per13/1,0));
$('.NFebrero2016').last().text(Math.round10(Per14/2,0));
$('.NMarzo2016').last().text(Math.round10(Per15/3,0));
$('.NAbril2016').last().text(Math.round10(Per16/4,0));
$('.NMayo2016').last().text(Math.round10(Per17/5,0));
$('.NJunio2016').last().text(Math.round10(Per18/6,0));
$('.NJulio2016').last().text(Math.round10(Per19/7,0));
$('.NAgosto2016').last().text(Math.round10(Per20/8,0));
$('.NSeptiembre2016').last().text(Math.round10(Per21/9,0));
$('.NOctubre2016').last().text(Math.round10(Per22/10,0));
$('.NNoviembre2016').last().text(Math.round10(Per23/11,0));
$('.NDiciembre2016').last().text(Math.round10(Per24/12,0));
$('.NEnero2017').last().text(Math.round10(Per25/1,0));
$('.NFebrero2017').last().text(Math.round10(Per26/2,0));
$('.NMarzo2017').last().text(Math.round10(Per27/3,0));
$('.NAbril2017').last().text(Math.round10(Per28/4,0));
$('.NMayo2017').last().text(Math.round10(Per29/5,0));
$('.NJunio2017').last().text(Math.round10(Per30/6,0));
$('.NJulio2017').last().text(Math.round10(Per31/7,0));
$('.NAgosto2017').last().text(Math.round10(Per32/8,0));
$('.NSeptiembre2017').last().text(Math.round10(Per33/9,0));
$('.NOctubre2017').last().text(Math.round10(Per34/10,0));
$('.NNoviembre2017').last().text(Math.round10(Per35/11,0));
$('.NDiciembre2017').last().text(Math.round10(Per36/12,0));
$('.NEnero2018').last().text(Math.round10(Per37/1,0));
$('.NFebrero2018').last().text(Math.round10(Per38/2,0));
$('.NMarzo2018').last().text(Math.round10(Per39/3,0));
$('.NAbril2018').last().text(Math.round10(Per40/4,0));
$('.NMayo2018').last().text(Math.round10(Per41/5,0));
$('.NJunio2018').last().text(Math.round10(Per42/6,0));
$('.NJulio2018').last().text(Math.round10(Per43/7,0));
$('.NAgosto2018').last().text(Math.round10(Per44/8,0));
$('.NSeptiembre2018').last().text(Math.round10(Per45/9,0));
$('.NOctubre2018').last().text(Math.round10(Per46/10,0));
$('.NNoviembre2018').last().text(Math.round10(Per47/11,0));
$('.NDiciembre2018').last().text(Math.round10(Per48/12,0));
$('.NEnero2019').last().text(Math.round10(Per49/1,0));
$('.NFebrero2019').last().text(Math.round10(Per50/2,0));
$('.NMarzo2019').last().text(Math.round10(Per51/3,0));
$('.NAbril2019').last().text(Math.round10(Per52/4,0));
$('.NMayo2019').last().text(Math.round10(Per53/5,0));
$('.NJunio2019').last().text(Math.round10(Per54/6,0));
$('.NJulio2019').last().text(Math.round10(Per55/7,0));
$('.NAgosto2019').last().text(Math.round10(Per56/8,0));
$('.NSeptiembre2019').last().text(Math.round10(Per57/9,0));
$('.NOctubre2019').last().text(Math.round10(Per58/10,0));
$('.NNoviembre2019').last().text(Math.round10(Per59/11,0));
$('.NDiciembre2019').last().text(Math.round10(Per60/12,0));
$('.NEnero2020').last().text(Math.round10(Per61/1,0));
$('.NFebrero2020').last().text(Math.round10(Per62/2,0));
$('.NMarzo2020').last().text(Math.round10(Per63/3,0));
$('.NAbril2020').last().text(Math.round10(Per64/4,0));
$('.NMayo2020').last().text(Math.round10(Per65/5,0));
$('.NJunio2020').last().text(Math.round10(Per66/6,0));
$('.NJulio2020').last().text(Math.round10(Per67/7,0));
$('.NAgosto2020').last().text(Math.round10(Per68/8,0));
$('.NSeptiembre2020').last().text(Math.round10(Per69/9,0));
$('.NOctubre2020').last().text(Math.round10(Per70/10,0));
$('.NNoviembre2020').last().text(Math.round10(Per71/11,0));
$('.NDiciembre2020').last().text(Math.round10(Per72/12,0));
$('.NEnero2021').last().text(Math.round10(Per73/1,0));
$('.NFebrero2021').last().text(Math.round10(Per74/2,0));
$('.NMarzo2021').last().text(Math.round10(Per75/3,0));
$('.NAbril2021').last().text(Math.round10(Per76/4,0));
$('.NMayo2021').last().text(Math.round10(Per77/5,0));
$('.NJunio2021').last().text(Math.round10(Per78/6,0));
$('.NJulio2021').last().text(Math.round10(Per79/7,0));
$('.NAgosto2021').last().text(Math.round10(Per80/8,0));
$('.NSeptiembre2021').last().text(Math.round10(Per81/9,0));
$('.NOctubre2021').last().text(Math.round10(Per82/10,0));
$('.NNoviembre2021').last().text(Math.round10(Per83/11,0));
$('.NDiciembre2021').last().text(Math.round10(Per84/12,0));

$('.NEnero2022').last().text(Math.round10(Per86/1,0));
$('.NFebrero2022').last().text(Math.round10(Per87/2,0));
$('.NMarzo2022').last().text(Math.round10(Per88/3,0));
$('.NAbril2022').last().text(Math.round10(Per89/4,0));
$('.NMayo2022').last().text(Math.round10(Per90/5,0));
$('.NJunio2022').last().text(Math.round10(Per91/6,0));
$('.NJulio2022').last().text(Math.round10(Per92/7,0));
$('.NAgosto2022').last().text(Math.round10(Per93/8,0));
$('.NSeptiembre2022').last().text(Math.round10(Per94/9,0));
$('.NOctubre2022').last().text(Math.round10(Per95/10,0));
$('.NNoviembre2022').last().text(Math.round10(Per96/11,0));
$('.NDiciembre2022').last().text(Math.round10(Per97/12,0));

$('.NAcumulado').last().text(Math.round10(Per85,0));

}







var tam = $('.colorfila').length;    
console.log(tam);

$('.colorfila').each(function(index, el) {

 
 if (index===9) {
    $(this).css({
        'background-color': '#ABEBC6',
        'font-weight': 'bold'
    });
 }

if (index===4 && tam===11) {
    $(this).css({
        'background-color': '#85C1E9',
        'font-weight': 'bold'
    });
 } else if (index===4 && tam===10) {
    $(this).css({
        'background-color': '#85C1E9',
        'font-weight': 'bold'
    });
 }

 if (index===8 && tam===11) {
    $(this).css({
        'background-color': '#85C1E9',
        'font-weight': 'bold'
    });
 } else if (index===8 && tam===10) {
    $(this).css({
        'background-color': '#85C1E9',
        'font-weight': 'bold'
    });
 }


    
});



$('.inmovilizadaBod').each(function(index, el) {


 if (index===9) {
    $(this).css({
        'background-color': '#ABEBC6',
        'font-weight': 'bold'
    });
 }


if (index===4 && tam===11) {
    $(this).css({
        'background-color': '#85C1E9',
        'font-weight': 'bold'
    });
 } else if (index===4 && tam===10) {
    $(this).css({
        'background-color': '#85C1E9',
        'font-weight': 'bold'
    });
 }

 if (index===8 && tam===11) {
    $(this).css({
        'background-color': '#85C1E9',
        'font-weight': 'bold'
    });
 } else if (index===8 && tam===10) {
    $(this).css({
        'background-color': '#85C1E9',
        'font-weight': 'bold'
    });
 }




    
});



//Pinta de color una celda
$('.HEnero2021').mouseenter(function(event) {
    //console.log(event);
    $(this).closest('td').css('background-color', '#C3EE6D');

});
$('.HEnero2021').mouseleave(function(event) {
    //console.log(event);
    $(this).closest('td').css('background-color', '');
   
});

$('.NAcumulado').last().text(Math.round10(Per85,0));


 }); 





 




    



