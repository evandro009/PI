<?php

// Pegando os dados vindos do formulário
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$data = date('Y-m-d'); // Ajustado para formato adequado ao MySQL

// Configurações de credenciais
$server = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'formulario1';

// Conexão com o banco de dados
$conn = new mysqli($server, $usuario, $senha, $banco);

// Verificando se há erro na conexão
if ($conn->connect_error) {
    die("Falha ao se comunicar com o banco de dados: " . $conn->connect_error);
}

// Preparando a query
$smtp = $conn->prepare("INSERT INTO clientes(nome, cpf, email, data) VALUES (?, ?, ?, ?)");
if ($smtp === false) {
    die("Erro ao preparar a query: " . $conn->error);
}

// Fazendo o bind dos parâmetros
$smtp->bind_param("ssss", $nome, $cpf, $email, $data);

// Executando a query
if ($smtp->execute()) {
    echo "Mensagem enviada com sucesso!";
} else {
    echo "Erro no cadastro de usuário: " . $smtp->error;
}

// Fechando a conexão
$smtp->close();
$conn->close();

?>
