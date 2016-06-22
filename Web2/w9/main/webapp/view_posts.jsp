<%-- 
    Document   : view_posts
    Created on : Jun 20, 2016, 11:23:08 AM
    Author     : user
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.util.List" %>
<%@page import="java.util.ArrayList" %>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %> <!-- ? not sure what this is for -->

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>View Posts</title>
    </head>
    <body>
        <h1> Discussion Thread </h1>
        
        <form action="log_off" method="POST">
            <input type="submit" value="Log Out" /> <br />
            <a href="enter_post.jsp" >Add New</a>             
        </form>        
        <br />
        <br />
        <c:forEach var="post" items="${posts}">
             ${post.username} ${post.time}  <br />
             ${post.text} <br />
        </c:forEach>        

    </body>
</html>
