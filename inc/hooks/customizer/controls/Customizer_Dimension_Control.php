<?php 


if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Class Hestia_Customize_Alpha_Color_Control
 */
class Customizer_Dimension_Control extends WP_Customize_Control {
	/**
	 * Official control name.
	 *
	 * @var string
	 */
   public $type = 'dimension-control';

   public $unit = "";
   public $dimension_type = "";
	
   public $dimensions;
   
   public function __construct( $manager, $id, $args = array(), $options = array() ) {
      parent::__construct( $manager, $id, $args );

       $this->dimensions = [
          "top" => null,
          "right" => null,
          "bottom" => null,
          "left" => null,
         
       ];

       if(isset($this->input_attrs["type"])){
         $this->dimension_type = $this->input_attrs["type"];
       }

       $db_value = json_decode($this->value(),true);
       
       $this->unit = $this->getUnit($db_value);

      
      
   }

   public function getUnit($value){
      $unit = "px";
      
      if(is_null($value) || $value==''){
         return $unit;
      }
      if(!is_array($value)){
         return $unit;
      }

      foreach($value as $key=>$item){
          $unit = $item;
          if( strpos($key, 'margin') === 0 || strpos($key, 'padding') === 0 ){
             $number_key=explode("-",$key)[1];
             $this->dimensions[$number_key] = preg_replace("/[^0-9]/", "", $item );
          }else{
            $this->dimensions[$key] = preg_replace("/[^0-9]/", "", $item );  
          } 

      }
     
      return preg_replace('/[0-9]+/', '', $unit);
   }

  
	
	/**
	 * Enqueue scripts and styles.
	 *
	 * Ideally these would get registered and given proper paths before this control object
	 * gets initialized, then we could simply enqueue them here, but for completeness as a
	 * stand alone class we'll register and enqueue them here.
	 */
	public function enqueue() {
	
      wp_enqueue_script( 'customizer-control-repeat', TS_JS . '/customizer_repeater.js', array( 'jquery' ), TS_VERSION, true );
      wp_enqueue_style( 'customizer-control', TS_CSS . '/customizer.css', array(), '1.1', 'all' );
	}
	/**
	 * Render the control.
	 */
	public function render_content() {
	  ?>
		<label>
         <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input id="<?php echo esc_attr($this->id); ?>" class="custom-dimension-control" type="hidden" <?php esc_attr( $this->link() ); ?>  value="<?php echo $this->value(); ?>" />
         <div class="custom-dimension-control-visible-section">
         <ul data-unit="<?php echo esc_attr($this->unit); ?>" class="custom-control-dimension-size"> <li class="dimension-px <?php echo esc_attr($this->unit=="px"?"active":''); ?>" data-value="px"> <?php echo esc_html__("px","TS"); ?> </li> <li class="dimension-percent <?php echo esc_attr($this->unit=="%"?"active":''); ?>" data-value="%"> <?php echo esc_html__("%","TS"); ?> </li> <li class="dimension-em <?php echo esc_attr($this->unit=='em'?'active':''); ?>" data-value="em"> <?php echo esc_html__("em","TS"); ?> </li> <ul>   
         
         <div data-type="<?php echo esc_attr($this->dimension_type); ?>" class="customizer-all-dimensions <?php echo esc_attr($this->id); ?>" data-id="<?php echo esc_attr($this->id); ?>"> 
         <?php foreach($this->dimensions as $key=>$value): ?>
     
         <div  class="custom-dimension">
             <input size="10" class="custom-dimension-control-input <?php echo esc_attr($key) ?>" type="number" value="<?php echo esc_attr($value); ?>" />
             <span> <?php echo esc_attr($key) ?> </span>  
        </div>
       
         <?php endforeach ?>   
        </div>  
         </div>      
		</label>
	<?php 	
	}
}
