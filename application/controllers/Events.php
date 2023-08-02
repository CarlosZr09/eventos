<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Events extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		_is_logged_in();
        $this->load->database();
	}

    public function index(){
        $data['contenido'] = "admin/events";

		$data['titulo']='Eventos';
		
		$this->load->view('admin/include/template',$data);
    }

    public function create(){
        $this->load->model('events_model');
        $data=$_POST;
		$addEvent=array();
		$addEvent['user_id']=$this->session->userdata('user_id');
		$addEvent['tittle']=$data['titleEvent'];
		$addEvent['description']=$data['descriptionEvent'];
        $fechaObjeto = DateTime::createFromFormat('d/m/Y', $data['dateEvent']);
        $addEvent['date']=$fechaObjeto->format('Y-m-d');
        $addEvent['status']=1;

		$insert=$this->events_model->addEvent($addEvent);
        if($insert>0){
            $this->session->set_flashdata('error', '0');
            $this->session->set_flashdata('msg', 'Se creo el evento.');

        }else{
            $this->session->set_flashdata('error', '1');
            $this->session->set_flashdata('msg', 'Ocurrio un problema, intentelo nuevamente.');
        }

        redirect('events');
        
    }
    public function list(){
        $this->load->model('events_model');
        $datas = $this->events_model->list();
        $dataReturn = array();
        foreach ($datas as $data) {
            array_push($dataReturn,array("eventid"=>$data->id,"title"=>$data->tittle,"start"=>$data->date,"end"=>$data->date));
        }
        echo json_encode($dataReturn);
    }

    public function getEvent($eventId=9){
        
        $this->load->model('events_model');
        $data = $this->events_model->getEventById($eventId);
        echo json_encode($data);
    }
}