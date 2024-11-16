<?php
session_start();


if ((!isset($_SESSION['matricula']) == true) && (!isset($_SESSION['senha']) == true)) {
    header('Location: index.php');
}
$logado = $_SESSION['matricula'];

include_once('./config/database.php');

function carregarReclamacoes($conexao, $logado) {
    $query = "SELECT id_reclamacoes, matricula, tipo_reclamacoes, descricao_reclamacoes FROM reclamacoes WHERE matricula = '$logado' ORDER BY id_reclamacoes DESC";
    $result = mysqli_query($conexao, $query);

    $reclamacoes = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reclamacoes[] = $row;
        }
    }
    return $reclamacoes;
}


if (isset($_POST['delete_reclamacao'])) {
    $id_reclamacao = $_POST['id_reclamacao'];
    
    $checkQuery = "SELECT matricula FROM reclamacoes WHERE id_reclamacoes = '$id_reclamacao'";
    $checkResult = mysqli_query($conexao, $checkQuery);
    $checkRow = mysqli_fetch_assoc($checkResult);

    if ($checkRow['matricula'] == $logado) {
        $query = "DELETE FROM reclamacoes WHERE id_reclamacoes = '$id_reclamacao' AND matricula = '$logado'";
        $result = mysqli_query($conexao, $query);

        if ($result) {
            echo "<script>alert('Reclamação deletada com sucesso!');</script>";
            header("Refresh:0"); 
        } else {
            echo "<script>alert('Erro ao deletar a reclamação.');</script>";
        }
    } else {
        echo "<script>alert('Você não tem permissão para deletar essa reclamação.');</script>";
    }
}


if (isset($_POST['update_reclamacao'])) {
    $id_reclamacao = $_POST['id_reclamacao'];
    $tipo = $_POST['tipo_opina'];
    $descricao = $_POST['descricao'];

    
    $checkQuery = "SELECT matricula FROM reclamacoes WHERE id_reclamacoes = '$id_reclamacao'";
    $checkResult = mysqli_query($conexao, $checkQuery);
    $checkRow = mysqli_fetch_assoc($checkResult);

    if ($checkRow['matricula'] == $logado) {
        
        $query = "UPDATE reclamacoes SET tipo_reclamacoes = '$tipo', descricao_reclamacoes = '$descricao' WHERE id_reclamacoes = '$id_reclamacao' AND matricula = '$logado'";
        $result = mysqli_query($conexao, $query);

        if ($result) {
            echo "<script>alert('Reclamação atualizada com sucesso!');</script>";
            header("Refresh:0"); 
        } else {
            echo "<script>alert('Erro ao atualizar a reclamação.');</script>";
        }
    } else {
        echo "<script>alert('Você não tem permissão para alterar essa reclamação.');</script>";
    }
}

$reclamacoes = carregarReclamacoes($conexao, $logado);


if (isset($_POST['submit_reclamacoes'])) {
    if (isset($_SESSION['matricula'])) {
        $matricula = $_SESSION['matricula']; 
        $tipo = $_POST['tipo_opina'];
        $descricao = $_POST['descricao'];

        
        $result = mysqli_query($conexao, "INSERT INTO reclamacoes (matricula, tipo_reclamacoes, descricao_reclamacoes) VALUES ('$matricula', '$tipo', '$descricao')");

        if ($result) {
            echo "<script>alert('Reclamação enviada com sucesso!');</script>";
            header("Refresh:0"); 
        } else {
            echo "<script>alert('Erro ao enviar a reclamação.');</script>";
        }
    } else {
        echo "<script>alert('É necessário estar logado para enviar uma reclamação.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamações</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col items-center min-h-screen">

    
    <header class="w-full bg-blue-600 text-white p-4 fixed top-0 left-0 shadow-lg z-50">
        <div class="container mx-auto flex justify-center">
            <a href="#" class="text-lg font-semibold hover:text-blue-300 transition">Reclamações</a>
        </div>
    </header>

    <div class="h-20"></div>

    
    <div id="reclamacoes" class="mt-6 p-4 w-full max-w-4xl">
        <h3 class="text-lg font-semibold mb-4 text-blue-800">Últimas Reclamações</h3>
        <?php if (count($reclamacoes) > 0): ?>
            <?php foreach ($reclamacoes as $reclamacao): ?>
                <div class="bg-white rounded-lg p-6 shadow-lg mb-4">
                    <p><strong>Usuário:</strong> <?= htmlspecialchars($reclamacao['matricula']); ?></p>
                    <p><strong>Tipo:</strong> <?= htmlspecialchars($reclamacao['tipo_reclamacoes']); ?></p>
                    <p><strong>Descrição:</strong> <?= htmlspecialchars($reclamacao['descricao_reclamacoes']); ?></p>
                    
                    
                    <form method="POST" class="mt-2 inline-block" onsubmit="return confirmarDelecao();">
                        <input type="hidden" name="id_reclamacao" value="<?= $reclamacao['id_reclamacoes']; ?>">
                        <button type="submit" name="delete_reclamacao" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-500">
                                Deletar
                        </button>
                    </form>

                    <button class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-500" onclick="abrirModalAlterar(<?= $reclamacao['id_reclamacoes']; ?>, '<?= htmlspecialchars($reclamacao['tipo_reclamacoes']); ?>', '<?= htmlspecialchars($reclamacao['descricao_reclamacoes']); ?>')">Alterar</button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-700">Nenhuma reclamação encontrada.</p>
        <?php endif; ?>
    </div>

   
    <button id="feedback-button" class="fixed bottom-5 right-5 bg-blue-600 p-4 rounded-full text-white text-2xl shadow-lg hover:bg-blue-500" onclick="abrirModalCriar()">Reclame Aqui!📢</button>

    
    <div id="feedback-modal-criar" class="hidden fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-40">
        <div class="bg-white rounded-lg p-6 w-80 shadow-lg relative">
            
            <button id="close-button-criar" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600" onclick="fecharModalCriar()">×</button>
            <h2 class="text-center text-lg font-semibold mb-4 text-gray-800">Deixe sua Reclamação</h2>

            
            <form method="POST" class="flex flex-col">
                <label for="feedback-select" class="text-gray-700 mb-2">Selecione o tipo de reclamação:</label>
                <select name="tipo_opina" id="feedback-select" class="w-full mb-4 p-2 border border-gray-300 rounded" required>
                    <option value="" disabled selected>Selecione</option>
                    <option value="infraestrutura">Infraestrutura</option>
                    <option value="professor">Professor</option>
                    <option value="aluno">Aluno</option>
                    <option value="financeiro">Financeiro</option>
                    <option value="plataformas">Plataformas</option>
                </select>
                <label for="feedback-text" class="text-gray-700 mb-2">Descreva sua reclamação:</label>
                <textarea id="feedback-text" name="descricao" placeholder="Descreva sua reclamação..." class="w-full h-24 bg-blue-50 border border-blue-200 rounded-lg p-2 text-gray-700" required></textarea>
                <button type="submit" name="submit_reclamacoes" class="bg-blue-600 w-full py-2 rounded-lg mt-4 text-white hover:bg-blue-500">Enviar Reclamação</button>
            </form>
        </div>
    </div>

    
    <div id="feedback-modal-alterar" class="hidden fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-40">
        <div class="bg-white rounded-lg p-6 w-80 shadow-lg relative">
            
            <button id="close-button-alterar" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600" onclick="fecharModalAlterar()">×</button>
            <h2 class="text-center text-lg font-semibold mb-4 text-gray-800">Alterar Reclamação</h2>

            
            <form method="POST" class="flex flex-col">
                <input type="hidden" id="id_reclamacao" name="id_reclamacao">
                <label for="feedback-select" class="text-gray-700 mb-2">Selecione o tipo de reclamação:</label>
                <select name="tipo_opina" id="feedback-select" class="w-full mb-4 p-2 border border-gray-300 rounded" required>
                    <option value="" disabled selected>Selecione</option>
                    <option value="infraestrutura">Infraestrutura</option>
                    <option value="professor">Professor</option>
                    <option value="aluno">Aluno</option>
                    <option value="financeiro">Financeiro</option>
                    <option value="plataformas">Plataformas</option>
                </select>
                <label for="feedback-text" class="text-gray-700 mb-2">Descreva sua reclamação:</label>
                <textarea id="feedback-text" name="descricao" placeholder="Descreva sua reclamação..." class="w-full h-24 bg-blue-50 border border-blue-200 rounded-lg p-2 text-gray-700" required></textarea>
                <button type="submit" name="update_reclamacao" class="bg-blue-600 w-full py-2 rounded-lg mt-4 text-white hover:bg-blue-500">Atualizar Reclamação</button>
            </form>
        </div>
    </div>

    <script>
        
        function abrirModalCriar() {
            document.getElementById('feedback-modal-criar').classList.remove('hidden');
        }

        
        function fecharModalCriar() {
            document.getElementById('feedback-modal-criar').classList.add('hidden');
        }

        
        function abrirModalAlterar(id, tipo, descricao) {
            document.getElementById('id_reclamacao').value = id;
            document.getElementById('feedback-select').value = tipo;
            document.getElementById('feedback-text').value = descricao;
            document.getElementById('feedback-modal-alterar').classList.remove('hidden');
        }

        
        function fecharModalAlterar() {
            document.getElementById('feedback-modal-alterar').classList.add('hidden');
    
        }

        
     
    function confirmarDelecao() {
        return confirm("Você tem certeza que deseja deletar esta reclamação?");
    }
</script>

    </>
</body>
</html>