<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('directory_model');
    }
	
	public function directory_listing()
	{
		$data['directory_list'] = $this->directory_model->GetData('uploaded_files',array('sortBy'=>'uploadid','sortDirection'=>'DESC'),array('delete_file'=>'no'));
		$this->load->view('directory_listing',$data);
	}

	public function upload_new_file()
	{
		$this->load->view('upload_file');
	}


	public function upload_files()
	{
		$config['upload_path'] = './assets/uploads';
		$config['allowed_types'] = 'txt|doc|docx|pdf|png|jpeg|jpg|gif';
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload',$config);
		if($this->upload->do_upload('file'))
		{
			$data = array('upload_data'=>$this->upload->data());
			$title_name = $this->input->post('title');

			$directory_list = $this->directory_model->GetData('uploaded_files',array('sortBy'=>'uploadid','sortDirection'=>'DESC'),array('delete_file'=>'no','title_name'=>$title_name));
			if(empty($directory_list))
			{
				$filename = $data['upload_data']['file_name'];
				$inserted = $this->directory_model->AddData('uploaded_files',array('title_name'=>$title_name,'file_name'=>$filename,'createdon'=>date('Y-m-d H:i:s'),'delete_file'=>'no'));
				$row['message'] = 'Successfully uploaded files!';
				$row['status'] = true;
				echo json_encode($row);
			}
			else
			{
				$row['message'] = 'Title name already exist! Please try some other name!!';
				$row['status'] = false;
				echo json_encode($row);
			}
			
		}
		else
		{
			$row['message'] = $this->upload->display_errors();
			$row['status'] = false;
			echo json_encode($row);
			
		}
	}

	public function delete_files()
	{

    	$id = $this->input->post('uploadid');
		$result = $this->directory_model->UpdateData('uploaded_files',array('uploadid' => $id),array('delete_file'=>'yes','deletedon'=>date('Y-m-d H:i:s')));
		$row['success'] = 'success';              
        $row['message']='File has been deleted';
        echo json_encode($row);
        die();
	}

	public function files_history()
	{
		$data['directory_list'] = $this->directory_model->GetData('uploaded_files',array('sortBy'=>'uploadid','sortDirection'=>'DESC'));
		$this->load->view('history',$data);

	}
}
