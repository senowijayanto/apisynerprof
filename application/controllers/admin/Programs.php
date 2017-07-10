<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programs extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('programs_model');
  }

  public function index() {
    $data['programs'] = $this->programs_model->get(NULL, array('deleted' => 0));
    $data['content']  = 'admin/programs';
    $data['title']    = 'Programs Data';
    $this->load->view('admin/template', $data);
  }

  public function add() {
    $name         = $this->input->post('name');
    $description  = $this->input->post('description');
    $items        = $this->input->post('items');
    $price        = $this->input->post('price');

    $programs = array(
      'name'        => $name,
      'description' => $description,
      'items'       => $items,
      'price'       => $price,
      'created_at'  => date("Y-m-d H:i:s")
    );

    if ( $this->input->post() ) {
      if ( $_FILES['image']['name'] ) {
        $upload_path_base = 'programs/';
        $upload_path = FCPATH . config_item( 'cdn_path' ) . $upload_path_base;

        if ( ! is_dir( $upload_path ) ) {
          mkdir( $upload_path, 0755, TRUE );
        }

        $config = array(
          'upload_path'   => $upload_path,
          'allowed_types' => 'gif|jpg|png',
          'encrypt_name'  => TRUE
        );

        $this->load->library('upload', $config);

        if ( $this->upload->do_upload('image') ) {
          $upload_data        = $this->upload->data();

          $programs['image']  = $upload_data['file_name'];

          $configThumb = array(
            'image_library'   =>'gd2',
            'source_image'    => $upload_data['full_path'],
            'new_image'       => $upload_path . '/thumb_' . $upload_data['file_name'],
            'maintain_ratio'  => TRUE,
            'log_threshold'   => 2,
            'width'           => 100,
            'height'          => 100
          );

          $this->load->library('image_lib');
          $this->image_lib->initialize( $configThumb, true );

          if ( $this->image_lib->resize() ){
            $programs['thumbnail'] = 'thumb_' . $upload_data['file_name'];
          }else{
            $data['err'] = $this->image_lib->display_errors();
            break;
          }

          $this->image_lib->clear();
          $save = $this->programs_model->insert( $programs );
        } else {
          $data['err']  = $this->upload->display_errors();
          break;
        }
      } else {
        $save = $this->programs_model->insert( $programs );
      }

      if ( $save ) {
        redirect('admin/programs');
      }
    }

    $data['title']    = 'Add Program';
    $data['content']  = 'admin/add_program';
    $this->load->view('admin/template', $data);
  }

  public function edit( $id = 0) {
    $id = (int) $id;
    $program      = $this->programs_model->get_by('id', $id);
    $file_name    = $program->image;

    $name         = $this->input->post('name');
    $description  = $this->input->post('description');
    $items        = $this->input->post('items');
    $price        = $this->input->post('price');

    $programs = array(
      'name'        => $name,
      'description' => $description,
      'items'       => $items,
      'price'       => $price,
      'updated_at'  => date("Y-m-d H:i:s")
    );

    if ( $this->input->post() ) {
      if ( $_FILES['image']['name'] ) {
        $upload_path_base = 'programs/';
        $upload_path = FCPATH . config_item( 'cdn_path' ) . $upload_path_base;

        if ( ! is_dir( $upload_path ) ) {
          mkdir( $upload_path, 0755, TRUE );
        }

        $config = array(
          'upload_path'   => $upload_path,
          'allowed_types' => 'gif|jpg|png',
          'encrypt_name'  => TRUE
        );

        $this->load->library('upload', $config);

        if ( $this->upload->do_upload('image') ) {
          // If upload success
          @unlink($upload_path.$file_name); // Delete old image
          @unlink($upload_path.'/thumb_'.$file_name);

          $upload_data        = $this->upload->data();
          $programs['image']  = $upload_data['file_name'];

          $configThumb = array(
            'image_library'   =>'gd2',
            'source_image'    => $upload_data['full_path'],
            'new_image'       => $upload_path . '/thumb_' . $upload_data['file_name'],
            'maintain_ratio'  => TRUE,
            'log_threshold'   => 2,
            'width'           => 100,
            'height'          => 100
          );

          $this->load->library('image_lib');
          $this->image_lib->initialize( $configThumb, true );

          if ( $this->image_lib->resize() ){
            $programs['thumbnail'] = 'thumb_' . $upload_data['file_name'];
          }else{
            $data['err'] = $this->image_lib->display_errors();
            break;
          }
          $this->image_lib->clear();

          $update = $this->programs_model->update( $programs, array( 'id' => $id ) );
        } else {
          // If upload failed
          $data['err']  = $this->upload->display_errors();
        }
      } else {
        $update = $this->programs_model->update( $programs, array( 'id' => $id ) );
      }

      if ( $update ) {
        redirect('admin/programs');
      }
    }

    $data['program']  = $program;
    $data['title']    = 'Edit Program';
    $data['content']  = 'admin/edit_program';
    $this->load->view('admin/template', $data);
  }

  public function delete( $id = 0 ) {
    $id = (int) $id;

    if (!$id) {
      $data = array(
        'type' => 'error',
        'title' => 'Error',
        'text' => 'Invalid ID!'
      );
    } else {
      if( $this->programs_model->update( array('deleted' => 1), array('id' => $id) ) ){
				$data = array(
					'type' => 'success',
					'title' => 'Success',
					'text' => 'Record has been successfully deleted!'
				);
			}else{
				$data = array(
					'type' => 'error',
					'title' => 'Error',
					'text' => 'An error occurred while deleting the record!'
				);
			}
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
  }
}
