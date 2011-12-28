<?php

require 'gru.class.php';

class GRUMock extends GRU {
	//protected $resource_path = 'php://';
	//protected $resource      = 'guia';

	public static function forge($props)
	{
		return new GRUMock($props);
	}
	
	public function get_param($param)
	{
		return isset($this->properties[$param]) ? $this->properties[$param] : false;
	}
}

class GRUTestCase extends PHPUnit_Framework_TestCase {
	
	protected function setUp() {}

	public function testForge()
	{
		$gru = GRUMock::forge(array(
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
	 * Erros no formato das propriedades
	 */
	public function testSetProperty($gru)
	{
		$tests = array(
			array('cpf', '1234567891'),
			array('cpf', '1234567891'),
			array('cpf', '123.456.789.10'),
			array('cpf', '123.456.789.10'),
			array('cpf', '123.456-789-10'),
			array('cpf', '123-456-789-10'),
			array('cpf', '123.456.78910'),
			array('cpf', 'a23.456.789-10'),
			array('cpf', '123.456.789-aa'),
			array('cgc', '12234567901234'),
			array('cgc', '122.345.679.012/34'),
			array('cgc', '122.345.679/012-34'),
			array('cgc', '12.234.5679/012-34'),
			array('cgc', 'a2.234.567/9012-34'),
			array('cgc', '12.234.567/a012-34'),
			array('cgc', '12.234.567/9012-a4'),
			array('expiration', '7/12/1986'),
			array('expiration', '07-12-1986'),
			array('expiration', '2015-12-07'),
			array('expiration', '40/12/2015'),
			array('expiration', '01/13/2015'),
			array('expiration', '01/13/2015'),
			//array('expiration', date('d/m/Y', strtotime('-1 day'))),
			array('value', '-15,00'),
			array('value', -15),
			array('value', 0),
			array('value', false),
			array('value', '1.00'),
			array('value', '1'),
			array('value', 'R$1'),
			array('value', 'R$1,00'),
		);

		$exceptions = 0;
		foreach ($tests as $test)
		{
			try {
				$gru->set_property($test[0], $test[1]);
			} catch (InvalidArgumentException $e) {
				$exceptions += 1;
			}
		}	

		$this->assertEquals(sizeof($tests), $exceptions);
		$this->assertEquals('012.345.678-91', $gru->get_param('cpf'));
		$this->assertEquals(false, $gru->get_param('cgc'));
		$this->assertEquals(false, $gru->get_param('expiration'));
		$this->assertEquals(false, $gru->get_param('value'));
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
		
		// submition should return an exception, because CPF is invalid
		$gru->submit();
	}

}