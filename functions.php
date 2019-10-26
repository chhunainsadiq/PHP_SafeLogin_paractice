<?php
class func
{
    public static function checkLoginState($dbh)
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if(isset($_COOKIE['userId']) && isset($_COOKIE['serial']) && isset($_COOKIE['token'])){
            $userId=$_COOKIE['userId'];
            $token=$_COOKIE['serial'];
            $serial=$_COOKIE['token'];

            echo 'userId is'.' '.$userId.'<br>';
            echo 'token is'.' '.$token.'<br>';
            echo 'serial is'.' '.$serial.'<br>'; 

            $sql="select * from sessions where sessions_user_id = :user_id AND
            sessions_serial = :serial AND sessions_token=:token;
            ";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':user_id'=>$_COOKIE['userId'],':serial'=>$_COOKIE['serial'],':token'=>$_COOKIE['token']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['sessions_user_id']>0){
                if(($row['sessions_user_id'] == $_COOKIE['userId']) && ($row['sessions_serial']== $_COOKIE['serial']) && ($row['sessions_token']==$_COOKIE['token'])){
                    if($row['sessions_user_id'] == $_SESSION['userId'] && $row['sessions_serial']== $_SESSION['serial'] && $row['sessions_token']== $_SESSION['token']){
                        return true;
                    }else{
                        func::createSession($_COOKIE['userId'],$_COOKIE['username'],$_COOKIE['serial'],$_COOKIE['token']);
                        return true;
                    }
                }
            }
        }
    } 

    public static function createRecord($dbh,$userID,$username){
        echo 'Inside Create record method';
        $query ="Insert into sessions(sessions_user_id,sessions_serial,sessions_token,sessions_date)
        values (:userId,:serial,:token,:date);";

        $dbh->prepare("delete from sessions where sessions_user_id=:userId")->execute(array(':userId'=>$userID));
        $token = func::createString(30);
        $serial =func::createString(30);
        func::createCookie($userID,$username,$token,$serial);
        func::createSession($userID,$username,$token,$serial);

        $stmt=$dbh->prepare($query);
        $stmt->execute(array(':userId'=>$userID,':serial'=>$serial,':token'=>$token,':date'=>'12-10-2019'));
    }

    public static function createCookie($userID,$username,$token,$serial){
        setcookie('userId',$userID,time()+(86400)*30,"/");
        setcookie('username',$username,time()+(86400)*30,"/");
        setcookie('token',$token,time()+(86400)*30,"/");
        setcookie('serial',$serial,time()+(86400)*30,"/");

    }

    public static function deleteCookie(){
        setcookie('userId','',time()-1,"/");
        setcookie('username','',time()-1,"/");
        setcookie('token','',time()-1,"/");
        setcookie('serial','',time()-1,"/");

        session_destroy();
    }

    public static function createSession($userID,$username,$token,$serial){
        if(!isset($_SESSION)){
            session_start();
        }
        $_SESSION['username']=$username;
        $_SESSION['userId']=$userID;
        $_SESSION['serial']=$serial;
        $_SESSION['token']=$token;
    }

    // public static function createString($len){
    //     $string = '1qay22WsXUYHGJKLFR4BHJKLF4GHJKLDCxZVBNMK7QWERTYUIOP8LKJ7H5G4F';
    //     $s='';
    //     $r_new='';
    //     $r_old='';
    //     for($i=1;$i<$len;$i++){
    //         while($r_old==$r_new){
    //             $r_new=rand(0,60);
    //         }
    //         $r_old=$r_new;
    //         $s=$s.$string[$r_new];
    //     }
    //     return $s;
    // }

    public static function createString($len){
        $string ='1qay22WsXUYHGJKLFR4BHJKLF4GHJKLDCxZVBNMK7QWERTYUIOP8LKJ7H5G4F';

        return substr(str_shuffle($string),0,30);
    }

    public static function createUser(){
        

    }
}
?>