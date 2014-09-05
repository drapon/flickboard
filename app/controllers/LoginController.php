<?php

class LoginController extends BaseController {

	public function adduser($email,$password)
	{
		try {

			$user=Sentry::register(array(
	    		'email'    => $email,
	    		'password' => $password,
			));
			$activationCode = $user->getActivationCode();

			//メール送信
			$data['name'] = '林龍一';
			$data['activate'] = $activationCode;
			
			$user->email = $email;

 			Mail::send('emails.activate',$data,function($m) use ($user){
 			$m->to($user->email)->subject('仮登録：メールアドレスをご確認ください');
 			});
 			echo 'ユーザーが新しく作成されました';

		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    echo 'ユーザーは既に存在しています。';
		}


	}
	public function activate($activate)
	{
		try
		{
    		$user = Sentry::findUserByActivationCode($activate);

    		if ($user->attemptActivation($activate))
    		{
        		// User activation passed
        		echo 'ユーザーはアクティベートされました';
    		}
    		else
    		{
        		// User activation failed
        		echo 'アクティーベート失敗';
    		}
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
    		echo 'User was not found.';
		}
	}


	public function login($email,$password)
	{
		 try
		{
    // ログイン情報のセット
    $credentials = array(
        'email'    => $email,
        'password' => $password,
    );

    // 認証します。
    $user = Sentry::authenticate($credentials, false);
    echo 'ようこそ'.$user->email.'さん<br>';
    echo 'あなたのIDは'.$user->id.'です。';
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'ログインフィールドは必須です。';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'パスワードフィールドは必須です。';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'ユーザーが見つかりませんでした。';
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    echo 'ユーザーはアクティベートされていません。';
		}

		// The following is only required if throttle is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    echo 'ユーザー権限が停止されています。';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    echo '禁止ユーザーです。';
		}
	}

	public function user($email,$password)
	{
		try
		{
		    // Login credentials
		    $credentials = array(
		        'email'    => $username,
		        'password' => $password,
		    );

		    // Authenticate the user
		    $user = Sentry::authenticate($credentials, false);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    echo 'Wrong password, try again.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    echo 'User is not activated.';
		}

		// The following is only required if the throttling is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    echo 'User is suspended.';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    echo 'User is banned.';
		}
	}

}
