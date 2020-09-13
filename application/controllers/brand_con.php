<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

	class Brand_con extends CI_Controller
	{

		 /**
		 * Product::__construct()
		 *
		 */

		public function __construct()
		{
			parent::__construct();

			$this->load->model('notification');

			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		}

		/**
		*fetch_brand()
		*
		*/

		public function fetch_Brand()
		{

			if(!$this->bitauth->logged_in())
			{
				$this->session->set_userdata('redir',current_url());
				redirect('account/login');
			}

			$this->load->model('brand');

			$data['brand'] = $this->brand->fetch_Brand_Model();
			
			$data['title'] = 'Company List';

            $data['expiryproduct'] = $this->notification->getExpiryProduct();
            $data['oftproduct'] = $this->notification->getOftProduct();
            $data['duedate'] = $this->notification->getDueDate();
            $data['exnoti'] = $this->notification->getExNoti();
            $data['ofsnoti'] = $this->notification->getOfsNoti();
            $data['ornoti']  = $this->notification->getOrdernoti();

			$path = 'brand/list';

			if(isset($_GET['ajax'])&&$_GET['ajax']==true)
			{
					$this->load->view($path, $data);
			}else{
					$data['contents']=array($path);
					$this->load->view('header',$data);
					$this->load->view('index',$data);
					$this->load->view('footer',$data);
			}

		}

		/**
		*Insert_brand()
		*
		*/

		public function add_Brand()
		{
			 $this->load->model('brand');

			 if (!$this->bitauth->logged_in())
			{
				$this->session->set_userdata('redir', current_url());
				redirect('account/login');
			}

			if($this->input->post())
			{

				$this->form_validation->set_rules(array(array( 'field' => 'brand_name' , 'label' => 'Brand Name' , 'rules' => 'required|trim|has_no_schar', ),

				array('field' => 'brand_description' , 'label' => 'Brand Description' , 'rules' => 'trim'),));

			if($this->form_validation->run() == TRUE )
			{

				unset($_POST['submit']);

					$brand = $this->input->post();
					foreach($brand as $key => $value)
					$this->brand->$key = $value;
					$this->brand->save();
					unset($_POST);

	             $this->session->set_flashdata('success', 'Successfully created');
	             redirect('brand_con/add_Brand/', 'refresh');

				}else{
					$data['error']=validation_errors();
				}

			}

			$data['category_list'] = $this->brand->fill_category_list();
			$data['expiryproduct'] = $this->notification->getExpiryProduct();
            $data['oftproduct'] = $this->notification->getOftProduct();
            $data['duedate'] = $this->notification->getDueDate();
            $data['exnoti'] = $this->notification->getExNoti();
            $data['ofsnoti'] = $this->notification->getOfsNoti();
            $data['ornoti']  = $this->notification->getOrdernoti();

			$data['title']  = 'Brand';
			$path='brand/add';
			if(isset($_GET['ajax'])&&$_GET['ajax']==true)
			{
					$this->load->view($path, $data);
			}
			else
			{
					$data['contents']=array($path);
					$this->load->view('header',$data);
					$this->load->view('index',$data);
					$this->load->view('footer',$data);
			}

		}
		/**
		*delete_brand()
		*
		*/
		public function update_Brand($brand_id=0)
		{

			 $this->load->model('brand');

			$data['category_name']= urldecode($this->uri->segment(4));

			 if (!$this->bitauth->logged_in())
			{
				$this->session->set_userdata('redir', current_url());
				redirect('account/login');
			}

			$this->brand->load($brand_id);

			 if($this->input->post())

			{

			$this->form_validation->set_rules(array(

			array( 'field' => 'brand_name' , 'label' => 'Brand Name' , 'rules' => 'required|trim|has_no_schar', ),
			array('field' => 'brand_description' , 'label' => 'Brand Description' , 'rules' => 'trim'),

			));

			if($this->form_validation->run() == TRUE){

				 unset($_POST['submit']);
				$brand = $this->input->post(); 
				$this->load->model('brand');
				foreach($brand as $key => $value)
				$this->brand->$key = $value;
				$this->brand->save();
				unset($_POST);

			    $data['script'] = '<script>alert("'.html_escape($this->brand->brand_name). 'has been edited successfuly.");</script>';

						redirect('brand_con/fetch_Brand');

				}else{
					//user may have sent the form to a url other than the original
					$data['error'] = validation_errors();
		    }

		}
			
				$data['category_list'] = $this->brand->fill_category_list();
				$data['expiryproduct'] = $this->notification->getExpiryProduct();
				$data['oftproduct'] = $this->notification->getOftProduct();
				$data['duedate'] = $this->notification->getDueDate();
				$data['exnoti'] = $this->notification->getExNoti();
				$data['ofsnoti'] = $this->notification->getOfsNoti();
				$data['ornoti']  = $this->notification->getOrdernoti();

				$data['title'] = 'Edit Brand';
				$data['brand']  = $this->brand;
				$path = 'brand/edit';

				 if(isset($_GET['ajax'])&&$_GET['ajax']==true)
				{ 

						$this->load->view($path, $data);

				}else{

				$data['contents']=array($path);
				$this->load->view('header',$data);
				$this->load->view('index',$data);
				$this->load->view('footer',$data);

			}

	}

		/**
		*update_brand()
		*
		*/
		public function delete_Brand($brand_id=0)
		{

			if(!$this->bitauth->logged_in())
			{
				$this->session->set_userdata('redir', current_url());
				redirect('account/login');
			}

			$this->load->model('brand');
			$this->brand->load($brand_id);

			if($this->input->post()){

				 $this->form_validation->set_rules(array(
					array( 'field' => 'brand_id', 'label' => 'ID', 'rules' => 'required|trim|has_no_schar', ),
					array( 'field' => 'del', 'label' => '', 'rules' => 'required|trim|has_no_schar', ),
				));

			if($this->form_validation->run() == TRUE && $this->input->post('brand_id') == $brand_id)
			{
					$this->load->model('product');
				    $this->product->get_by_fkey('brand_id',$brand_id);

				    if(!$this->product->brand_id){

					$this->brand->delete();

						echo 'ok';
						return;
					}else{

						echo 'nok';
						return;

					}

		    }else{

		   	     $data['error'] = 'mismatch';
                 return;


		    }

		}

			 $data['brand'] = $this->brand;
			 
			 $this->load->view('brand/delete',$data);

	 }

	}

 