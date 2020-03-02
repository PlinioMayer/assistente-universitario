# Introdução
O presente trabalho foi uma experiência minha advinda da
necessidade de contar as faltas que eu tinha na universidade.
Foi, também, uma maneira de exercitar habilidades que eu considerava
pertinentes na época, a saber: PHP, HTML, CSS, Javascript e SQL.

Para utilizar o programa se fazem necessários:

1. Um servidor HTTP (recomenda-se apache)
2. Um servidor SQL (recomenda-se MariaDB)
3. PHP (recomenda-se acima da versão 7.0.0)

**ATENÇÃO:** meu desconhecimento na época me levou a criar o sistema de cadastro sem encriptar as senhas, use com cuidado.

# Configurando o banco de dados
A única configuração que você realmente terá que fazer será em relação ao banco de dados.
Primeiro crie um usuário e senha (ou use um existente) e crie uma table chamada 'login' com os seguintes atributos:

- ID INT PRIMARY KEY
- NOME VARCHAR(255)
- EMAIL VARCHAR(255)
- SENHA VARCHAR(255)

depois adicione usuário, senha e base de dados em 'php/conect.php' na linha 11.
Exemplo:

```
// Usuário: user
// senha: senha
// database: database

$this->conn = new PDO("mysql:host=localhost;dbname=databse", "user", "senha");

```