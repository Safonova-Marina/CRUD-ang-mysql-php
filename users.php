<?php
    include("./connect.inc.php");
    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $input = json_decode(file_get_contents('php://input'),true);
    // echo $method."req".$request."inp".$input;

    switch ($method) {
        case 'GET':
            $strSQL = "SELECT * FROM t_user";
            $result = mysql_query($strSQL) or die("He удалось выполнить запрос t_user!");
            $users = array();
            while ($row = mysql_fetch_array ($result, MYSQL_ASSOC)) {
                $users_data = array (
                    id => $row['user_id'],
                    name => rawurldecode($row['name']),
                    email => $row['email'],
                    passw => $row['password']
                );
                array_push($users, $users_data);
            }//while
            echo json_encode($users);
            break;
        case 'POST':
            echo "post";
            print_r($input);
            //$us_id = $input['id'];
            $name = $input['name'];
            $email = $input['email'];
            $password = $input['passw'];
            //$new_data = $_POST['new_data'];
			// parse_str($new_data);
			$name = rawUrlEncode($name);
			$strSQL = "INSERT INTO t_user (name, email, password)  VALUES 
				('".$name."','".$email."','".$password."')"; 
			mysql_query($strSQL);
            break;

        case 'PUT':
            echo "put";
        	//echo $method."req".$request."inp".$input;
            //print_r($input);
            $us_id = $input['id'];
			$new_name = $input['name'];
			$new_email = $input['email'];
			$new_pass = $input['passw'];
			//echo "$us_id";
			//echo "$new_data";
			$new_name = rawUrlEncode($new_name);
			$strSQL="UPDATE t_user SET name='".$new_name."', email='".$new_email."', password='".$new_pass."' WHERE user_id ='".$us_id."'"; 
			//echo "$strSQL";
			mysql_query($strSQL);
            break;

        case 'DELETE':
        //print_r($_GET);
        	$us_id = $_GET['id'];
            $strSQL="DELETE FROM t_user WHERE user_id ='".$us_id."'";
			//echo "$strSQL";
			mysql_query($strSQL);
			print_r($_GET);
            break;
        default:
            # code...
            break;
    };
    // $us_id = $_POST['us_id'];
    // //$new_data = $_POST['new_data'];
    // //echo "$us_id";
    // //echo "$new_data";

    // $strSQL1 = "SELECT name, email FROM t_user WHERE user_id ='".$us_id."'";
    // $result = mysql_query($strSQL1) or die("He ìîãó âûïîëíèòü çàïðîñ t_user!");
    // while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    //     //printf("nam: %s  em: %s", $row[0], $row[1]);
    //     //echo json_encode($row);
    //     echo $row[0].'/'.$row[1];
    // }
    // //$strSQL = "UPDATE t_user SET name = WHERE WHERE user_id ='".$us_id."'";
?>