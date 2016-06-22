<%-- 
    Document   : show_users
    Created on : Jun 21, 2016, 11:29:30 AM
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
        <title>Show Users</title>
    </head>
    <body>
        <h1> Users </h1>
        <c:forEach var="user" items="${users}">             
             ${user} <br />
        </c:forEach>          
    </body>
</html>
