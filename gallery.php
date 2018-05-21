<?php
        //Creates gallery of pictures 
	require 'vendor/autoload.php';
	
	# SETTINGS
	$max_width = 100;
	$max_height = 100;
        $pics = array();
        $file2 = " ";
	if(isset($_GET['phrase'])){
		$phrase = $_GET['phrase']; }
	else {
		$phrase = 'j';}
	if($phrase == null){
		$phrase = 'j';
     	}


	$loader = new Twig_Loader_Filesystem('templates/');
	$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
	));
	 
	global $max_width, $max_height;
	if ( $handle = opendir("./pics/") ) {
		while ( ($file = readdir($handle)) !== false ) {
		if ( !is_dir($file) ) {
			$split = explode('.', $file); 
			$ext = $split[count($split) - 1];
			$id = substr($file,0,-4);
			if ( $ext == 'jpg' ) {	
			if( strpos( $file, $phrase ) !== false ) {
    				$pics[] = array('file' => $file,'id' => $id);
				} 
                                        	}		
				}
          
					
				}
			}
			
		
	
echo $twig->render('gallery.html', array(
    'pics' => $pics
));


?>




 
