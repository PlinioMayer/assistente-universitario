var criar = document.getElementById("criar");
var mensagem = document.getElementById("mensagem");
var criarTabela = document.getElementById("criar_tabela");
var inputs = document.getElementById("inputs");
var add = document.getElementById("add");
var rem = document.getElementById("rem");
var cancelar = document.getElementById("cancelar");
var salvar = document.getElementById("salvar");
var nenhum = document.getElementById("nenhum");
var materiasInputs = [];
var faltasInputs = [];

criar.addEventListener("click", function(){criarTabela.style.display = "grid"; mensagem.style.display = "none";});
add.addEventListener("click", addMateria);
rem.addEventListener("click", remMateria);
cancelar.addEventListener("click", cancelarTabela);

salvar.form = criarTabela;
salvar.addEventListener("click", validateForm);

function addMateria()
{
	if(getComputedStyle(nenhum, null).display === "block")
	{
		nenhum.style.display = "none";
	}

	materiasInputs[materiasInputs.length] = document.createElement("input");
	materiasInputs[materiasInputs.length - 1].name = "materias[]";
	materiasInputs[materiasInputs.length - 1].type = "text";
	materiasInputs[materiasInputs.length - 1].className = "form_item";
	

	inputs.appendChild(materiasInputs[materiasInputs.length - 1], add);

	faltasInputs[faltasInputs.length] = document.createElement("input");
	faltasInputs[faltasInputs.length - 1].name = "faltas_max[]";
	faltasInputs[faltasInputs.length - 1].type = "number";
	faltasInputs[faltasInputs.length - 1].className = "form_item";

	inputs.appendChild(faltasInputs[faltasInputs.length - 1], add);

	materiasInputs[materiasInputs.length - 1].regExp = new RegExp();
	materiasInputs[materiasInputs.length - 1].warning = document.createElement("span");
	materiasInputs[materiasInputs.length - 1].warning.appendChild(document.createTextNode("*nome inválido"));
	materiasInputs[materiasInputs.length - 1].warning.className = "warning";

	inputs.appendChild(materiasInputs[materiasInputs.length - 1].warning, add);

	faltasInputs[faltasInputs.length - 1].regExp = new RegExp("^[0-9]+$");
	faltasInputs[faltasInputs.length - 1].warning = document.createElement("span");
	faltasInputs[faltasInputs.length - 1].warning.appendChild(document.createTextNode("*"));
	faltasInputs[faltasInputs.length - 1].warning.className = "warning";

	inputs.appendChild(faltasInputs[faltasInputs.length - 1].warning, add);

	materiasInputs[materiasInputs.length - 1].addEventListener("click", removeWarning);
	faltasInputs[faltasInputs.length - 1].addEventListener("click", removeWarning);

	salvar.validate = materiasInputs.concat(faltasInputs);
}

function remMateria()
{
	inputs.removeChild(faltasInputs[faltasInputs.length - 1].warning);
	inputs.removeChild(faltasInputs[faltasInputs.length - 1]);
	faltasInputs.pop();

	inputs.removeChild(materiasInputs[materiasInputs.length - 1].warning);
	inputs.removeChild(materiasInputs[materiasInputs.length - 1]);
	materiasInputs.pop();

	if(materiasInputs.length === 0)
	{
		nenhum.style.display = "block";
	}
}

function cancelarTabela()
{
	while(materiasInputs.length !== 0)
	{
		remMateria();
	}

	criarTabela.style.display = "none";
	mensagem.style.display = "grid";
}