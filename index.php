<?php
session_start();
?>
<!DOCTYPE html>
	<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>TODO LIST</title>
		<meta name="author" content="LUIS">
        <meta name="description" content="LUIS">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css" integrity="sha256-Nfu23DiRqsrx/6B6vsI0T9vEVKq1M6KgO8+TV363g3s=" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.js" integrity="sha256-pl1bSrtlqtN/MCyW8XUTYuJCKohp9/iJESVW1344SBM=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
	</head>
	<body>
		<div class="container-fluid">
			<div class="card bg-dark">
					<div class="card-body">
					<h5 class="card-title text-white text-center">Simples Lista a fazer</h5>
						<form method="post" action="action.php">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default">Tarefa</span>
								</div>
								<input type="text" class="form-control"  autocomplete=off name='tarefa'>
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<label class="input-group-text">Prioridade</label>
								</div>
								<select class="custom-select" name="prioridade">
									<option value=""  disabled selected>Selecione</option>
									<option value="0">Baixa</option>
									<option value="1">Normal</option>
									<option value="2">Alta</option>
								</select>
							</div>
							<input type="hidden" name="do" value="new">
							<button class='btn btn-sm btn-primary col-3 bg-dark' type='submit'>Enviar</button>
							<a href='action.php?do=delete&id=all' class="btn btn-sm btn-danger col-3 bg-dark">Limpar toda a lista</a>
						</form><br>
					</div>
				</div>
			<hr class='bg-dark'>
			<div class="card bg-dark">
				<div class="card-body">
					<h5 class="card-title text-white text-center">Tarefas</h5>
					<div class="row">			
						<?php 
							
							$pdo = new PDO('sqlite:todo.db');
							$list = "select * from todo ";
							foreach ($pdo->query($list) as $row){ 
								$id = $row['id'];
								$dt = $row['criada_em'];	 
								$date = str_replace('/', '-', $dt );
								$newDate = date("d/m/Y", strtotime($date));
								switch($row['prioridade']){
									case 0: $class = 'bg-info'; break;
									case 1: $class = 'bg-warning'; break;
									case 2: $class = 'bg-danger'; break;
								}	
						?>
						<div class="card col-2 <?=$class;?>">
							<div class="card-body ">
								<h6 class="card-title"><?=$newDate;?></h6>
								<p class="card-text"><?=$row['tarefa'];?></p>
							</div>
							<a href="action.php?do=delete&id=<?=$id;?>" ><i class="fa fa-trash text-dark" aria-hidden="true"></i></a>
						</div>
						<?php } ?>
					</div>
					</div>
				</div>
		</div>
		<?php if ($_SESSION['msg'] != null){ ?>
			<script>
				alert('<?=@$_SESSION['msg'];?>');
			</script>
			<?=$_SESSION['msg']=null;?>
		<?php } ?>
	</body>
</html>
