<?php
	require_once "includes/conexion.php"; 
	$conexion=conexion();
	$sql="select date(tblorders.Ngayorder) as Ngay,sum(tblorders.Tongtien) from tblorders where tblorders.Tinhtrangorder = 'Delivered' group by(date(tblorders.Ngayorder))order by date(tblorders.Ngayorder)";
	$result=mysqli_query($conexion,$sql);
	$valoresY=array();//montos
	$valoresX=array();//fechas

	while ($ver=mysqli_fetch_row($result)) {
		$valoresX[]=$ver[0];
		$valoresY[]=$ver[1];
	}

	$datosX=json_encode($valoresX);
	$datosY=json_encode($valoresY);

 ?>
<div id="graficaLineal"   style="width:640px;height:433px;"></div>

<script type="text/javascript">
	function crearCadenaLineal(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>


<script type="text/javascript">

	datosX=crearCadenaLineal('<?php echo $datosX ?>');
	datosY=crearCadenaLineal('<?php echo $datosY ?>');

	var trace1 = {
		x: datosX,
		y: datosY,
		type: 'scatter'
	};

	var data = [trace1];

	Plotly.newPlot('graficaLineal', data);
</script>