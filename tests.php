<?php

require 'gru.class.php';

class GRUMock extends GRU {
	protected $resource_path = 'php://';
	protected $resource      = 'guia';

	public static function forge($props)
	{
		return new GRUMock($props);
	}
	
	public function get_param($param)
	{
		return isset($properties[$param]) ? $properties[$param] : false;
	}
}

class GRUTestCase extends PHPUnit_Framework_TestCase {
	
	protected function setUp() {}

	public function testForge()
	{
		$gru => GRUMock::forge(array(
			'name' => 'Gustavo',
			'cpf'  => '012.345.678-91',
		));

		$this->assertEquals('Gustavo', $gru->get_param('name'));
		$this->assertEquals('012.345.678-91', $gru->get_param('cpf'));
		$this->assertEquals(false, $gru->get_param('cgc'));

		return $gru;
	}

	/**
	 * @depends testForge
	 * @expectedException InvalidArgumentException
	 * Erros no formato das propriedades
	 */
	 public function testSetProperty($gru)
	 {
	 	$exceptions = 0;
	 	try {
			$gru->set_property('cpf', '1234567891');
			$gru->set_property('cpf', '123.456.789.10');
			$gru->set_property('cpf', '123.456.789.10');
			$gru->set_property('cpf', '123.456-789-10');
			$gru->set_property('cpf', '123-456-789-10');
			$gru->set_property('cpf', '123.456.78910');
			$gru->set_property('cpf', 'a23.456.789-10');
			$gru->set_property('cpf', '123.456.789-aa');
			$gru->set_property('cgc', '12234567901234');
			$gru->set_property('cgc', '122.345.679.012/34');
			$gru->set_property('cgc', '122.345.679/012-34');
			$gru->set_property('cgc', '12.234.5679/012-34');
			$gru->set_property('cgc', 'a2.234.567/9012-34');
			$gru->set_property('cgc', '12.234.567/a012-34');
			$gru->set_property('cgc', '12.234.567/9012-a4');
			$gru->set_property('expiration', '7/12/1986');
			$gru->set_property('expiration', '07-12-1986');
			$gru->set_property('expiration', '2015-12-07');
			$gru->set_property('expiration', '40/12/2015');
			$gru->set_property('expiration', '01/13/2015');
			$gru->set_property('expiration', '01/13/2015');
			//$gru->set_property('expiration', date('d/m/Y', strtotime('-1 day')));
			$gru->set_property('value', '-15,00');
			$gru->set_property('value', -15);
			$gru->set_property('value', 0);
			$gru->set_property('value', false);
			$gru->set_property('value', '1.00');
			$gru->set_property('value', '1');
			$gru->set_property('value', 'R$1');
			$gru->set_property('value', 'R$1,00');
	 	} catch (InvalidArgumentException $e) {
	 		$exceptions += 1;
	 	}

	 	$this->assertEquals(29, $exceptions);
	 	$this->assertEquals('012.345.678-91', $gru->cpf);
	 	$this->assertEquals(false, $gru->cgc);
	 	$this->assertEquals(false, $gru->expiration);
	 	$this->assertEquals(false, $gru->value);
	 }

	/**
	 * @depends testForge
	 * @expectedException Exception
	 */
	public function testSubmitWithCompleteFields($gru)
	{
		$gru->set_property('expiration', date('d/m/Y', strtotime('+1 day')));
		$gru->set_property('value', '1,99');
		$gru->set_property('obs', 'hello-gru');
		$gru->set_property('ugr_code', '153334');
		$gru->set_property('description_code', '28840-31');
		$gru->submit();
	}


}