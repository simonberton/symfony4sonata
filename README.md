This is a Symfony 4.2 project with the Sonata Admin bundle, user bundle.

It has the security using ROLES, so you can create users, let them modify the entities you prefeer and so on.

As always, steps:

1 - Clone project:
```
git clone git@github.com:simonberton/symfony4sonata.git
```
2 - Navegar hacia carpeta y Composer install.
```
composer install
```

3 - Create and Update your database schema.
```
php bin/console doctrine:database:create

php bin/console d:s:u --f
```
4 - Enjoy.

Hint: If you want you can use this docker locally:
https://github.com/simonberton/dockerphp7.2apachemysql