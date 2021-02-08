<?php
require_once('models/User.php');
require_once('controllers/BaseController.php'); 
	class AuthController extends BaseController{
		public function login(){
			$this->view('auth/login.php');
		}
		public function logout(){
			$this->view('auth/logout.php');
		}
		public function handle(){
			$username = $_POST['username'];
			$pwd = $_POST['pwd'];
			$user_model = new User();
			$check = $user_model->check($username,$pwd);
			if ($check) {
				$_SESSION['login'] = true;
				setcookie('success', 'Login successfully !!!', time() + 2);
				$this->redirect('index.php?type=backend&mod=dashboard&act=index');
			}
			else {
				$_SESSION['login'] = false;
				setcookie('error', 'Wrong email or password !!!', time() + 2);
				$this->redirect('index.php?type=backend&mod=auth&act=login');
			}
	}
}
?>