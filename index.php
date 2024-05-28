<?php
require('db/conexao.php');


//selecionar dados da tabela
$sql = $pdo->prepare("SELECT * FROM clientes");
$sql -> execute();
$dados = $sql->fetchAll();

//exemplo com filtragem
/*$sql = $pdo->prepare("SELECT * FROM clientes WHERE email = ?");
$email = 'teste@teste.com'
$sql -> execute(array($email));
$dados = $sql->fetchAll();*/


//echo "<pre>";
//print_r($dados);



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserindo Dados</title>
    <style>
table{
    border-collapse: collapse;
    width: 100%;

}
th,td{
    padding: 10px;
    border: 1px solid blue;
    text-align: center;
}
        </style>
</head>
<body>
<h1>Aula inserindo Dados</h1>
<form method="post">
<input type="text" name="nome" placeholder="Digite seu nome" required>
<input type="text" name="email" placeholder="Digite seu email" required>
<button type="submit" name="salvar">Salvar</button>
</form>

<?php

//inserir um dado no banco(modo simples)




//modo correto anti sql injection

if(isset($_POST['salvar'])&& isset($_POST['nome'])&& isset($_POST['email']))
{
    $nome = limparPost($_POST['nome']); 
    $email = limparPost($_POST['email']);
    $data = date('d-m-Y');


    //validação de campo  vazio

    if($nome=="" || $nome==null)
    {
        echo "Nome não pode ser vazio";
        exit();
    }
    if($email=="" || $email==null)
    {
        echo "Email não pode ser vazio";
        exit();
    }
    //validações de nome e email
    
    if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) 
    {
      echo "<br><b style='color: red'> Somente letras e espaços em branco</b>";
      
      exit();
    }
    //verificar se é um email valido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        echo "Invalid email format";
        exit();
    
    }




    
    $sql = $pdo -> prepare("INSERT INTO clientes VALUES (null,?,?,?)");
    $sql->execute(array($nome,$email,$data));   
    
 

    if(isset($sql))
    {
        header('location:http://localhost/crud/thank.php');
        echo "cliente inserido com sucesso";
        exit();
    }
}



?>
<?php
if(count($dados) > 0)
{
    echo "<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
    </tr>";

foreach($dados as $chave => $valor)
{
   echo 
   "<tr>
    <td>".$valor['id']."</td>
    <td>".$valor['nome']."</td>
    <td>".$valor['email']."</td>

  </tr>";
}
    echo "</table>";
}else
{
    echo "nenhum cliente cadastrado";
}

?>







    
</body>
</html>