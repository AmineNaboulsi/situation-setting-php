<?php 
header('Access-Control-Allow-origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Content-Type: application/json');

// $con = include('./config.php');
$con =include('./config.php');

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

//echo $con ;
if($method == 'GET'){
    
    $onlyroute = strtok($request , '?') ;
    switch ($onlyroute) {
        case '/getroles':

            $SqlDataReader = $con->prepare("SELECT * FROM Role");
            if(!$SqlDataReader->execute()){
                echo [
                    "status" => false ,
                    "message" => 'Error Server failed to make operation'
                ];
            }
            $resultat = $SqlDataReader->get_result();
            $Data = [] ;
            while($row = $resultat->fetch_assoc()){
                $Data[] = $row ;
            }
            // print_r($Data);
            echo json_encode($Data) ;
            break;
        
        default:
            echo json_encode([
                "status" => false ,
                "message" => 'Invalid Route'
            ]);
            break;
    }
}else if($method == 'POST'){
    $onlyroute = strtok($request , '?') ;
    switch ($onlyroute) {
        case '/adduser':
            if(isset($_POST['name']) && 
            isset($_POST['email']) && 
            isset($_POST['roleid'])){
                $SqlDataReader = $con->prepare("INSERT INTO  
                `User` (name , email , roleId) 
                VALUES 
                ( ? , ? ,? )");
                $SqlDataReader->bind_param('ssi',
                $_POST['name'] , $_POST['email'] , $_POST['roleid']) ;
    
            //     $SqlDataReader->bind_param('ssi',
            //    'test2' , 'test2' , 1) ;
    
                if(!$SqlDataReader->execute()){
                    echo [
                        "status" => false ,
                        "message" => 'Error Server failed to make operation'
                    ];
                }
               
                echo json_encode([
                    "status" => true ,
                    "message" => 'Added Succssefuly'
                ]);
            }else{
                echo json_encode([
                    "status" => false ,
                    "message" => 'missing parametres'
                ]);
            }
            break;
        
        default:
            echo json_encode([
                "status" => false ,
                "message" => 'Invalid Route'
            ]);
            break;
    }
}


?>