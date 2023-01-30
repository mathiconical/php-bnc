<h1 align='center'>PHP BNC</h1>

<p align='center'>Abstração da API da BNC em PHP</p>

<p align='center'>
    <a href='#Objetivo'>Objetivo</a>
    <a href='#Instalação'>Instalação</a>
    <a href='#Configuração'>Configuração</a>
    <a href='#Exemplos'>Exemplos</a>
</p>

<h4 align='center'>
    Em Construção...
</h4>

### Objetivo

Tornar mais flexível a integração da API da BNC em diferentes projetos.

### Instalação

Instale usando o comando:

> composer require mathiconical/php-bnc

### Configuração

Para incluir no projeto e usar, basta fazer o seguinte:

```php
<?php

require('vendor/autoload.php');

use Mathiconical\Client;

// alterne entre TEST e PROD.
$client = new Mathiconical\Client('TOKEN_API', 'TEST_or_PROD');
```

Headers customizados, se necessário headers customizados, basta informá-los na instanciação do objeto Client:

```php
<?php

require('vendor/autoload.php');

// alterne entre TEST e PROD.
$client = new Mathiconical\Client(
    'TOKEN_API',
    'TEST_or_PROD',
    [
        'foo' => 'bar',
        'x-key' => 'x-value',
    ],
    'TEST_or_PROD'
);
```

Com isto feito, agora já é possível realizar requisições ao BNC, veja os exemplos a seguir.

### Exemplos

<h5>Obter Processo GUID</h5>

```php
$client = new \Mathiconical\Client('apikey');

// Os Endpoints contidos na pasta Endpoints possuem alguns metodos que por padrão recebem 2 parametros.
// O primeiro é um array associativo que vai ser convertido em parametros para a uri.
// Exemplo: ['id' => 2], irá resultar na string '?id=2'.
// O segundo é um array que será convertido em json e passado para o body da requisição.
$guid = $client->getProcessGuid()->get(['param' => 1312]);
```

<h5>Obter Status do Processo</h5>

```php
$client = new \Mathiconical\Client('apikey');

$status = $client->getStatusProcess()->get(['processId' => $guid]);
```

<h5>Obter o Resultado do Processo</h5>

```php
$client = new \Mathiconical\Client('apikey');

$status = $client->getProcessResult()->get(['processId' => $guid]);
```

<h5>Salvar o Processo</h5>

```php
$client = new \Mathiconical\Client('apikey');

// Mapear os parametros do processo com o objeto BncProcesso, BncItem e BncLote
$bncProcesso = new \Mathiconical\BncProcesso();
// ...
// Converter os dados salvos para objeto
$obj = $bncProcesso->convertToObject();
// Caso o processo já exista no sistema da BNC, deve ser passado o GUID
$obj->idIntegProcess = $guid;

// O retorno será do guid interno do processo.
$processo_guid = $client->getProcessResult()->get([], (array)$obj);
```
