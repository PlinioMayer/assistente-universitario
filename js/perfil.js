var form = document.getElementsByClassName("form")[0];
var email = document.getElementsByName("email")[0];
var nome = document.getElementsByName("nome")[0];
var carregar = document.getElementsByTagName("button")[0];
var senha1 = document.getElementsByName("senha")[0];
var senha2 = document.getElementsByName("senha2")[0];

nome.warning = document.getElementsByClassName("warning")[0];
email.warning = document.getElementsByClassName("warning")[1];
senha1.warning = document.getElementsByClassName("warning")[2];
senha2.warning = senha1.warning;

senha1.regExp = senha2.value;

nome.regExp = new RegExp('^[A-Za-zÁÂÃáâãÉéÍíÓóÚúÇç][a-záâãéíóúç]+(\\s[A-Za-zÁÂÃáâãÉéÍíÓóÚúÇç][a-záâãéíóúç]+)+$');
email.regExp = new RegExp('^[A-Za-z0-9._%+-]+@[A-Za-z0-9-]+(\\.[A-Za-z]{2,})+$');

carregar.validate = [nome, email, senha1];
carregar.form = form;

senha2.addEventListener("input", function(){senha1.regExp = senha2.value;});

carregar.addEventListener("click", validateForm);
nome.addEventListener("click", removeWarning);
email.addEventListener("click", removeWarning);
senha1.addEventListener("click", removeWarning);
senha2.addEventListener("click", removeWarning);