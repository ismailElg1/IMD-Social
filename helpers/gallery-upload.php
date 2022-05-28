<?php
include_once("../classes/post.php");
if(isset($_POST['submit'])){

    function pre_r($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );

    function reArrayFiles( $file_post ){
        $file_ary = array();
        $file_count = count( $file_post['name'] );
        $file_keys = array_keys( $file_post );
    
        for( $i=0; $i<$file_count; $i++ ){
            foreach( $file_keys as $key ){
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
    
        return $file_ary;
    }
 
    if(!empty($_POST['galleryDesc'])&&!empty($_POST['galleryTitle'])){
        //check if tags are correctly filled in
        if(!empty($_POST['tags'])){
            $tags = $_POST['tags'];
            $tags = explode(",", $tags);
            $tags = array_map('trim', $tags);
            $tags = array_map('strtolower', $tags);
            $tags = array_map('htmlspecialchars', $tags);
            $tags = array_map('strip_tags', $tags);
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags);
            $tags = array_values($tags);

            $tags = implode(",", $tags);

            if(isset($_FILES['images'])){
       
                $file_array = reArrayFiles($_FILES['images']);
                
                foreach($file_array as $file){
                    $fileName = $file['name'];
                    $fileTmpName = $file['tmp_name'];
                    $fileSize = $file['size'];
                    $fileError = $file['error'];
                    $fileType = $file['type'];
                    $fileExt = explode('.', $fileName);
                    $fileActualExt = strtolower(end($fileExt));
                    $allowed = array('jpg', 'jpeg', 'png');
                    if(in_array($fileActualExt, $allowed)){
                   
                        if($fileError === 0){
                           
                            if($fileSize < 1000000){
                           
                                include_once('../classes/user.php');
        
                                session_start();
                                $user = User::getUserByEmail($_SESSION['email']);
        
                                $fileNameNew = uniqid('', true).".".$fileActualExt;
                                $fileDestination = '../upload/'.$fileNameNew;
                                move_uploaded_file($fileTmpName, $fileDestination);
                                $post = new Post();
                                $post->setTitle($_POST['galleryTitle']);
                                $post->setDescription($_POST['galleryDesc']);
                               
        
        
                                $post->setImage($fileNameNew);
                                $post->setUserId($user['id']);
                                $post->setCreatedAt(date('Y-m-d H:i:s'));
                                $post->setTags($tags);
                                $post->save();
        
                               
                                header("Location: ../index.php");
                              
                            }
                            else{
                                echo "Your file is too big";
                            }
                        }
                        else{
                            echo $phpFileUploadErrors[$fileError];
                        }
                    }
                    else{
                        echo "You cannot upload files of this type";
                       
                    }
                } 
                
              
            }
            else{
                echo 'No files uploaded';
            }
            
        }
        else{
            $tags = array();
            echo "Please fill in all tags";
        }
    }
    else{
        echo "Please fill in all fields";
    }
    
  
   
    //echo go back link
    echo '<br><a href="../gallery.php">Go Back</a>';

}
?>