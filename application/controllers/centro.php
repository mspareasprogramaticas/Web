<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class centro extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->helper('form');
        $this->load->library('form_validation');
         $this->load->library('geoip_lib');
        $this->load->driver('session');
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}
	
	public function _example_output($output = null)
	{
		//$this->load->view('login.php',$output);

		$this->load->view('example.php',$output);
	}

	

public function listcentro()
	{
		$crud = new grocery_CRUD();

		//theme
		$crud->set_theme('bootstrap');

		//table
		$crud->set_table('catcentrosalud');
 echo '<h2>IP Query 24.24.24.24</h2>';
        echo '<p>--------------------------------------------------------------------------</p>';
        if($this->geoip_lib->InfoIP("200.0.210.236")) {
            echo '<br />City/Ciudad: '.$this->geoip_lib->result_city();
            echo '<br />Country Code/Código País: '.$this->geoip_lib->result_country_code();
            echo '<br />Country Name/País: '.$this->geoip_lib->result_country_name();
            echo '<br />Custom/Personalizado: '.$this->geoip_lib->result_custom("%CT , %RN (%C3)");
            echo '<br />Array: ';
            echo '<pre>';
            print_r($this->geoip_lib->result_array());
            echo '</pre>';
        } else {
            echo '<strong>IP ERROR</strong>';
        }
		//columns
		//$crud->columns('csId','csCodigo','csNombre','depId','csLatitud','csDirector','csTipologia','csTelefono');

		//subject
		$crud->set_subject('Centros Salud');

		//DISPLAY
	
    	//render
		$output = $crud->render();
		$this->_example_output($output);
		/*
		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}*/
	}	

	function edit_Documento($value, $primary_key)
{
    return '<input type="text" maxlength="50" value="'.$_SESSION['profDocumento'].'" name="profDocumento"  disabled= "disabled" style="width:462px">';
}
protected  function _date_fill_now()
		{
        return '<input name="date" type="text" value="'.  date (dd/mm/YYYY). '" maxlength="19" class="datetime-input">';
		}



	public function permisos_usr()
	{	
		return true;
	}
}