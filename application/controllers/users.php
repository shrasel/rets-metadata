<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
{
    public $rets;

    public function __construct(){
        parent::__construct();
        $this->load->library('phrets');
        $this->rets = new Phrets;
        $this->rets->SetParam("compression_enabled", true);
        $this->rets->SetParam("debug_mode", false);
    }
    public function index()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        $this->retsLogin($this->session->userdata('url'),$this->session->userdata('username'),$this->session->userdata('password'));

        $server = $this->rets->GetServerInformation();
        $server_software = $this->rets->GetServerSoftware();
        $rets_version = $this->rets->GetServerVersion();
        $resources = $this->rets->GetMetadataResources();
        $transactions = $this->rets->GetAllTransactions();
        $login_url = $this->rets->GetLoginURL();
        $member_name = $this->rets->ServerDetail("MemberName");
        $timeout = $this->rets->ServerDetail("TimeoutSeconds");
        $metadata_version = $this->rets->ServerDetail("MetadataVersion");

        foreach ($resources as $key=>$resource) {
            $resources[$key]['classes'] = $this->rets->GetMetadataClasses($resource['ResourceID']);
        }


        $this->data['server'] = $server;
        $this->data['server_software'] = $server_software;
        $this->data['rets_version'] = $rets_version;
        $this->data['resources'] = $resources;
        $this->data['transactions'] = $transactions;
        $this->data['login_url'] = $login_url;
        $this->data['member_name'] = $member_name;
        $this->data['timeout'] = $timeout;
        $this->data['metadata_version'] = $metadata_version;

        $this->data['content'] = 'index';
        $this->load->view('_template', $this->data);
    }
    
    public function details(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $resource = $this->input->post('resource');
        $class = $this->input->post('class');
        $KeyField = $this->input->post('keyfield');
        $this->retsLogin($this->session->userdata('url'),$this->session->userdata('username'),$this->session->userdata('password'));
        $this->data['fields']  = $this->rets->GetMetadataTable($resource, $class);
        $this->data['resource']= $resource;
        $this->data['KeyField']= $KeyField;
        $this->data['class']= $class;
        $this->data['content'] = 'details';
        $this->rets->Disconnect();
        $this->load->view('_ajax',$this->data);

    }

    public function lookup(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $resource = $this->input->post('resource');
        $lookup_field = $this->input->post('lookup_name');
        $this->retsLogin($this->session->userdata('url'),$this->session->userdata('username'),$this->session->userdata('password'));
        $values =  $this->rets->GetLookupValues($resource, $lookup_field);
        $this->rets->Disconnect();
        $this->data['content'] = 'lookup';
        $this->data['values'] = $values;
        $this->load->view('_ajax',$this->data);
    }

    public function object(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $resource = $this->input->post('resource');
        $this->retsLogin($this->session->userdata('url'),$this->session->userdata('username'),$this->session->userdata('password'));
        $values = $this->rets->GetMetadataObjects($resource);
        $this->rets->Disconnect();
        $this->data['content'] = 'object';
        $this->data['values'] = $values;
        $this->load->view('_ajax',$this->data);

    }

    public function export($resource,$class){
        $fields_to_export = array('SystemName', 'StandardName', 'LongName', 'DBName',
            'ShortName', 'MaximumLength', 'DataType', 'Precision',
            'Searchable', 'Interpretation', 'Alignment',
            'UseSeparator', 'EditMaskID', 'LookupName',
            'MaxSelect', 'Units', 'Index', 'Minimum',
            'Maximum', 'Default', 'Required', 'SearchHelpID',
            'Unique', 'MetadataEntryID', 'ModTimeStamp',
            'ForeignKeyName', 'ForeignField', 'InKeyIndex'
        );

        $this->retsLogin($this->session->userdata('url'),$this->session->userdata('username'),$this->session->userdata('password'));

        $table =  $this->rets->GetMetadataTable($resource,$class );
        $this->rets->Disconnect();
        $csv = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');

        $output_list = array();
        foreach ($fields_to_export as $fi) {
            $output_list[] = $fi;
        }

        fputcsv($csv, $output_list);

        foreach ($table as $field) {
            $output_field = array();

            foreach ($fields_to_export as $fi) {
                if (isset($field[$fi])) {
                    $output_field[$fi] = $field[$fi];
                }
            }

            fputcsv($csv, $output_field);

        }

        rewind($csv);
        $output = stream_get_contents($csv);

        $filename = strtolower("rets-metadata-{$resource}-{$class}.csv");

        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"{$filename}\"");

        echo $output;
    }
    
    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('url', 'URL', 'trim|required|prep_url');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->input->post()) {
            if ($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('msg',validation_errors());
                redirect('login');
            }
            else
            {
                $connect = $this->retsLogin($this->input->post('url'),$this->input->post('username'),$this->input->post('password'));
                if ($connect===true) {
                    //$this->session->set_flashdata('msg', 'Logged in successfully');
                    $this->session->set_userdata(array('logged_in'=>true));
                    $this->session->set_userdata($this->input->post());
                    redirect('/');
                } else {
                    //debug($connect);
                    $this->session->set_flashdata('msg',$connect['code']);
                    redirect('login');

                }
            }

        }
        $this->data['content'] = 'login';
        $this->load->view('_template', $this->data);
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function retsLogin($url,$username,$password){

        $connect = $this->rets->Connect($url, $username, $password);
        if ($connect) {
            return true;
        }
        else {
            return  $this->rets->Error();
        }

    }

}