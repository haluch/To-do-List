<?php
    session_start(); 
    $pdo = new PDO('sqlite:todo.db');

    switch ($_REQUEST['do']){

        case 'new'; 
            $tarefa = $_REQUEST['tarefa'];
            $prioridade = $_REQUEST['prioridade'] ? $_REQUEST['prioridade'] : '0';
            $date = date('Y-m-d');
            $query = "insert into todo (id, tarefa, criada_em, prioridade) values (null, '$tarefa', '$date', $prioridade)";
            $msg = "Salvo o registro.";
        break;

        case 'delete'; 
            $id = $_REQUEST['id'];
            if ($id === 'all'){
                $query = "delete from todo;";
                $q     = "delete from sqlite_sequence where name='todo';"; // zerar autoincrement
                $pdo->query($q);
                $msg = "Todas as tarefas apagadas.";
            }else{
                $query = 'delete from todo where id = '.$id;
                $msg = "Registro apagado.";
            }
        break;

    }

    $pdo->query($query);
    $_SESSION['msg'] = $msg ;
    header('location:index.php');
    

