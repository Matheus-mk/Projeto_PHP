<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho Dênnis</title>
</head>

<body>
    <h2>Estoque de Produtos</h2>
    <br>
    <p><strong>Para cadastrar o produto, preencha os campos abaixo:</strong></p>
    <label for="nome">Nome do produto </label>
    <input type="text" name="nome" required><br>
    <br>
    <label for="valor">Preço do produto</label>
<input type="text" id="valor" placeholder="R$ 0,00" min="R$ 0,00">

<script>
  const input = document.getElementById('valor');

  input.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é número
    value = (Number(value) / 100).toLocaleString('pt-BR', {
      style: 'currency',
      currency: 'BRL'
    });
    e.target.value = value;
  });
</script>
    <br>
    <button type="submit">Adicionar</button>
    </form>

    <?php
    //Verifica se o formulario foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Recebe os valores enviados pelo formulario
        $nome = $_POST['nome'];
        $preço = $_POST['valor'];

        //Conecta no Banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "Senai@118";
        $dbname = "exercicio";

        $conn = new mysqli($servername, $username, $password, $dbname);

        //Verifica a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Insere o registro no BD
        $sql = "INSERT INTO produtos (nome_dos_produtos, preço) VALUES ('$nome', '$preço')";

        if ($conn->query($sql) === TRUE) {
            echo "<p id='msg' style='color: Darkgreen;'>Cliente cadastrado com sucesso !";
        } else {
            echo "<p id='msg' style='color: red;'>Erro ao cadastrar</p>";
        }
        // Ocultar a mensagem apos 5 segundos com a funcão setTimeout do Javascript
        echo "
<script>
setTimeout(function() {
document.getElementById('msg').style.display = 'none';
}, 5000)
</script>
";

        // Fecha a conexão
        $conn->close();
    }
    ?>
</body>

</html>