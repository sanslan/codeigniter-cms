<?php
class User_model extends CI_Model
{
 function login($username, $password)
 {
    $this -> db -> select('id, fullname, password, email');
    $this -> db -> from('users');
    $this -> db -> where('username', $username);
    $this -> db -> limit(1);

    $query = $this -> db -> get();
    $user = $query->row();
    if($user)
    {
        if(password_verify($password,$user->password))
        {
          return $user;
        }
        else
        {
          return false;
        }
    }

 }
}
?>