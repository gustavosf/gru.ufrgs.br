Guias de Recolhimento da União (GRU) são artefatos utilizados pela [Universidade Federal do Rio Grande do Sul](http://www.ufrgs.br) para a geração de boletos de pagamento à instituição. É a única maneira oficial de efetuar pagamentos diretos à Universidade.  

Este repositório visa manter uma interface simples para configuração e extração do HTML do boleto através do formulário oficial, para armazenamento e posterior reexibição sem a necessidade da geração um novo documento.

## Uso

Um exemplo simples de uso da classe para geração de uma guia de recolhimento:

```php
<?php # ...

$gru = GRU::forge(array(
	'name' => 'Gustavo Seganfredo',
	'cpf'  => '012345678910',
	'expiration' => date('d/m/Y', strtotime('+15 days')),
	'value' => '1,99',
	'description' => 'Hello GRU',
	'ugr_code' => '153334',
	'description_code' => '28840-31',
))->submit();

// $gru agora contém o HTML da GRU gerada pela UFRGS

?>
```

## Campos

A tabela abaixo descreve os campos de devem/podem ser passados como valor para o método forge (ou para o construtor da classe), como parâmetro.

```
Campo            | Caráter     | Padrão                    | Descrição
---------------- | ----------- | ------------------------- | -------------------------------------------------
type             | Opcional    | Orgao                     | Tipo da guia
name             | Obrigatório | -                         | Nome do contribuinte
cpf              | Obrigatório | -                         | CPF do contribuinte
hcpf             | Opcional    | null                      | Campo de controle, manter nulo
cgc              | Opcional    | null                      | CGC (CNPJ) do contribuinte
contract         | Opcional    | null                      | Número do contrato
parcel           | Opcional    | null                      | Número da parcela
expiration       | Obrigatório | -                         | Data de vencimento
value            | Obrigatório | -                         | Valor da guia
fine             | Opcional    | null                      | Valor da multa
description_code | Obrigatório | -                         | Código do tipo de operação (ver tabela abaixo)
ugr_code         | Obrigatório | -                         | Código da Unidade Gestora (ver tabela abaixo)
obs              | Opcional    | null                      | Observação para ser adicionada ao doc
botao            | Opcional    | 'Emitir DOC de Pagamento' | Valor do botão submit
```

### Códigos de operação (description_code)

```
Código   | Operação
-------- | ------------------------------------------------------------------------
28803-91 | Aluguéis com contrato
28802-01 | Aluguéis sem contrato
28818-71 | Comércio de Livros, periódicos, material Escolar e publicações
28820-91 | Comércio de Produtos, Dados e Material de Informática
98815-41 | Depósito de Terceiros
98815-46 | Devolução de Bolsas
98815-42 | Devolução de Diárias
98815-43 | Devolução de Salários
98815-44 | Devolução de Suprimento de Fundos
28805-51 | Outras Receitas Imobiliárias
28852-71 | Outras Restituições
28840-31 | Outros Serviços
28815-21 | Receita da Indústria Editorial e Gráfica
28812-81 | Receita da Produção Animal e Derivados
28811-01 | Receita da Produção Vegetal
98815-45 | Ressarcimento Salário Servidor Cedido
28830-61 | Serviços Administrativos (Emissão diplomas/atestados,Taxas,Pgto Xerox)
28838-11 | Serviços de Estudo e Pesquisas
28837-31 | Serviços de Hospedagem e Alimentação
28832-21 | Serviços Educacionais
28835-71 | Serviços Recreativos e Culturais
28883-71 | Taxa de Inscrição Concurso e Processos Seletivos
28845-41 | Transferência de Convênios Estados, DF e Entidades
28846-21 | Transferência de Convênios Instituições Privadas
```

### Códigos de Unidades Gestoras (ugr_code)


```
Código | Unidade Gestora
------ | -------------------------------------------------------
153341 | Almoxarifado Central
153328 | Biblioteca Central
158112 | Centro de Biotecnologia do Estado do Rio Grande do Sul
153546 | Centro de Ecologia
153547 | Centro de Estudos Costeiros, Limnológicos e Marinhos
153307 | Centro de Estudos e Pesquisas Econômicas
153306 | Centro de Estudos e Pesquisas em Administração
153552 | Centro de Microscopia Eletrônica
153316 | Centro de Pesquisa em Odontologia Social
153331 | Centro de Processamento de Dados
153332 | Centro de Teledifusão Educativa
153932 | Centro Nacional de Supercomputação
153324 | Colégio de Aplicação
153333 | Editora da UFRGS
153330 | Escola de Administração
153319 | Escola de Educação Física
153312 | Escola de Enfermagem
153301 | Escola de Engenharia
153308 | Escola Técnica
153303 | Estação Experimental Agronômica
153302 | Faculdade de Agronomia
153304 | Faculdade de Arquitetura
153321 | Faculdade de Biblioteconomia e Comunicação
153305 | Faculdade de Ciências Econômicas
153322 | Faculdade de Direito
153323 | Faculdade de Educação
153313 | Faculdade de Farmácia
153314 | Faculdade de Medicina
153315 | Faculdade de Odontologia
153317 | Faculdade de Veterinária
153644 | Gráfica Universitária
153318 | Hospital de Clínicas Veterinárias
153325 | Instituto de Artes
153311 | Instituto de Biociências
153981 | Instituto de Ciências Básicas da Saúde
153309 | Instituto de Ciências e Tecnologia de Alimentos
153320 | Instituto de Filosofia e Ciências Humanas
153297 | Instituto de Física
153298 | Instituto de Geociências
153334 | Instituto de Informática
153326 | Instituto de Letras
153299 | Instituto de Matemática
153310 | Instituto de Pesquisas Hidráulicas
153972 | Instituto de Psicologia
153300 | Instituto de Química
153933 | Instituto Latino-Americano de Estudos Avançados
153339 | Pró-Reitoria de Extensão
153336 | Pró-Reitoria de Graduação
153980 | Pró-Reitoria de Pesquisa
153335 | PRÓ-REITORIA DE PLANEJAMENTO E ADMINISTRAÇÃO
153337 | Pró-Reitoria de Planejamento e Administração - DPO
153979 | Pró-Reitoria de Pós-Graduação
153600 | Pró-Reitoria de Recursos Humanos
153010 | PROPLAN - Prestação de Serviços
153329 | PROPLAN/DAC
153340 | Secretaria de Assistência Estudantil
153551 | Superintendência de Infra-Estrutura
153114 | Universidade Federal do Rio Grande do Sul
```