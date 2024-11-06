<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Modal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col items-center min-h-screen">

    <header class="w-full bg-blue-600 text-white p-4 fixed top-0 left-0 shadow-lg z-50">
        <div class="container mx-auto flex justify-center space-x-6">
            <a href="#"  class="text-lg font-semibold hover:text-blue-300 transition" onclick="mostrarSecao('reclamacoes')">Reclamações</a>
            <a href="#" class="text-lg font-semibold hover:text-blue-300 transition" onclick="mostrarSecao('ideias')">Ideias</a>
            <a href="#" class="text-lg font-semibold hover:text-blue-300 transition" onclick="mostrarSecao('elogios')">Elogios</a>
            <a href="#" class="text-lg font-semibold hover:text-blue-300 transition" onclick="mostrarSecao('outros')">Outros</a>
        </div>
    </header>

    <div class="h-20"></div>

    <div id="reclamacoes" class="hidden mt-6 p-4">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <h3 class="text-lg font-semibold mb-2 text-blue-800">Última Reclamação</h3>
            <p class="text-gray-700">Descrição da última reclamação aqui.</p>
        </div>
    </div>

    <div id="ideias" class="hidden mt-6 p-4">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <h3 class="text-lg font-semibold mb-2 text-blue-800">Última Ideia</h3>
            <p class="text-gray-700">Descrição da última ideia aqui.</p>
        </div>
    </div>

    <div id="elogios" class="hidden mt-6 p-4">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <h3 class="text-lg font-semibold mb-2 text-blue-800">Último Elogio</h3>
            <p class="text-gray-700">Descrição do último elogio aqui.</p>
        </div>
    </div>

    <div id="outros" class="hidden mt-6 p-4">
        <div class="bg-white rounded-lg p-6 shadow-lg">
            <h3 class="text-lg font-semibold mb-2 text-blue-800">Último Outro</h3>
            <p class="text-gray-700">Descrição da última observação aqui.</p>
        </div>
    </div>

    <button id="feedback-button" class="fixed bottom-5 right-5 bg-blue-600 p-4 rounded-full text-white text-2xl shadow-lg hover:bg-blue-500" onclick="abrirModal()">+</button>

    <div id="feedback-modal" class="hidden fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-40">
        <div class="bg-white rounded-lg p-6 w-80 shadow-lg relative">
            <button id="close-button" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600" onclick="fecharModal()">×</button>
            <h2 class="text-center text-lg font-semibold mb-4 text-gray-800">Deixe seu Feedback</h2>

            <div class="flex flex-col space-y-4 mb-4">
                <button name="reclamacoes" id="btn-reclamacao" onclick="mostrarFormulario('reclamacao')" class="bg-blue-100 text-blue-700 p-2 rounded">Reclamação</button>
                <button name="ideias" id="btn-ideia" onclick="mostrarFormulario('ideia')" class="bg-blue-100 text-blue-700 p-2 rounded">Ideia</button>
                <button name="elogios" id="btn-elogio" onclick="mostrarFormulario('elogio')" class="bg-blue-100 text-blue-700 p-2 rounded">Elogio</button>
                <button name="outros" id="btn-outro" onclick="mostrarFormulario('outro')" class="bg-blue-100 text-blue-700 p-2 rounded">Outro</button>
            </div>

            <div id="feedback-content" class="hidden flex flex-col items-center">
                <select name="tipo" id="feedback-select" class="w-full mb-4 p-2 border border-gray-300 rounded">
                    <option value="">Selecione um tipo</option>
                    <option value="infraestrutura">Infraestrutura</option>
                    <option value="professor">Professor</option>
                    <option value="aluno">Aluno</option>
                    <option value="financeiro">Financeiro</option>
                    <option value="plataformas">Plataformas</option>
                </select>
                <textarea id="feedback-text" placeholder="Descreva seu feedback..." class="w-full h-24 bg-blue-50 border border-blue-200 rounded-lg p-2 text-gray-700"></textarea>
                <button type="submit" name="enviar" onclick="enviarFeedback()" class="bg-blue-600 w-full py-2 rounded-lg mt-4 text-white hover:bg-blue-500">Enviar feedback</button>
            </div>
        </div>
    </div>

    <script>
        let selectedButton = null;

        function mostrarSecao(secao) {
            document.querySelectorAll('div[id]').forEach(el => el.classList.add('hidden'));
            document.getElementById(secao).classList.remove('hidden');
        }

        function abrirModal() {
            document.getElementById('feedback-modal').classList.remove('hidden');
        }

        function fecharModal() {
            document.getElementById('feedback-modal').classList.add('hidden');
            document.getElementById('feedback-content').classList.add('hidden');
            if (selectedButton) {
                selectedButton.classList.remove('bg-blue-200');
                selectedButton.classList.add('bg-blue-100');
                selectedButton = null;
            }
        }

        function mostrarFormulario(tipo) {
            if (selectedButton) {
                selectedButton.classList.remove('bg-blue-200');
                selectedButton.classList.add('bg-blue-100');
            }
            selectedButton = document.getElementById(`btn-${tipo}`);
            selectedButton.classList.remove('bg-blue-100');
            selectedButton.classList.add('bg-blue-200');
            document.getElementById('feedback-content').classList.remove('hidden');
        }

        function enviarFeedback() {
            const select = document.getElementById('feedback-select');
            const text = document.getElementById('feedback-text').value;

            if (select.value === "" || text.trim() === "") {
                alert('Por favor, preencha todos os campos.');
                return;
            }

            console.log(`Feedback enviado! Tipo: ${select.value}, Descrição: ${text}`);
            fecharModal();
            alert('Feedback enviado!');
        }
    </script>
</body>
</html>