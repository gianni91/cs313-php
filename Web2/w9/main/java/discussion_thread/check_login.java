/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package discussion_thread;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.List;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author user
 */
@WebServlet(name = "check_login", urlPatterns = {"/check_login"})
public class check_login extends HttpServlet {

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
            out.println("<title>Servlet check_login</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet check_login at " + request.getContextPath() + "</h1>");
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
        
        String username = request.getParameter("username");
        String password = request.getParameter("password");   
        
        boolean userFound = false;
        
//       String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
//        try (BufferedReader myReader = new BufferedReader(new FileReader(dataDirectory + "/users.txt"))) {                
        try (BufferedReader myReader = new BufferedReader(new FileReader("users.txt"))) {
                
            List <String> users = new ArrayList <> ();                
            String one_line;

            while ((one_line = myReader.readLine()) != null && userFound == false) {

                String [] userPass;
                userPass = one_line.split("\\|");                

                if (userPass[0].equals(username) && userPass[1].equals(password)) {
                    userFound = true;
                    
                    request.getSession().setAttribute("loggedIn", "true");
                    request.getSession().setAttribute("username", username);
            
                    request.getRequestDispatcher("/enter_post.jsp").forward(request, response);
                    return;
                } 
            }
            
            request.getRequestDispatcher("/invalid_login.jsp").forward(request, response);

        } catch (IOException ex) {
            request.setAttribute("error", "Failed to read");
            request.getRequestDispatcher("/failPage.jsp").forward(request, response);
        }               
        return;
        //processRequest(request, response);
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
