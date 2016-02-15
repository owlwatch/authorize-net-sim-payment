<?php namespace Payment;

use \AuthorizeNetSIM;
use \AuthorizeNetSIM_Form;

class Controller
{
  public static function init()
  {
    new self();
  }
  
  protected function isAjax()
  {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
  }
  
  protected function getPath()
  {
    $uri = $_SERVER['REQUEST_URI'];
    $path = trim( substr( $uri, strlen( ROOTPATH ) ), '/' );
    return $path;
  }
  
  private function __construct(){
    $path = $this->getPath();
    $this->config = new Config;
    $this->assets = new Assets;
    $this->templates = new \League\Plates\Engine( ROOTDIR.'/templates' );
    
    
    if( method_exists($this, $path) ){
      $this->$path();
    }
    else {
      $this->index();
    }
  }
  
  private function index()
  {
    $name = filter_input( INPUT_GET, 'Name', FILTER_SANITIZE_STRING );
    $client = filter_input( INPUT_GET, 'Client', FILTER_SANITIZE_NUMBER_INT );
    $invoice = filter_input( INPUT_GET, 'Invoice', FILTER_SANITIZE_NUMBER_INT );
    $amount = filter_input( INPUT_GET, 'Amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
    
    echo $this->templates->render('index', [
      'name'      => $name,
      'amount'    => $amount,
      'client'    => $client,
      'invoice'   => $invoice,
      'config'    => $this->config,
      'assets'    => $this->assets
    ]);
  }
  
  private function confirm()
  {
    
    //$name = filter_input( INPUT_POST, 'Name', FILTER_SANITIZE_STRING );
    $client = filter_input( INPUT_POST, 'Client', FILTER_SANITIZE_NUMBER_INT );
    $invoice = filter_input( INPUT_POST, 'Invoice', FILTER_SANITIZE_NUMBER_INT );
    $amount = filter_input( INPUT_POST, 'Amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
    
    if( !$amount ){
      return $this->index();
    }
    
    $time = time();
    
    $formFields = [
      'x_login'         => $this->config->get('authorize.net:api_login_id'),
      'x_type'          => 'AUTH_CAPTURE',
      'x_relay_response'=> 'FALSE',
      /*
      'x_relay_always'  => 'TRUE',
      'x_relay_url'     => ROOTURL.'/thank_you',
      */
      'x_color_background'  => '#f8f5ee',
      'x_logo_url'      => $this->config->get('logo_url'),
      'x_font_family'   => "'Trebuchet MS',Arial,Helvetica,sans-serif",
      'x_font_size'     => '14px',
      'x_amount'        => $amount,
      'x_cust_id'       => $client,
      'x_invoice_num'   => $invoice,
      'x_fp_hash'       => AuthorizeNetSIM_Form::getFingerprint(
        $this->config->get('authorize.net:api_login_id'),
        $this->config->get('authorize.net:transaction_key'),
        $amount,
        $invoice,
        $time
      ),
      'x_fp_timestamp'  => $time,
      'x_fp_sequence'   => $invoice,
      'x_show_form'     => 'PAYMENT_FORM'
    ];
    
    array_walk( $formFields, function( $val ){
      return urlencode( $val );
    });
    
    $simForm = new AuthorizeNetSIM_Form( $formFields );
    
    
    echo $this->templates->render('confirm', [
      'isAjax'      => $this->isAjax(),
      'simForm'     => $simForm,
      'config'      => $this->config,
      'assets'      => $this->assets,
      'invoice'     => $invoice,
      'amount'      => $amount
    ]);
  }
  
  private function thank_you()
  {
    
    $response = new \AuthorizeNetSIM(
      $this->config->get('authorize.net:api_login_id'),
      $this->config->get('authorize.net:md5_setting')
    );
    
    echo $this->templates->render('thank_you', [
      'config'      => $this->config,
      'assets'      => $this->assets,
      'response'    => $response,
      'invoice'     => $response->invoice_number
    ]);
  }
}
