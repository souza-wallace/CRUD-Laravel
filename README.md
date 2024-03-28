
### Passo a passo
Clone Repositório
```sh
git clone 
git@github.com:souza-wallace/truckpag.git
https://github.com/souza-wallace/truckpag.git
```
```sh
cd truckpag
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Instale as dependências do projeto
```sh
composer install
```

Rode as migrações.
```sh
php artisan migrate
```
Rode as o seed, ele ira popular o banco de dados com clientes.
```sh
php artisan db:seed
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)