/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package discussion_thread;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import java.io.BufferedWriter;
import java.io.BufferedReader;
import java.io.FileWriter;
import java.io.FileReader;
import java.util.ArrayList;
import java.util.List;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.io.*;

/**
 *
 * @author user
 */
@WebServlet(name = "create_post", urlPatterns = {"/create_post"})
public class create_post extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet create_post</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet create_post at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {   
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

            String user_post = request.getParameter("post_input");
            if (user_post.equals("|||") ) {
                request.setAttribute("error", "Not a valid post");
                request.getRequestDispatcher("/failPage.jsp").forward(request, response);                                
            }
            user_post = user_post.trim();
            String username = request.getSession().getAttribute("username").toString();

            Calendar c = Calendar.getInstance();
            SimpleDateFormat s = new SimpleDateFormat("h:mm a");

        // For the openshift environment
//        String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
//            try (BufferedWriter myWriter = new BufferedWriter(new FileWriter(dataDirectory + "/posts.txt", true))) {                
                
// Use this for the local environment                
            try (BufferedWriter myWriter = new BufferedWriter(new FileWriter("posts.txt", true))) {                
                myWriter.write(username + "\n" + s.format(c.getTime()) + "\n" + user_post);
                myWriter.newLine();
                myWriter.write("|||");
                myWriter.newLine();
                
                myWriter.close();
            } catch (IOException ex) {                
                request.setAttribute("error", "Failed to write");
                request.getRequestDispatcher("/failPage.jsp").forward(request, response);                
            }
            
            request.getRequestDispatcher("/load_file").forward(request, response);                
                           
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
