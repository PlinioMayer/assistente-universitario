var mais = document.getElementsByClassName("mais");
var atualizar = document.getElementById("atualizar");
var tabelaMaterias = document.getElementById("tabela_materias");
var add = document.getElementById("add");

atualizar.validate = [];
add.addEventListener("click", addMateria);

for(var i = 0; i < mais.length; i++)
{
	mais[i].faltas = document.getElementsByClassName("faltas")[i + 1];
	mais[i].addEventListener("click", addFaltas);
}

atualizar.form = tabelaMaterias;
atualizar.addEventListener("click", validateForm);

function addFaltas(event)
{
	let faltas = parseInt(event.target.faltas.value) + 1;
	event.target.faltas.value = faltas;
}

function addMateria(event)
{
	let novaMateria = document.createElement("div");

	novaMateria.className = "div_materia";

	novaMateria.nome = document.createElement("input");
	novaMateria.nome.type = "text";
	novaMateria.nome.className = "materias";
	novaMateria.nome.placeholder = "Nome";
	novaMateria.nome.name = "nome[]";
	novaMateria.nome.regExp = new RegExp();
	novaMateria.nome.warning = document.createElement("span");
	novaMateria.nome.warning.appendChild(document.createTextNode("*nome invalido"));
	novaMateria.nome.warning.style.gridColumn = "1/2";
	novaMateria.nome.warning.className = "warning";
	novaMateria.appendChild(novaMateria.nome);
	atualizar.validate.push(novaMateria.nome);

	novaMateria.faltas = document.createElement("input");
	novaMateria.faltas.type = "text";
	novaMateria.faltas.className = "faltas";
	novaMateria.faltas.value = "0";
	novaMateria.faltas.name = "faltas[]";
	novaMateria.faltas.regExp = new RegExp("^[0-9]+$");
	novaMateria.faltas.warning = document.createElement("span");
	novaMateria.faltas.warning.appendChild(document.createTextNode("*"));
	novaMateria.faltas.warning.style.gridColumn = "2/3";
	novaMateria.faltas.warning.className = "warning";
	novaMateria.appendChild(novaMateria.faltas);
	atualizar.validate.push(novaMateria.faltas);

	novaMateria.faltasMax = document.createElement("input");
	novaMateria.faltasMax.type = "text";
	novaMateria.faltasMax.className = "max";
	novaMateria.faltasMax.value = "0";
	novaMateria.faltasMax.name = "faltasMax[]";
	novaMateria.faltasMax.regExp = new RegExp("^[0-9]+$");
	novaMateria.faltasMax.warning = document.createElement("span");
	novaMateria.faltasMax.warning.appendChild(document.createTextNode("*"));
	novaMateria.faltasMax.warning.style.gridColumn = "3/4";
	novaMateria.faltasMax.warning.className = "warning";
	novaMateria.appendChild(novaMateria.faltasMax);
	atualizar.validate.push(novaMateria.faltasMax);

	novaMateria.mais = document.createElement("span");
	novaMateria.mais.appendChild(document.createTextNode("+"));
	novaMateria.mais.className = "mais";
	novaMateria.mais.addEventListener("click", addFaltas);
	novaMateria.appendChild(novaMateria.mais);

	novaMateria.appendChild(novaMateria.nome.warning);
	novaMateria.appendChild(novaMateria.faltas.warning);
	novaMateria.appendChild(novaMateria.faltasMax.warning);

	tabelaMaterias.insertBefore(novaMateria, add);

}