<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('products_model');
  }

  public function index() {
    $data['products'] = $this->products_model->get();
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

      $file_name = sha1( time() );

      $config = array(
        'upload_path'   => $upload_path,
        'allowed_types' => 'gif|jpg|png',
        'encrypt_name'  => TRUE
      );

      $this->load->library('upload', $config);

      if ( ! $this->upload->do_upload('image') ) {
        $data['err']  = $this->upload->display_errors();
      } else {
        $image = array( 'upload_data' => $this->upload->data() );
        $image = $image['upload_data'];
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
}
