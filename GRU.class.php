<?php

class GRU {
	
	/**
	 * Contains UGR and Descriptions codes (code => ugr/description)
	 *
	 * @access private
	 * @var    array
	 */
	private $codes = array(
		'ugr' => array(
			'153341' => 'Almoxarifado Central',
			'153328' => 'Biblioteca Central',
			'158112' => 'Centro de Biotecnologia do Estado do Rio Grande do Sul',
			'153546' => 'Centro de Ecologia',
			'153547' => 'Centro de Estudos Costeiros, Limnológicos e Marinhos',
			'153307' => 'Centro de Estudos e Pesquisas Econômicas',
			'153306' => 'Centro de Estudos e Pesquisas em Administração',
			'153552' => 'Centro de Microscopia Eletrônica',
			'153316' => 'Centro de Pesquisa em Odontologia Social',
			'153331' => 'Centro de Processamento de Dados',
			'153332' => 'Centro de Teledifusão Educativa',
			'153932' => 'Centro Nacional de Supercomputação',
			'153324' => 'Colégio de Aplicação',
			'153333' => 'Editora da UFRGS',
			'153330' => 'Escola de Administração',
			'153319' => 'Escola de Educação Física',
			'153312' => 'Escola de Enfermagem',
			'153301' => 'Escola de Engenharia',
			'153308' => 'Escola Técnica',
			'153303' => 'Estação Experimental Agronômica',
			'153302' => 'Faculdade de Agronomia',
			'153304' => 'Faculdade de Arquitetura',
			'153321' => 'Faculdade de Biblioteconomia e Comunicação',
			'153305' => 'Faculdade de Ciências Econômicas',
			'153322' => 'Faculdade de Direito',
			'153323' => 'Faculdade de Educação',
			'153313' => 'Faculdade de Farmácia',
			'153314' => 'Faculdade de Medicina',
			'153315' => 'Faculdade de Odontologia',
			'153317' => 'Faculdade de Veterinária',
			'153644' => 'Gráfica Universitária',
			'153318' => 'Hospital de Clínicas Veterinárias',
			'153325' => 'Instituto de Artes',
			'153311' => 'Instituto de Biociências',
			'153981' => 'Instituto de Ciências Básicas da Saúde',
			'153309' => 'Instituto de Ciências e Tecnologia de Alimentos',
			'153320' => 'Instituto de Filosofia e Ciências Humanas',
			'153297' => 'Instituto de Física',
			'153298' => 'Instituto de Geociências',
			'153334' => 'Instituto de Informática',
			'153326' => 'Instituto de Letras',
			'153299' => 'Instituto de Matemática',
			'153310' => 'Instituto de Pesquisas Hidráulicas',
			'153972' => 'Instituto de Psicologia',
			'153300' => 'Instituto de Química',
			'153933' => 'Instituto Latino-Americano de Estudos Avançados',
			'153339' => 'Pró-Reitoria de Extensão',
			'153336' => 'Pró-Reitoria de Graduação',
			'153980' => 'Pró-Reitoria de Pesquisa',
			'153335' => 'PRÓ-REITORIA DE PLANEJAMENTO E ADMINISTRAÇÃO',
			'153337' => 'Pró-Reitoria de Planejamento e Administração - DPO',
			'153979' => 'Pró-Reitoria de Pós-Graduação',
			'153600' => 'Pró-Reitoria de Recursos Humanos',
			'153010' => 'PROPLAN - Prestação de Serviços',
			'153329' => 'PROPLAN/DAC',
			'153340' => 'Secretaria de Assistência Estudantil',
			'153551' => 'Superintendência de Infra-Estrutura',
			'153114' => 'Universidade Federal do Rio Grande do Sul',
		),
		'descriptions' => array(
			'28803-91' => 'Aluguéis com contrato',
			'28802-01' => 'Aluguéis sem contrato',
			'28818-71' => 'Comércio de Livros, periódicos, material Escolar e publicações.',
			'28820-91' => 'Comércio de Produtos, Dados e Material de Informática',
			'98815-41' => 'Depósito de Terceiros',
			'98815-46' => 'Devolução de Bolsas',
			'98815-42' => 'Devolução de Diárias',
			'98815-43' => 'Devolução de Salários',
			'98815-44' => 'Devolução de Suprimento de Fundos',
			'28805-51' => 'Outras Receitas Imobiliárias',
			'28852-71' => 'Outras Restituições',
			'28840-31' => 'Outros Serviços',
			'28815-21' => 'Receita da Indústria Editorial e Gráfica',
			'28812-81' => 'Receita da Produção Animal e Derivados',
			'28811-01' => 'Receita da Produção Vegetal',
			'98815-45' => 'Ressarcimento Salário Servidor Cedido',
			'28830-61' => 'Serviços Administrativos (Emissão diplomas/atestados,Taxas,Pgto Xerox)',
			'28838-11' => 'Serviços de Estudo e Pesquisas',
			'28837-31' => 'Serviços de Hospedagem e Alimentação',
			'28832-21' => 'Serviços Educacionais',
			'28835-71' => 'Serviços Recreativos e Culturais',
			'28883-71' => 'Taxa de Inscrição Concurso e Processos Seletivos',
			'28845-41' => 'Transferência de Convênios Estados, DF e Entidades',
			'28846-21' => 'Transferência de Convênios Instituições Privadas',
		),
	);

	/**
	 * Describes all the GRU fields
	 *
	 * @access private
	 * @var    array
	 */
	private $fields = array(
		'type' => array(
			'field' => 'Tipo',
			'null' => true,
			'default' => 'Orgao',
		),
		'name' => array(
			'field' => 'NomeContribuinte',
			'null' => false
		),
		'cpf' => array(
			'field' => 'CPF',
			'format' => '\d{3}\.\d{3}\.\d{3}\-[0-9]{2}',
			'null' => false
		),
		'hcpf' => array(
			'field' => 'hCPF',
			'null' => true
		),
		'cgc' => array(
			'field' => 'CGC',
			'format' => '\d{2}\.(\d{3}){2}\/\d{4}\-\d{2}',
			'null' => true
		),
		'contract' => array(
			'field' => 'Contrato',
			'null' => true
		),
		'parcel' => array(
			'field' => 'Parcela',
			'null' => true
		),
		'expiration' => array(
			'field' => 'Vencimento',
			'format' => '([012][0-9]|3[01])\/(0[0-9]|1[012])\/20[1-9][0-9]',
			'null' => false
		),
		'value' => array(
			'field' => 'ValorDocumento',
			'format' => '\d+\,\d{2}',
			'null' => false
		),
		'fine' => array(
			'field' => 'ValorMulta',
			'format' => '\d+\,\d{2}',
			'null' => true
		),
		'description_code' => array(
			'field' => 'CodRecolhimento',
			'format' => '\d{5}\-\d{2}',
			'null' => false
		),
		'ugr_code' => array(
			'field' => 'CodUGR',
			'format' => '\d{6}',
			'null' => false
		),
		'obs' => array(
			'field' => 'Observacoes',
			'null' => true
		),
		'botao' => array(
			'field' => 'botao',
			'null' => true,
			'default' => 'Emitir DOC de Pagamento'
		),
	);

	/**
	 * The data to be submitted
	 *
	 * @access private
	 * @var    array
	 */
	private $properties;

	public function __construct($properties = array())
	{
		foreach ($properties as $property => $value)
		{
			$this->set_property($property, $value);
		}
	}

	/**
	 * Forge function, for some syntatic sugar
	 *
	 * @access  public
	 * @var     array
	 * @return  object  A new GRU object
	 */
	public static function forge($props)
	{
		return new GRU($props);
	}

	/**
	 * Analyze and set values to some property
	 *
	 * @access  public
	 * @var     string  the property key
	 * @var     string  the property value
	 * @return  bool    property value was/wasn't set
	 */
	public function set_property($property, $value)
	{
		if (isset($this->fields[$property]))
		{
			if (isset($this->fields[$property]['format']) and
				!preg_match('/^'.$this->fields[$property]['format'].'$/', $value))
			{
				throw new Exception('Property "'.$property.'" doesn\'t match correct field format');
			}
			$this->properties[$property] = $value;
			return true;
		}
		return false;
	}

	/**
	 * Prepare the already filled properties to submit
	 *
	 * @access  private
	 * @return  array      Translation from class key-values to the real keys
	 * @throws  Exception
	 */
	private function prepare_properties()
	{
		$prepared = array();
		foreach ($this->fields as $property => $field)
		{
			if (!$field['null'] and !isset($this->properties[$property]))
			{
				throw new Exception('Some required fields weren\'t filled');
			}
			elseif ($field['null'] and !isset($this->properties[$property]))
			{
				$this->properties[$property] = isset($field['default']) ? $field['default'] : '';
			}

			$prepared[$field['field']] = $this->properties[$property];
		}
		return $prepared;
	}
	
	public function submit()
	{
		$prepared = $this->prepare_properties();
		return $prepared;
	}

}

$props = array(
	'name' => 'Gustavo Seganfredo',
	'cpf' => '015.347.130-18',
	'expiration' => '25/12/2011',
	'value' => '25,00',
	'description_code' => '28883-71',
	'ugr_code' => '153334',
);

// GRU::forge($props)->submit();
