const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
document.getElementById('reclamacao-form').addEventListener('submit', function(event) {
  event.preventDefault();

  const titulo = document.getElementById('titulo').value;
  const descricao = document.getElementById('descricao').value;

  if (titulo && descricao) {
     
      adicionarReclamacao(titulo, descricao);
      limparFormulario();
  }
});

function adicionarReclamacao(titulo, descricao) {
  const listaAbertas = document.getElementById('lista-abertas');

  const novaReclamacao = document.createElement('li');
  novaReclamacao.innerHTML = `
      <h3>${titulo}</h3>
      <p>${descricao}</p>
      <button class="resolver-btn">Resolver</button>
  `;

  novaReclamacao.querySelector('.resolver-btn').addEventListener('click', function() {
      resolverReclamacao(novaReclamacao);
  });

  listaAbertas.appendChild(novaReclamacao);
}

function resolverReclamacao(reclamacao) {
  const listaResolvidas = document.getElementById('lista-resolvidas');
  reclamacao.querySelector('.resolver-btn').remove();
  listaResolvidas.appendChild(reclamacao);
}

function limparFormulario() {
  document.getElementById('titulo').value = '';
  document.getElementById('descricao').value = '';
}
document.getElementById('login-form').addEventListener('submit', function(event) {
  event.preventDefault(); 
 
  window.location.href = 'reclamacoes.html'; 
});
document.addEventListener("DOMContentLoaded", function () {
  const signInBtn = document.getElementById("sign-in-btn");
  if (signInBtn) {
      signInBtn.addEventListener("click", function () {
          window.location.href = "reclamacoes.html";
      });
  }

  const signUpBtn = document.getElementById("sign-up-btn");
  if (signUpBtn) {
      signUpBtn.addEventListener("click", function () {
         
      });
  }
});
