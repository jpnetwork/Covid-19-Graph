<?php
date_default_timezone_set('Asia/Bangkok');
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

$json = file_get_contents("https://covid19.th-stat.com/api/open/timeline");
$someArray = json_decode($json, true);


            foreach ($someArray['Data'] as $value) {
            $mydate = explode("/", $value['Date']);
            if($mydate[0] >= "3") {
            $Date .=   "['".$value['Date']."'], ";
            $NewConfirmed .=   "[".$value['NewConfirmed']."], ";
            $NewRecovered .=   "[".$value['NewRecovered']."], ";
            $NewHospitalized .=   "[".$value['NewHospitalized']."], ";
            $NewDeaths .=   "[".$value['NewDeaths']."], ";
            $Confirmed .=   "[".$value['Confirmed']."], ";
            $Recovered .=   "[".$value['Recovered']."], ";
            $Hospitalized .=   "[".$value['Hospitalized']."], ";
            $Deaths .=   "[".$value['Deaths']."], ";
            } }
        ?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Covid-19</title>
</head>

<body>
    <script src="https://run.myschool.in.th/assets/chart/highcharts.js"></script>
    <script src="https://run.myschool.in.th/assets/chart/highcharts-3d.js"></script>
    <script src="https://run.myschool.in.th/assets/chart/modules/exporting.js"></script>
    <script src="https://run.myschool.in.th/assets/chart/modules/export-data.js"></script>
    <h1>Covid-19</h1>
    <div id="container" style="height: 500px;"></div>

    <script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'ข้อมูลสรุปตามช่วงเวลา (ตัดเอาเฉพาะเดือนมีนาคม 63 เป็นต้นมา)'
        },
        subtitle: {
            text: 'Source: กรมควบคุมโรค กระทรวงสาธารณสุข'
        },
        xAxis: {
            categories: [
               <?php echo $Date;?>
            ]
        },
        yAxis: {
            title: {
                text: 'จำนวนเคส'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'NewConfirmed',
            data: [<?php echo $NewConfirmed;?>]
            },{
            name: 'NewRecovered',
            data: [<?php echo $NewRecovered;?>]
            },{
            name: 'NewHospitalized',
            data: [<?php echo $NewHospitalized;?>]
            },{
            name: 'NewDeaths',
            data: [<?php echo $NewDeaths;?>]
            },{
            name: 'Confirmed',
            data: [<?php echo $Confirmed;?>]
            },{
            name: 'Recovered',
            data: [<?php echo $Recovered;?>]
            },{
            name: 'Hospitalized',
            data: [<?php echo $Hospitalized;?>]
            },{
            name: 'Deaths',
            data: [<?php echo $Deaths;?>]
            }
        
        ]
    });
    </script>
</body>

</html>
