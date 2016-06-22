<%-- 
    Document   : enter_post
    Created on : Jun 20, 2016, 11:22:49 AM
    Author     : user
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Enter Post</title>
    </head>
    <body>
        <h1>Enter a Post</h1>
        <form action="create_post" method="POST">
            <textarea name="post_input"></textarea><br />
            <input type="submit" value="Add" />
        </form>
        <form action="load_file" method="POST">
            <input type="submit" value="View Posts" />
        </form>
    </body>
</html>
