<?php

/**
 * xuad.net tutorial: ajax_tutorial
 *
 * Copyright (c) Patrick Mosch
 *
 * @link http://xuad.net
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * AjaxController
 *
 * @author Patrick Mosch
 */
class AjaxController
{

	/**
	 * Standard-Konstruktor
	 */
	public function __construct() {}

	/**
	 * AJAX-Methode ausfuehren
	 */
	public function execute()
	{
		// Aufgerufene Methode
		$method = "";

		// JSON-Objekt falls vorhanden
		$jsonObject = null;

		// Rueckgabeobjekt
		$result = "";

		// Rueckgabe als JSON-Objekt
		$responseJson = false;

		// Unsichere Methode um POST-Variablen zu speichern, sollte jedoch
		// fuer unser Tutorial ausreichend sein. Die POST-Variablen sollten aus 
		// Sicherheitsgruenden immer escaped werden!
		if (isset($_POST['method']))
		{
			$method = $_POST['method'];
		}

		// Pruefen ob ein JSON-Objekt gesetzt ist
		if (isset($_POST['jsonObject']))
		{
			// JSON-String parsen damit auf das Objekt zugegriffen werden kann
			$jsonObject = json_decode($_POST['jsonObject']);

			// Ausgabe soll als JSON-Objekt erfolgen
			$responseJson = true;
		}

		// Springt in die jeweilige Methode, welche beim AJAX-Aufruf angegeben wurde
		switch ($method)
		{
			case "easy_call":

				// Meldung als Rueckgabewert setzen
				$result = "Einfacher AJAX-Aufruf war erfolgreich!";

				break;
			case "load_template":

				// Template in Variable laden und als Rueckgabewert setzen
				$result = file_get_contents("./templates/template1.html");

				break;
			case "check_prime":
				// Ermitteln ob die uebergebene Zahl 
				$isPrimeNumber = $this->checkPrimeNumber($jsonObject->inputNumber);

				// Template in Variable laden
				$fileContent = file_get_contents("./templates/template2.html");

				// Pruefen ob es eine Primzahl ist. Anhand dessen werden unterschiedliche Ausgaben erzeugt
				if ($isPrimeNumber)
				{
					// CSS-Klasse setzen -> die Box wird gruen
					$templateContent = str_replace("###CONTAINER_CLASS###", "alert-success", $fileContent);

					// Meldung in der Box setzen
					$templateContent = str_replace("###PLACEHOLDER###", "Die eingebene Zahl " . $jsonObject->inputNumber . " ist eine Primzahl!", $templateContent);
				}
				else
				{
					// CSS-Klasse setzen -> die Box wird rot
					$templateContent = str_replace("###CONTAINER_CLASS###", "alert-error", $fileContent);

					// Meldung in der Box setzen
					$templateContent = str_replace("###PLACEHOLDER###", "Die eingebene Zahl " . $jsonObject->inputNumber . " ist KEINE Primzahl!", $templateContent);
				}

				// RueckgabeArray fuellen
				$responseArray = array(
					"result" => $isPrimeNumber,
					"template" => $templateContent
				);

				$result = json_encode($responseArray);

				break;
			default:
				$result = "Ein Fehler ist aufgetreten!";

				break;
		}

		return $result;
	}

	/**
	 * Prueft ob uebergebene Zahl eine Primzahl ist
	 * @param type $inputNumber
	 * @return boolean
	 */
	protected function checkPrimeNumber($inputNumber)
	{
		// Wurzel ziehen, dies bestimmt die maximale Anzahl an Durchlaeufen
		$squareRoot = sqrt($inputNumber);

		for ($i = 2; $i <= $squareRoot; ++$i)
		{
			// Per Modulo pruefen ob Restwert 0 ist
			if ($inputNumber % $i == 0)
			{
				return false;
			}
		}
		return true;
	}

}

?>
