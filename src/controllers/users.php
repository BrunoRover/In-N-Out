<?php
require_once __DIR__ . '/../config/session.php'; 

session_start();
requireValidSession(true);
loadModel('WorkingHours');
$exception = null;
if(isset($_GET['delete'])){
    try {
        User::deleteById($_GET['delete']);
        header("Location: users.php");
        addSuccessMsg("Usuário excluido com sucesso.");
    } catch (Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')){
            addErrorMsg("Não é possivel excluir usuário com registro de ponto");
        }else{
            $exception = $e;
        }

    }
}

$users = User::get();
foreach($users as $user){
    $user->start_date = (new DateTime($user->start_date))->format('d/m/Y');
    if($user->end_date){
        $user->end_date = (new DateTime($user->end_date))->format('d/m/Y');
    }
}

loadTemplateView('users', ['users' => $users, 'exception' => $exception]);