/**
 * xuad.net tutorial: ajax_tutorial
 *
 * Copyright (c) Patrick Mosch
 *
 * @link http://xuad.net
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

$(document).ready(function()
{	
	// Einfacher AJAX-Aufruf
	$("button#ajaxCall_easy").click(function() {
									
		$.ajax({
			type: "POST",
			url: "server.php",
			data: {
				method: "easy_call"
			},
			success: function(content) {
				$("#content").text(content);
			}
		});
		
		return false;
	});
	
	// AJAX-Aufruf mit Template nachladen
	$("button#ajaxCall_template").click(function() {
									
		$.ajax({
			type: "POST",
			url: "server.php",
			data: {
				method: "load_template"
			},
			success: function(content) {
				$("#content").html(content);
			}
		});
		
		return false;
	});
	
	// AJAX-Aufruf mit Template nachladen
	$("button#ajaxCall_checkPrime").click(function() {
		
		// Eingebene Zahl aus dem Eingabefeld beziehen
		var inputNumber = $("input#inputNumber").val();
		
		// Objekt mit Inhalt bilden
		var values = {
			"inputNumber": inputNumber
		};
			
		if(inputNumber != "")
		{
			// JSON-Objekt wird zu einem string konvertiert, da wir nur ein serialisiertes Objekt uebergeben koennen
			var jsonString = JSON.stringify(values);
			SendAjaxJsonRequest("server.php", "check_prime", jsonString);		
		}
		else
		{
			alert("Bitte geben Sie eine beliebige Ganzzahl ein!");
		}
		
		return false;
	});
});

/**
 * Sendet Ajax-Request
 */
function SendAjaxJsonRequest(url, method, jsonObject)
{
	$.ajax({
		type: "POST",
		url: url,
		data: {
			method: method,
			jsonObject: jsonObject
		},
		success: onSuccess
	});
}

/**
 * AJAX-Response auswerten
 */
function onSuccess(content)
{
	// Das empfangene Objekt wird wieder zum Objekt geparst
	var response = $.parseJSON(content);
	
	// geladenes Template im Container "content" austauschen
	$("#content").html(response.template);
	
	// Pruefen ob die Eingabe richtig ist,
	if(!response.result)
	{
		// Wenn ein Fehler auftritt wird das Eingabefeld rot gefaerbt
		$(".control-group").addClass("error");
	}
	else
	{
		// Wenn ein kein Fehler auftritt wird die vorhandene CSS-Klasse error entfernt (falls gesetzt)
		$(".control-group").removeClass("error");
	}
}