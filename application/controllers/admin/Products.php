<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('products_model');
  }

  public function index() {
    $data['products'] = $this->products_model->get(NULL, array('deleted' => 0));
    $data['content']  = 'admin/products';
    $data['title']    = 'Products Data';
    $this->load->view('admin/template', $data);
  }

  public function add() {
    $category     = $this->input->post('category');
    $name         = $this->input->post('name');
    $description  = $this->input->post('description');
    $benefits     = $this->input->post('benefits');
    $recomended   = $this->input->post('recomended');
    $ingredients  = $this->input->post('ingredients');

    if ( $this->input->post() ) {
      $upload_path_base = 'products/';
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

      if ( ! $this->upload->do_upload('image') ) {
        $data['err']  = $this->upload->display_errors();
      } else {
        $upload_file  = array( 'upload_data' => $this->upload->data() );
        $image        = $upload_file['upload_data'];
      }

      $products = array(
        'category'    => $category,
        'name'        => $name,
        'description' => $description,
        'benefits'    => $benefits,
        'recomended'  => $recomended,
        'ingredients' => $ingredients,
        'image'       => $image['file_name'],
        'created_at'  => date("Y-m-d H:i:s")
      );

      $save = $this->products_model->insert( $products );

      if ( $save ) {
        redirect('admin/products');
      }
    }

    $data['title']    = 'Add Product';
    $data['content']  = 'admin/add_product';
    $this->load->view('admin/template', $data);
  }

  public function edit( $id = 0) {
    $id = (int) $id;
    $product      = $this->products_model->get_by('id', $id);
    $file_name    = $product->image;

    $category     = $this->input->post('category');
    $name         = $this->input->post('name');
    $description  = $this->input->post('description');
    $benefits     = $this->input->post('benefits');
    $recomended   = $this->input->post('recomended');
    $ingredients  = $this->input->post('ingredients');

    $products = array(
      'category'    => $category,
      'name'        => $name,
      'description' => $description,
      'benefits'    => $benefits,
      'recomended'  => $recomended,
      'ingredients' => $ingredients,
      'updated_at'  => date("Y-m-d H:i:s")
    );

    if ( $this->input->post() ) {
      if ( $_FILES['image']['name'] ) {
        $upload_path_base = 'products/';
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

        if ( ! $this->upload->do_upload('image') ) {
          // If upload failed
          $data['err']  = $this->upload->display_errors();
        } else {
          // If upload success
          @unlink($upload_path.$file_name); // Delete old image
          $upload_file        = array( 'upload_data' => $this->upload->data() );
          $image              = $upload_file['upload_data'];
          $products['image']  = $image['file_name'];
          $update = $this->products_model->update( $products, array( 'id' => $id ) );
        }
      } else {
        $update = $this->products_model->update( $products, array( 'id' => $id ) );
      }

      if ( $update ) {
        redirect('admin/products');
      }
    }

    $data['product']  = $product;
    $data['title']    = 'Edit Product';
    $data['content']  = 'admin/edit_product';
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
      if( $this->products_model->update( array('deleted' => 1), array('id' => $id) ) ){
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
