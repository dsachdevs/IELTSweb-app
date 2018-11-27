
<?php
require_once './dependencies/dompdf/lib/html5lib/Parser.php';
// require_once './dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
// require_once './dompdf/lib/php-svg-lib/src/autoload.php';
require_once './dependencies/dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isRemoteEnabled', TRUE);

// instantiate and use the dompdf class
$dompdf = new Dompdf($options);

$context = stream_context_create([
	'ssl' => [
		'verify_peer' => FALSE,
		'verify_peer_name' => FALSE,
		'allow_self_signed' => TRUE,
	],
]);
$dompdf->setHttpContext($context);

$html = <<<EOD
    <div style=" width:750px; height: 500px; padding: 7px; border: 1px solid; border-radius: 21px; margin:80px 0px 0px 120px;">
        <div style=" margin: 21px 15px 0px 21px; float: left; ">
            <div style="display: inline-block;">
                <img src="./images/logo_uncut.PNG" style="height: 80px;">
            </div>
            <h2 style="display: inline-block; margin: 0px; margin-left: 180px;"> Test Report</h2>
            <div style="display: inline-block;  margin-left: 180px;">
                <div >Date: 2018-10-19</div>
                <div style="border: 1px solid; padding: 3px;">Test Id: 12345</div>
            </div>
        </div>
        <hr style="clear: both; margin:0px; ">
        <div style="margin: 0px 15px 0px 21px;">
            <h3>Candidate Details:</h3>
            <div style="float: left; margin: 21px 15px 0px 21px;">
                <div style="display: inline-block; padding: 1px;">Name:</div>
                <div style=" display: inline-block; width:250px;  border: 1px solid; padding: 1px 7px; margin-left: 25px;"> Dhiraj Sachdev</div>
            </div> <br/>
            <div style="clear: both; float: left; margin: 21px 15px 0px 21px;">
                <div style="display: inline-block; padding: 1px;">User:</div>
                <div style="display: inline-block; width:150px;  border: 1px solid; padding: 1px 7px; margin-left: 33px;">dsachdevs</div>

                <div style="display: inline-block; padding: 1px; margin-left: 27px;">E-mail:</div>
                <div style="display: inline-block; width:250px;  border: 1px solid; padding: 1px 7px; margin-left: 25px;">dsachdevs@humber.ca</div>
            </div>
        </div>
        <br/> <hr style="clear: both; margin:0px;">
        <div style="margin: 0px 15px 0px 21px;">
            <h3>Test Results:</h3>
            <div style="margin: 21px 15px 0px 21px; float: left;">
                <div style="padding: 7px; display: inline-block; ">Listening:</div>
                <div style="display: inline-block; width:27px;  border: 1px solid; padding: 7px;  font-weight: bold;"> 7.0</div>

                <div style="display: inline-block; padding: 7px; margin-left: 11px;">Reading:</div>
                <div style="display: inline-block; width:27px;  border: 1px solid; padding: 7px;  font-weight: bold;"> 7.0</div>

                <div style="display: inline-block; padding: 7px; margin-left: 11px;">Writing:</div>
                <div style="display: inline-block; width:27px;  border: 1px solid; padding: 7px;  font-weight: bold;"> 7.0</div>

                <div style="display: inline-block; padding: 7px; margin-left: 11px;">Speaking:</div>
                <div style="display: inline-block; width:27px;  border: 1px solid; padding: 7px; font-weight: bold;"> 7.0</div>

                <div style="display: inline-block; padding: 7px; margin-left: 11px;">Overall:</div>
                <div style="display: inline-block; width:27px;  border: 1px solid; padding: 7px;  font-weight: bold;"> 7.0</div>
            </div>
        </div>
        <br/> <br/>
        <div style=" clear: both; margin: 21px 15px 0px 21px; float: right;">
            <div style="display: inline-block; padding: 7px;">Test Date:</div>
            <div style="width:77px; display: inline-block; padding: 7px; font-weight: bold;"> 2018-09-29</div>
            <img src="./images/signature.PNG" style="display: inline-block; width: 120px; height: 80px; margin: 5px 55px">
        </div>
        <br/> <br/> <br/>
        <div style="clear: both; margin: 50px 15px 0px 21px; float: right;">
            <div style="display: inline-block; padding: 7px; border-top: 1px solid;">Administrator's Signature</div>
        </div>
    </div>

EOD;

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
// $dompdf->stream();
$dompdf->stream("codexworld", array("Attachment" => 0));
