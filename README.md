# pontential-crud

link da API (GET): http://devs.epizy.com/developers/

## Listar todos os desenvolvedores

```
http://devs.epizy.com/developers/
```

### Resultado

```json
{
    "devs": [
        {
            "id": "1",
            "nome": "Mariana",
            "sexo": "M",
            "idade": "23",
            "hobby": "Música e Dança",
            "data_nascimento": "1998-04-07"
        },
        {
            "id": "2",
            "nome": "Renato",
            "sexo": "M",
            "idade": "20",
            "hobby": "Ler e desenhar",
            "data_nascimento": "2000-10-11"
        },
        {
            "id": "3",
            "nome": "Joelson",
            "sexo": "M",
            "idade": "18",
            "hobby": "Escrever histórias em quadrinhos",
            "data_nascimento": "2003-05-20"
        },
        {
            "id": "4",
            "nome": "Maicon",
            "sexo": "M",
            "idade": "18",
            "hobby": "Escrever textos",
            "data_nascimento": "2003-05-06"
        }
    ],
    "response": 200
}
```

## Listar um desenvolvedor específico

```
http://devs.epizy.com/developers/?id={{ID}}
```

### Parâmetros

- `{{ID}}`: código (id) do desenvolvedor

### Resultado

```json
{
    "dev": {
        "nome": "Joelson",
        "sexo": "M",
        "idade": "18",
        "hobby": "Escrever histórias em quadrinhos",
        "data_nascimento": "2003-05-20"
    },
    "response": 200
}
```

## Buscar um desenvolvedor pelo nome ou hobbie

## Cadastrar um novo desenvolvedor

```
http://devs.epizy.com/developers/?cadastro=true&nome={{NOME}}&sexo={{SEXO}}&idade={{IDADE}}&hobby={{HOBBY}}&data_nascimento={{DATA_NASCIMENTO}}
```

### Parâmetros

- `cadastro`: true (padrão)
- `{{NOME}}`: nome
- `{{SEXO}}`: gênero (M para masculino e F para feminino)
- `{{IDADE}}`: idade (Ex.: 15)
- `{{HOBBY}}`: hobbie
- `{{DATA_NASCIMENTO}}`: data de nascimento (AAAA-MM-DD Ex.: 2002-04-15)


## Atualizar dados de um desenvolvedor

## Apagar um desenvolvedor
