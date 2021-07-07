<?php
	/* Database connection settings */
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'accident';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	$victime = array();
    $lieu = array();
    $date = array();
    $cause = array();

	//query to get data from the table
	$sql = "SELECT SUM(`victime`), date
	FROM `form`
	GROUP BY `date` ";
    $result = mysqli_query($mysqli, $sql);
	while ($row = mysqli_fetch_array($result)) {
		$victime[] = $row['SUM(`victime`)'];
    	$date[] =  $row['date'];
	}


	$sql = "SELECT SUM(`victime`), lieu
	FROM `form`
	GROUP BY `lieu` ";
    $result = mysqli_query($mysqli, $sql);
	while ($row = mysqli_fetch_array($result)) {
		$victime[] = $row['SUM(`victime`)'];
		$lieu[] = $row['lieu'];

	}

	$sql = "SELECT SUM(`victime`), cause
	FROM `form`
	GROUP BY `cause` ";
    $result = mysqli_query($mysqli, $sql);
	while ($row = mysqli_fetch_array($result)) {
		$victime[] = $row['SUM(`victime`)'];
    	$cause[] =  $row['cause'];

	}
		

?>

<!DOCTYPE html>
<html>
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		<title>Statistiques</title>

		<style type="text/css">			
			body{
				font-family: Arial;
			    margin: 80px 100px 10px 100px;
			    padding: 0;
			    color: white;
			    text-align: center;
			    background: #555652;
			}

			.container {
				color: #E8E9EB;
				background: #222;
				border: #555652 1px solid;
				padding: 10px;
			}
		</style>

	</head>

	<body>
		   
	    <div class="container">	
	    <h1>Statistiques des victimes en fonction de la date</h1>      
			<canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

			<script>
				var ctx = document.getElementById("chart").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'bar',
		        data: {
		            labels:<?php echo json_encode($date); ?>,
		            datasets: 
		            [{
		                label: 'victime',
		                data: <?php echo json_encode($victime); ?>,
		                backgroundColor: 'rgba(255, 99, 132, 0.2)',
		                borderColor:'rgba(255,99,132)',
		                borderWidth: 3,
					}]
		       	 },
				
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
		        }
				
		    });
			</script>

	    </div>
		

<!-- deuxieme graphe lieu -->
 
		<div class="container">	
	    <h1>Statistiques des victimes en fonction du lieu de l'accident</h1>       
			<canvas id="chat" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

			<script>
				var ctx = document.getElementById("chat").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'bar',
		        data: {
		            labels:<?php  echo json_encode($lieu); ?>,
		            datasets: 
		            [{
		                label: 'victime',
		                data: <?php echo json_encode($victime); ?>,
		                backgroundColor: 'rgba(255, 205, 86, 0.2)',
		                borderColor:'rgba(0,255,255)',
		                borderWidth: 3,
					}]
		       	 },
				
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
		        }
				
		    });
			</script>

	    </div>
		

<!-- troisieme graphe cause -->

		<div class="container">	
	    <h1>Statistiques des victimes en fonction de la cause de l'accident</h1>       
			<canvas id="char" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

			<script>
				var ctx = document.getElementById("char").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'bar',
		        data: {
		            labels:<?php echo json_encode($cause); ?>,
		            datasets: 
		            [{
		                label: 'victime',
		                data: <?php echo json_encode ($victime); ?>,
		                backgroundColor: 'rgba(255, 99, 132, 0.2)',
		                borderColor:'rgba(255,99,132)',
		                borderWidth: 3,
					}]
		       	 },
				
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
		        }
				
		    });
			</script>

	    </div>
		<div>
		<h1><a href="../index.html">Retour</a></h1>

		</div>
		
	</body>
</html>
