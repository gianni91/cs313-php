<%-- 
    Document   : sign_up
    Created on : Jun 21, 2016, 10:53:12 AM
    Author     : user
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sign up</title>
        <script>
            function goBack() {
               window.location.href = "sign_in.jsp";
            }
        </script>            
    </head>
    <body>
        <h1> Sign up </h1>
        <form action="add_user" method="POST">            
            Username:
            <input type="text" name="username" /> <br />
            Password:
            <input type="password" name="password" /> <br />
            Retype Password:
            <input type="password" name="verify_password" /> <br />            
            <input type="submit" value="Finish" />
        </form>  
        <button type="button" onClick="goBack()" > Cancel </button>
    </body>
</html>
