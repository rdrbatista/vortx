### Procedimentos para executar a aplicação
Para executar a aplicação, basta extrair a pasta do projeto e rodar o seguinte comando no terminal, na pasta do projeto: php artisan serve
Após isso, basta acessar localhost:8000 no navegador
* É necessário ter o PHP instalado na máquina

### Uso da aplicação
A aplicação consiste em uma única página onde o usuário poderá informar um DDD de origem, um DDD de destino, a quantidade de minutos
e selecionar o plano (produto).
Ao clicar no botão "Calcular", o sistema retornará o custo dessa ligação com o produto e sem o produto, além da economia.

### TESTES
Para executar o teste, o usuário deverá, através do terminal, rodar o comando vendor\bin\phpunit na pasta da raíz do projeto.
