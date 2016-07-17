<?php

class User
{
// Config App
public $config;
/*
/ init $this->config
*/
public function __construct($config)
{
     $this->config = $config;
}

/*
/ Data cleaning
/ $data - string
/ return string
*/
public function Validate($data)
{
    return stripslashes(htmlspecialchars(trim($data)));
}

/*
/ Check the file size and type
/ $file - description file
/ return int {error number}
*/
public function ValidateFile($file)
{
    if (isset($file) && $file['size'] > 0)
        {
            if (is_uploaded_file($file['tmp_name']))
            {
                $file = getimagesize($file['tmp_name']);
                $file_size = $file['size'];
                if (!$file)
                {
                    return 5;
                }
                elseif ($file_size > 100000)
                {
                    return 8;
                }
                elseif (array_search($file['mime'], ['image/jpeg',
                                                    'image/jpg',
                                                    'image/png',
                                                    'image/gif']) === false)
                {
                    return 5;
                }
				return true;
            }
            else
            {
                return 9;
            }
        }
}

/*
/ init new PDO connect
/ return PDO object
*/
public function PDO()
{
    return new PDO($this->config['dsn'], $this->config['username'], $this->config['password']);
}

/*
/ Authorization User
/ $login - Login User
/ $pass- Password User
/ true -> init SESSION['user']['login'] = $login
/ return bool or json
*/
public function Auth($login, $pass)
{
    try
    {
        $pdo = $this->PDO();
        $stmt = $pdo->prepare('SELECT * FROM user WHERE user_password = :pass and user_login = :log');
        $stmt->execute(array('log' => $login, 'pass' => md5($pass)));
        if ($stmt->rowCount() == 1)
        {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user']['id'] = $result['user_id'];
            $_SESSION['user']['login'] = $result['user_login'];
            $_SESSION['user']['name'] = $result['user_name'];
            $_SESSION['user']['email'] = $result['user_email'];
            $_SESSION['user']['avatar'] = $result['user_avatar'];
            $_SESSION['user']['gender'] = $result['user_gender'];

            return true;
        }
        else
        {
            return false;
        }
    }
    catch(PDOException $err)
    {
        unset($_SESSION['user']);
        echo json_encode(['error' => 12]);
        exit;

    }
}

/*
/ Registration User
/ $login - Login User
/ $pass - Password User
/ $name - Name User
/ $gender -Gender User
/ $file - description file
/ true -> init SESSION['user']['login'] = $login
/ return bool or json
*/
public function Registration($login, $pass, $name, $email, $gender, $file)
{
    $avatar = '';
    if(!empty($file) && $file['size'] > 0)
    {
        if (is_uploaded_file($file['tmp_name']))
        {
        $tmp_name = getimagesize($file['tmp_name']);
        $mime = explode('/', $tmp_name['mime']);
        $avatar = $login. '.' . $mime[1];
        }
    }
    else
    {
        $avatar = 'default.jpg';
    }
    try
    {
        $pdo = $this->PDO();
        $stmt = $pdo->prepare('SELECT user_login
                               FROM user
                               WHERE user_login = :log');
        $stmt->execute(array('log' => $login));
        if ($stmt->rowCount() == 1)
        {
            echo json_encode(['error' => 7]);
            exit;
        }
        $sql = "INSERT INTO user (user_login, user_name, user_password, user_gender, user_email";
        $sql .= (empty($avatar) ? ") " : ", user_avatar) ");
        $sql .= "VALUES (:log, :name, :pass, :gender, :email" . (empty($avatar) ? ")" : ", :avatar)");
        $stmt = $pdo->prepare($sql);
        $params = array('log' => $login, 'name' => $name, 'pass' => md5($pass), 'gender' => $gender, 'email' => $email);
        (empty($avatar) ? '' : $params['avatar'] = $avatar);
        $stmt->execute($params);
        if ($stmt->rowCount()==1)
        {
            $_SESSION['user']['login'] = $login;
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['gender'] = $gender;
            $_SESSION['user']['avatar'] = $avatar;

            if(!empty($avatar))
            {
                move_uploaded_file($file['tmp_name'], __DIR__ . '/../image/' . $avatar);
            }
        }
        else
        {
           return 2;
        }
        return 5;
    }
    catch (PDOException $err)
    {
        echo json_encode(['error' => 12]);
        exit;
    }
}


/*
/ Update Profile User
/ $pass - Password User
/ $name - Name User
/ $gender -Gender User
/ $file - description file
/ return bool or json
*/
public function UpdateProfile($name, $email, $gender, $file)
{
    $avatar = '';
    if(!empty($file) && $file['size'] > 0)
    {
        if (is_uploaded_file($file['tmp_name']))
        {
        $tmp_name = getimagesize($file['tmp_name']);
        $mime = explode('/', $tmp_name['mime']);
        $avatar = $_SESSION['user']['login']. '.' . $mime[1];
        }
    }
    try
    {
        $pdo = $this->PDO();
        $sql = "Update  user SET user_name = :name, user_gender = :gender, user_email = :email ";
        $sql .= (empty($avatar) ? '' : ", user_avatar = :avatar ");
        $sql .= "WHERE user_login = :login ";
        $stmt = $pdo->prepare($sql);
        $params = array('name' => $name, 'gender' => $gender, 'email' => $email, 'login' => $_SESSION['user']['login']);
        (empty($avatar) ? '' : $params['avatar'] = $avatar);
        $stmt->execute($params);
        if ($stmt->rowCount()==1)
        {
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['gender'] = $gender;
            (empty($avatar) ? '' : $_SESSION['user']['avatar'] = $avatar);




            if(!empty($avatar))
            {
                move_uploaded_file($file['tmp_name'], __DIR__ . '/../image/' . $avatar);
            }
        }
        else
        {
           return false;
        }
        return true;
    }
    catch (PDOException $err)
    {
        echo json_encode(['error' => 12]);
        exit;
    }
}
}
