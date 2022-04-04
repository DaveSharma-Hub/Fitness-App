<?php
        //session_start();
        if (isset($_GET['id']) && $_GET['id']!="" &&isset($_GET['IID']) && $_GET['IID']!="" ) {

            $id = $_GET['id'];
            $IID = $_GET['IID'];

        $url = "http://localhost:5000/api.php?getChatData=".$id."&IID=".$IID;
	
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
        $result3 = json_decode($response);
            
        for($i=0;$i<count($result3->msg);$i++){
            if($result3->user[$i]==0){
                // echo "<div class='msgln'><span class='chat-time'>".date('m/d/Y', $data['longTime'])."</span> <b class='user-name'>".$data['userName']."</b><b class='user-data'>".$data['userData']."</b><br></div>";
                echo "<div class='rightThem'>Instructor</div><div class='right'>".$result3->msg[$i]."</div><br><br><br>";
            }
            else{
                //echo "<div class='msglnright'><span class='chat-time'>".date('m/d/Y', $data['longTime'])."</span> <b class='user-name'>".$data['userName']."</b><b class='user-data'>".$data['userData']."</b><br></div>";
                echo "<div class='leftMe'>You</div><div class='left'>".$result3->msg[$i]."</div><br><br><br>";
            }                               
        }
    }
        
?>
