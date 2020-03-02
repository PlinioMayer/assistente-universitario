var form = document.getElementsByClassName("form")[0];
var email = document.getElementsByName("email")[0];
var nome = document.getElementsByName("nome")[0];
var cadastrar = document.getElementById("cadastrar");
var senha1 = document.getElementsByName("senha")[0];
var senha2 = document.getElementsByName("senha2")[0];

nome.warning = document.getElementById("nome_invalido");
email.warning = [document.getElementById("email_invalido"), document.getElementById("email_cadastrado")];
senha1.warning = document.getElementById("senha_invalida");
senha2.warning = senha1.warning;

nome.regExp = new RegExp('^[A-Za-zÁÂÃáâãÉéÍíÓóÚúÇç][a-záâãéíóúç]+(\\s[A-Za-zÁÂÃáâãÉéÍíÓóÚúÇç][a-záâãéíóúç]+)+$');
email.regExp = new RegExp('^[A-Za-z0-9._%+-]+@[A-Za-z0-9-]+(\\.[A-Za-z]{2,})+$');

cadastrar.validate = [nome, email, senha1];
cadastrar.form = form;

senha2.addEventListener("input", function(){senha1.regExp = senha2.value;});

cadastrar.addEventListener("click", validateForm);
nome.addEventListener("click", removeWarning);
email.addEventListener("click", removeWarning);
senha1.addEventListener("click", removeWarning);
senha2.addEventListener("click", removeWarning);