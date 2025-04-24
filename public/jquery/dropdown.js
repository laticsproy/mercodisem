$("#estado_1").change(function(event)
{
	$.get("http://localhost:8000/municipios/"+event.target.value+"",function(response,estado)
	{
		//console.log(response);
		$("#municipio_1").empty();
		for(i=0; i<response.length; i++)
		{
			$("#municipio_1").append("<option value= '"+response[i].id+"'> "+response[i].nombre+" </option>");
		}

	});

});

$("#estado_2").change(function(event)
{
	$.get("http://localhost:8000/municipios/"+event.target.value+"",function(response,estado)
	{
		//console.log(response);
		$("#municipio_2").empty();
		for(i=0; i<response.length; i++)
		{
			$("#municipio_2").append("<option value= '"+response[i].id+"'> "+response[i].nombre+" </option>");
		}

	});

});

$("#estado_3").change(function(event)
{
	$.get("http://localhost:8000/municipios/"+event.target.value+"",function(response,estado)
	{
		//console.log(response);
		$("#municipio_3").empty();
		for(i=0; i<response.length; i++)
		{
			$("#municipio_3").append("<option value= '"+response[i].id+"'> "+response[i].nombre+" </option>");
		}

	});

});


$("#estado_4").change(function(event)
{
	$.get("http://localhost:8000/municipios/"+event.target.value+"",function(response,estado)
	{
		//console.log(response);
		$("#municipio_4").empty();
		for(i=0; i<response.length; i++)
		{
			$("#municipio_4").append("<option value= '"+response[i].id+"'> "+response[i].nombre+" </option>");
		}

	});

});
