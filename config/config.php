<?php
error_reporting(0);
//require_once(dirname(__FILE__) . '/../../../../config/config.php');
require_once(dirname(__FILE__) . '/../include/constant.php');
class DBController
{
        private $host = 'localhost';
        private $user = 'astecztc_sml';
        private $password = 'yI@l~0Sy7F%y';
        private $database = 'astecztc_sml';
        private $connection = "";

        function __construct()
        {
                $conn = $this->connectDB();
                $this->connection = $conn;
        }

        function connectDB()
        {
                $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("Error".mysqli_connect_error());
                return $conn;
        }
        function runQuery($query)
        {
                $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
                while ($row = mysqli_fetch_assoc($result)) {
                        $resultset[] = $row;
                }
                if (!empty($resultset))
                        return $resultset;
        }

        function numRows($query)
        {
                $result  = mysqli_query($this->connection, $query);
                $rowcount = mysqli_num_rows($result);
                return $rowcount;
        }

        function insertRows($query)
        {
                $result  = mysqli_query($this->connection, $query) OR DIE(mysqli_error($this->connection));
                $rowcount = mysqli_insert_id($this->connection);
                return $rowcount;
        }

        function updateRows($query)
        {
                $result  = mysqli_query($this->connection, $query);
                return $result;
        }
}
$db_handle = new DBController();

// if($_SESSION['userDetails']['multi_login_flag'] == 1) {
//         $getToken_qry = $db_handle->tokenCheck($_SESSION['userDetails']['user_id']);
//         $login_token_val = $db_handle->runQuery($getToken_qry);
//         if($login_token_val[0]['last_token'] != $_SESSION['userDetails']['login_token']){
//                 header("location:".$head_url."logout.php");
//         exit;
//         }
// }
?>
