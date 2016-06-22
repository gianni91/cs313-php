<%-- 
    Document   : sign_in
    Created on : Jun 20, 2016, 11:15:34 AM
    Author     : user
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sign In</title>
        <script>
            // Uncomment the specified lines in check_login.jsp for the session
            //     to remember who is logged in
            if(${loggedIn} === true) {
                window.location = "enter_post.jsp";
            }

        </script>
    </head>
    <body>
        <form action="check_login" method="POST">
            <h1>Sign in </h1>           
            username: <input type="text" name="username" /><br />
            password: <input type ="password" name="password" /> <br />                            
            <input type="submit" value="Go" /><br />
        </form>
        <a href ="sign_up.jsp" > Sign up</a>
    </body>
</html>
