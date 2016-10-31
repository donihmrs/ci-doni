<html>
<head>
	<title>BEKUP DONI SYAHRONI</title>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/cyrfB.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/agency.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sweetalert/sweetalert.css'); ?>">

<script type="text/javascript" src="<?php echo base_url('assets/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>

<style type="text/css">

td {
	cursor: pointer;
}

.editor{
	display: none;
}

</style>



</head>
<body id="body">


<div class="container">

<div class="row">
<div class="col-md-12">

<h2>BEKUP CI DONI</h2>

<button class="btn btn-info" id="tambah-data"><i class="glyphicon glyphicon-plus-sign"></i> Add Data </button>

<br>
<br>
<br>
<div id="table" class="table-editable">
<table id="table-data" class="table table-fill">

<thead>
<tr>
<th class="text-center">Nama</th>
<th class="text-center">Tanggal</th>
<th class="text-center">Waktu</th>
<th class="text-center">Hapus</th>
</tr>
</thead>

<tbody id="table-body" class="table-hover">
<?php 

foreach ($task as $r) {
	echo "<tr data-id='$r[id]'>
			<td><span class='span-task caption' data-id='$r[id]'>$r[task]</span> <input type='text' class='field-task form-control editor' value='$r[task]' data-id='$r[id]' /></td>
			<td><span class='span-date caption' data-id='$r[id]'>$r[date]</span> <input type='date' class='field-date form-control editor' value='$r[date]' data-id='$r[id]' /></td>
			<td><span class='span-time caption' data-id='$r[id]'>$r[time]</span> <input type='time' class='field-time form-control editor' value='$r[time]' data-id='$r[id]' /></td>
			<td><button class='btn btn-xs btn-danger hapus-data' data-id='$r[id]'><i class='glyphicon glyphicon-remove'></i> Hapus</button></td>
			</tr>";
}


 ?>
</tbody>

</table>

</div>
</div>

</div>







<script type="text/javascript">

$(function(){

$.ajaxSetup({
	type:"post",
	cache:false,
	dataType: "json"
})


$(document).on("click","td",function(){
$(this).find("span[class~='caption']").hide();
$(this).find("input[class~='editor']").fadeIn().focus();
});


$("#tambah-data").click(function(){
$.ajax({
url:"<?php echo base_url('index.php/task/create'); ?>",
success: function(a){
var ele="";
ele+="<tr data-id='"+a.id+"'>";
ele+="<td><span class='span-task caption' data-id='"+a.id+"'></span> <input type='text' class='field-task form-control editor'  data-id='"+a.id+"' /></td>";
ele+="<td><span class='span-date caption' data-id='"+a.id+"'></span> <input type='date' class='field-date form-control editor' data-id='"+a.id+"' /></td>";
ele+="<td><span class='span-time caption' data-id='"+a.id+"'></span> <input type='time' class='field-time form-control editor'  data-id='"+a.id+"' /></td>";
ele+="<td><button class='btn btn-xs btn-danger hapus-data' data-id='"+a.id+"'><i class='glyphicon glyphicon-remove'></i> Hapus</button></td>";
ele+="</tr>";

var element=$(ele);
element.hide();
element.prependTo("#table-body").fadeIn(1500);

}
});
});

$(document).on("keydown",".editor",function(e){
if(e.keyCode==13){
var target=$(e.target);
var value=target.val();
var id=target.attr("data-id");
var data={id:id,value:value};
if(target.is(".field-task")){
data.modul="task";
}else if(target.is(".field-date")){
data.modul="date";
}else if(target.is(".field-time")){
data.modul="time";
}

$.ajax({
	data:data,
	url:"<?php echo base_url('index.php/task/update'); ?>",
	success: function(a){
	 target.hide();
	 target.siblings("span[class~='caption']").html(value).fadeIn();
	}

})

}

});


$(document).on("click",".hapus-data",function(){
	var id=$(this).attr("data-id");
	swal({
		title:"Hapus Data",
		text:"Yakin akan menghapus Data ini?",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: "Hapus",
		closeOnConfirm: true,
	},
		function(){
		 $.ajax({
			url:"<?php echo base_url('index.php/task/delete'); ?>",
			data:{id:id},
			success: function(){
				$("tr[data-id='"+id+"']").fadeOut("fast",function(){
					$(this).remove();
				});
			}
		 });
	});
});

});

</script>

</body>
</html>