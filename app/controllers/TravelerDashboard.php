<?php

class TravelerDashboard extends Controller{
    
      public function __construct(){
        if(!isLoggedIn()){
          redirect('users/login');
        }
        $this->userModel=$this->model('User');
        $id= $_SESSION['user_id'];
        $user=$this->userModel->findUserDetail($id);
        
      }
    
    public function index(){
      $id= $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);

      $data = [
        'id' => '$id',
        'email'=>$user->email,
        'lname' => $user->lname,
        'fname' => $user->fname,
        'number' => $user->number,
        'profile_picture'=>$user->profile_picture,
      ];
      $this->view('travelerDashboard/index',$data);
    }
    public function settings($id){
      $id= $_SESSION['user_id'];
      $user=$this->userModel->findUserDetail($id);

      $data = [
        'id' => '$id',
        'email'=>$user->email,
        'lname' => $user->lname,
        'fname' => $user->fname,
        'number' => $user->number,
        'profile_picture'=>$user->profile_picture,
      ];
        $this->view('travelerDashboard/settings',$data);
    }
    public function editInfo(){
      
      $this->view('travelerDashboard/editInfo');
    }
    
//     public function changeProfilePicture(){
//       if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     if (isset($_FILES['profilePicture'])) {
//         $file = $_FILES['profilePicture'];

//         // Validate file type
//         $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
//         if (!in_array($file['type'], $allowedTypes)) {
//             http_response_code(400);
//             echo json_encode(['error' => 'Invalid file type.']);
//             exit;
//         }

//         // Validate file size (2MB)
//         if ($file['size'] > 2 * 1024 * 1024) {
//             http_response_code(400);
//             echo json_encode(['error' => 'File size exceeds the limit.']);
//             exit;
//         }

//         // Handle file upload
//         $targetDirectory = 'uploads/';
//         $targetFile = $targetDirectory . basename($file['name']);

//         if (move_uploaded_file($file['tmp_name'], $targetFile)) {
//             // File uploaded successfully
//             echo json_encode(['message' => 'File uploaded successfully.']);

//             // Now, you can store the file path in the database
//             $filePathInDatabase = $targetFile;

//             $data = [
//               'id' => $_SESSION['user_id'],
//               'picture'=>$filePathInDatabase,
              
//             ];

//             $user=$this->userModel->updatePicture($data);

//             if ($user) {
//                 // Database update successful
//                 echo json_encode(['message' => 'Profile picture updated successfully.']);
//             } else {
//                 // Database update failed
//                 http_response_code(500);
//                 echo json_encode(['error' => 'Error updating profile picture.']);
//             }
//         } else {
//             http_response_code(500);
//             echo json_encode(['error' => 'Error uploading file.']);
//         }
//     } else {
//         http_response_code(400);
//         echo json_encode(['error' => 'Invalid request.']);
//     }
// } else {
//     http_response_code(400);
//     echo json_encode(['error' => 'Invalid request method.']);
// }

//     }

    public function changePicture(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['savePic'])) {
          // echo "working have file";
          // print_r($_POST);
          // print_r($_FILES);
          $profilePictureName=$_FILES['newProfilePicture']['name'];
          $data = [
            'id' => $_SESSION['user_id'],
            'picture'=>$profilePictureName,
            
          ];
          // echo $profilePictureName;
          $target = 'images1/' . $profilePictureName;
          if(move_uploaded_file($_FILES['newProfilePicture']['tmp_name'],$target)){
            // echo "file uploaded";
            if($user=$this->userModel->updateProPicture($data)){
              redirect('travelerDashboard/settings/'.$_SESSION['user_id']);
            }
            
            // redirect('travelerDashboard/settings');

          }else{
            // echo "file not uploaded"; 
            
echo '<script>';
echo 'alert("Click on image to change the image");';
echo 'window.location.href = "settings/' . $_SESSION['user_id'] . '";';
echo '</script>';

          }
          
        }else{
          echo "Post working,no file" ;
        }

      }else{
        echo "POST not working";
      }

    }

    
}



