<?php

    function PDO ($servidor, $porta, $banco, $usuario, $senha) {
        try {
            $pdo = new PDO("mysql:host=$servidor;port=$porta;dbname=$banco", $usuario, $senha);
            $pdo->query("SET NAMES 'utf8'");
            return $pdo;
        } catch (PDOException $ex) {
            return $ex;
        }
    }

    header('Content-type: application/json');
    
    // header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
    // header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    // header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

    $pdo = PDO("sql207.epizy.com", 3306, "epiz_29842690_developers", "epiz_29842690", "4EBWjGH6dn");

    // PAGINAÇÃO DOS DESENVOLVEDORES

    if (isset($_GET["q"])) {
        $res = $pdo->prepare('SELECT d.* FROM developer d WHERE d.nome LIKE "%' . $_GET["q"] . '%" OR d.hobby LIKE "%' . $_GET["q"] . '%"');
        $res->execute();
        $devs = $res->fetchAll(\PDO::FETCH_ASSOC);        

        if ($devs !== false) {
            echo json_encode(array("devs" => $devs, "response" => 200));
        } else {
            echo json_encode(array("message" => "Os desenvolvedores não foram encontrados", "response" => 404));
        }
    } 

    // LISTAGEM DE ACORDO COM O ID

    else if (isset($_GET["id"]) && !isset($_GET["editar"]) && !isset($_GET["exclusao"])) {
        $res = $pdo->prepare("SELECT d.* FROM developer d WHERE d.id = :id");
        $res->execute(array(":id" => $_GET["id"]));
        $dev = $res->fetch(\PDO::FETCH_ASSOC);        

        if ($dev !== false) {
            unset($dev["id"]);
            echo json_encode(array("dev" => $dev, "response" => 200));
        } else {
            echo json_encode(array("message" => "O desenvolvedor não foi encontrado", "response" => 404));
        }
    }

    // CADASTRO

    else if (isset($_GET["cadastro"])) {
        if (isset($_GET["nome"]) && isset($_GET["sexo"]) && isset($_GET["idade"]) && isset($_GET["hobby"]) && isset($_GET["data_nascimento"])) {
            $res = $pdo->prepare("INSERT INTO developer (nome, sexo, idade, hobby, data_nascimento) VALUES (:nome, :sexo, :idade, :hobby, :data_nascimento)");
            $res->execute(array(":nome" => $_GET["nome"], ":sexo" => $_GET["sexo"], ":idade" => $_GET["idade"], ":hobby" => $_GET["hobby"], ":data_nascimento" => $_GET["data_nascimento"]));
            echo json_encode(array("message" => "O desenvolvedor foi cadastrado com sucesso", "response" => 200));
        } else {
            echo json_encode(array("message" => "O desenvolvedor não foi cadastrado", "response" => 400));
        }
    }

    // ATUALIZAÇÃO

    else if (isset($_GET["editar"])) {
        if (isset($_GET["id"]) && isset($_GET["nome"]) && isset($_GET["sexo"]) && isset($_GET["idade"]) && isset($_GET["hobby"]) && isset($_GET["data_nascimento"])) {
            $res = $pdo->prepare("UPDATE developer d SET d.nome = :nome, d.sexo = :sexo, d.idade = :idade, d.hobby = :hobby, d.data_nascimento = :data_nascimento WHERE d.id = :id");
            $res->execute(array(":id" => $_GET["id"], ":nome" => $_GET["nome"], ":sexo" => $_GET["sexo"], ":idade" => $_GET["idade"], ":hobby" => $_GET["hobby"], ":data_nascimento" => $_GET["data_nascimento"]));
            echo json_encode(array("message" => "O desenvolvedor foi atualizado com sucesso", "response" => 200));            
        } else {
            echo json_encode(array("message" => "O desenvolvedor não foi atualizado", "response" => 400));
        }
    }

    // EXCLUSÃO

    else if (isset($_GET["exclusao"])) {
        if (isset($_GET["id"])) {
            $res = $pdo->prepare("DELETE FROM developer WHERE id = :id");
            $res->execute(array(":id" => $_GET["id"]));
            echo json_encode(array("message" => "O desenvolvedor foi excluído com sucesso", "response" => 200));
        } else {
            echo json_encode(array("message" => "O desenvolvedor não foi excluído", "response" => 201));
        }
    } 
    
    // LISTAR TODOS OS DESENVOLVEDORES

    else {
        $res = $pdo->prepare("SELECT d.* FROM developer d");
        $res->execute();
        $devs = $res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode(array("devs" => $devs, "response" => 200));
    }
?>