//FUNCIÓN JAVASCRIPT

function ocultacampos(campo,valor,camposocultar)
{
    var validar = document.getElementById(campo);
    var chosenoption = validar.options[validar.selectedIndex];
    if (chosenoption.value != valor)
    {
        var listacampos = camposocultar.split("|");
        for (i = 0; i < listacampos.length; i++)
        {
            document.getElementById(listacampos[i]).style.display = 'none';
        }
    }

    else
    {
        var listacampos = camposocultar.split("|");
        for (i = 0; i < listacampos.length; i++)
        {
            
            document.getElementById(listacampos[i]).style.display = 'block';
        }
    }
}


function ocultaLenguaje()
{
   var elementoLenguaje = document.getElementById('lenguaje'), valorElementoLenguaje = elementoLenguaje.value; 

   if(valorElementoLenguaje == "10")
   {
    document.getElementById('lenguajeID').style.display="block";
   }

   else
   {
    document.getElementById('lenguajeID').style.display="none";
   }
}


function ocultaCapacidad()
{
   var elementoCapacidad = document.getElementById('capacidad'), valorElementoCapacidad = elementoCapacidad.value; 

   if(valorElementoCapacidad != "1")
   {
    document.getElementById('capacidadID').style.display="block";
   }

   else
   {
    document.getElementById('capacidadID').style.display="none";
   }
}


function ocultaRenta()
{
   var myElement = document.getElementById('rid'), myElementValue = myElement.value; 

   if(myElementValue == "si")
   {
    document.getElementById('rentaID').style.display="block";
   }

   else
   {
    document.getElementById('rentaID').style.display="none";
   }
}

function ocultaEnfermedad()
{
   var elementoEnfermedad = document.getElementById('enfermedad'), valorElementoEnfermedad = elementoEnfermedad.value; 

   if(valorElementoEnfermedad == "otro")
   {
    document.getElementById('enfermedadID').style.display="block";
   }

   else
   {
    document.getElementById('enfermedadID').style.display="none";
   }
}

function ocultaAlergia()
{
   var elementoAlergia = document.getElementById('alergia'), valorElementoAlergia = elementoAlergia.value; 

   if(valorElementoAlergia == "si")
   {
    document.getElementById('alergiaID').style.display="block";
   }

   else
   {
    document.getElementById('alergiaID').style.display="none";
   }
}

function ocultaMedicamento()
{
   var elementoMedicamento = document.getElementById('medicamento'), valorElementoMedicamento = elementoMedicamento.value; 

   if(valorElementoMedicamento == "si")
   {
    document.getElementById('medicamentoID').style.display="block";
   }

   else
   {
    document.getElementById('medicamentoID').style.display="none";
   }
}

function listo()
{

        alert("hola");

}


 $(document).ready(function() {
    $("input[type=radio]").click(function(event)
    {
        var valor = $(event.target).val();
    if(valor =="cambio")
        {
            $("#cdiabe1").show();
            $("#cdiabe2").hide();
        } 
    
    else if (valor == "equivalencia") 
    {
            $("#cdiabe1").hide();
            $("#cdiabe2").show();
    } 
    
    else  if (valor == "nuevo")
    { 
            $("#cdiabe1").hide();
            $("#cdiabe2").hide(); 
    }
    
    });
    });
 
