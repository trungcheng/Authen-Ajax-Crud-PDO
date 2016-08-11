<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Demo upload file</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    	<div class="col-md-4 col-md-offset-4" style="margin-top:50px;">
    		<form id="form">
    			<legend>Login to your account</legend>

                <div class="alert alert-danger" id="div-alert">
                    <p class="text-center"></p>
                </div>

    			<div class="form-group">
    				<label for="username">Username: </label>
    				<input type="text" class="form-control" id="username" name="username" />
                     <span id="username_error"></span>
    			</div>
    			<div class="form-group">
    				<label for="password">Password: </label>
    				<input type="password" class="form-control" id="password" name="password" />
                    <span id="password_error"></span>
    			</div>
    			<input type="button" id="btn" class="btn btn-primary" value="Login" />
    		</form>
    	</div>
    </body>
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#div-alert').hide();
        $('#form').keypress(function (event){
            if(event.which == 13){
                var username = $('#username').val();
                var password = $('#password').val();

                var flag = true;

                if (username == '' || username.length < 4){
                    $('#username_error').text('Tên đăng nhập không được trống và phải lớn hơn 4 ký tự !');
                    flag = false;
                }
                else{
                    $('#username_error').text('');
                }
                if (password.length <= 0){
                    $('#password_error').text('Mật khẩu không được trống !');
                    flag = false;
                }
                else{
                    $('#password_error').text('');
                }
                var url = "loginajax.php";
                if(flag){
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#form").serialize(),
                        success: function(data){
                            var user_array = [];
                            var user = JSON.parse(data);
                            user_array.push(user);
                            if(data.length == 2){
                                $('#div-alert').show().delay(2000).slideUp();
                                $('#div-alert p').text('Username or password wrong !');
                            }else{
                                if(sessionStorage["user"] == null){
                                    sessionStorage["user"] = user_array;
                                }
                                window.location = 'index.php';
                            }
                        }
                    });
                    return flag;
                };
            };
        });


        $('#btn').click(function (){
                var username = $('#username').val();
                var password = $('#password').val();

                var flag = true;

                if (username == '' || username.length < 4){
                    $('#username_error').text('Tên đăng nhập không được trống và phải lớn hơn 4 ký tự !');
                    flag = false;
                }
                else{
                    $('#username_error').text('');
                }
                if (password.length <= 0){
                    $('#password_error').text('Mật khẩu không được trống !');
                    flag = false;
                }
                else{
                    $('#password_error').text('');
                }
                var url = "loginajax.php";
                if(flag){
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#form").serialize(),
                        success: function(data){
                            var user_array = [];
                            var user = JSON.parse(data);
                            user_array.push(user);
                            if(data.length == 2){
                                $('#div-alert').show().delay(2000).slideUp();
                                $('#div-alert p').text('Username or password wrong !');
                            }else{
                                if(sessionStorage["user"] == null){
                                    sessionStorage["user"] = user_array;
                                }
                                window.location = 'index.php';
                            }
                        }
                    });
                    return flag;
                };
        });


    });
</script>
