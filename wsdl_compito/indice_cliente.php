<html>
    <head>
        <title>Test SOAP</title>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    </head>
    <body>
        <form method="POST" action="" class="form-inline">
			<div class="form-group">	
				<div class="col">
            		converti <input type="number" name="qty" value="1" min="1"/>
            		<select name="from" id="from">
						<option value='m'>m</option>
						<option value='cm'>cm</option>
						<option value='mm'>mm</option>
						<option value='km'>km</option>
						<option value='mi'>mi</option>
						<option value='yd'>yd</option>
						<option value='ft'>ft</option>
						<option value='in'>in</option>
					</select> in
            		<select name="to" id="to">
						<option value='m'>m</option>
						<option value='cm'>cm</option>
						<option value='mm'>mm</option>
						<option value='km'>km</option>
						<option value='mi'>mi</option>
						<option value='yd'>yd</option>
						<option value='ft'>ft</option>
						<option value='in'>in</option>
					</select> 
				</div>
            <input type="submit" value="conversione" class="btn btn-primary mb-2"/>
			</div>
        </form>
    </body>

<?php

//Client SOAP

$wsdl_url = "http://127.0.0.1/wsdl_compito/funzione.wsdl";

if (isset($_POST['qty']) && !empty($_POST['qty']) && isset($_POST['from']) && !empty($_POST['from'])&& isset($_POST['to']) && !empty($_POST['to'])){ 

   try {

        $valoreQuantita=$_POST['qty'];
        $unitaOrigine=$_POST['from'];
        $unitaDestinazione=$_POST['to'];

        $client = new SoapClient($wsdl_url,["location" =>"http://127.0.0.1/wsdl_compito/indice_server.php",""]);

        $risultatoConversione = $client->CalcolaConversione($valoreQuantita, $unitaOrigine, $unitaDestinazione);

        echo "<div class='jumbotron'><h1>La conversione di ".$valoreQuantita." ".$unitaOrigine." in ".$unitaDestinazione." è ".$risultatoConversione."</h1><br></div>";

    } catch (SoapFault $e){

        echo '<br>Errore nel client SOAP: ' . $e->getMessage();

    } 

}
?>

</html>