# Instruções do projeto

Seja bem-vindo! Este desafio foi projetado para avaliar a sua capacidade técnica como candidato à vaga de Desenvolvedor.

Instruções
- Crie o projeto e coloque esse texto como README
- Criar uma API REST
- Após finalizar, envie o código em meu e-mail: rafaelnerisdj@gmail.com
Você deverá desenvolver um projeto utilizando PHP, com a finalidade de que seja possível listar, visualizar, criar, editar e excluir animais de estimação de uma petshop.

Observações:
- Você pode utilizar a estratégia que considerar pertinente para armazenar os registros de sua aplicação;
- Cada animal de estimação precisa ter um identificador único, nome, idade, se é gato ou cachorro e sua respectiva raça; Além do nome e telefone para contato de seu dono.
- Esses dados deverāo ser recebidos via requisiçāo e inseridos no banco de dados
- Neste momento, nāo é necessário autenticaçāo.
- Deverá ser possível listar, visualizar, criar, editar e excluir animais de estimação de uma petshop.

# Parte 2
[x] Cadastro de Serviço
[ ] Cadastro de funcionário
[ ] Vínculo entre tipo de serviço e funcionário
[ ] Disponibilidade de funcionários em dias e horários para realização de serviços
[ ] Retornar a agenda dos funcionários por dia
[ ] Criar o agendamento


Feature: Agendamento de Serviços

O Petshop no futuro possuirá venda de produtos como raçāo, potes para rações, mas precisamos começar pelo agendamento de Serviços, para que possamos começar a agregar valor.

Requisitos:
- Nāo trataremos pagamentos ainda, apenas agendamentos;
- Iremos precisar de um cadastro de serviços como, por exemplo, banho/tosa, corte de unha, banho higiênico, tosa.
- Precisaremos dos funcionários cadastrados e associados ao tipo de serviço que eles realizam. Por exemplo: 
Joāo -> Pode realizar banho/tosa, banho higiênico e tosa.
Maria -> Corte de unha
Pedro -> Tudo
- Precisaremos também da disponibilidade desses funcionários, para que os agendamentos sejam realizados apenas em horários disponiveis, podemos disponibilizar um endpoint que retorne os horários disponiveis no dia selecionado consolidado por funcionários.
- Precisaremos de um endpoint que retorne a agenda dos funcionários por dia.

Regra de negócio:

- Um FUNCIONÁRIO poderá possuir apenas 1 agendamento por horário disponível
- Apenas poderāo ser realizados agendamentos com um funcionário disponivel. Caso ocorra um agendamento em um horário preenchido, devemos retornar um erro informando que o horário nāo está disponivel.
- Cada agendamento deverá possuir:
	- id do servico
	- pet (dados do pet e dono no Payload)
	- funcionario_id
	- valor
	- data/hora
	
Requisito nāo funcional:
- Instalar Docker
- Instalar PHPMD/PHPCS PSR12

# Instruções para rodar o projeto

- Clonar
- docker-compose up -d --build
- Renomear o arquivo .env.example para .env
- Acessar o container: docker-compose exec php-fpm bash
- rodar o comando chmod -R ugo+rwx storage/ (por causa das permissões)
- rodar o comando composer install (dentro do container)
- rodar o comando php artisan migrate (dentro do container)

# Executando os testes unitários

- De fora do contaienr rode o comando vendor/bin/phpunit  --testdox 