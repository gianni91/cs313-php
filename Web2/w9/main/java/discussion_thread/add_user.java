/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package discussion_thread;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.util.List;
import java.util.ArrayList;
import java.lang.Object;

/**
 *
 * @author user
 */
@WebServlet(name = "add_user", urlPatterns = {"/add_user"})
public class add_user extends HttpServlet {

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
            out.println("<title>Servlet add_user</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet add_user at " + request.getContextPath() + "</h1>");
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
        String verify_password = request.getParameter("verify_password");   
        
        if (password.equals(verify_password)) {
            
            boolean uniqueUser = true;
// For the openShift environment         
//        String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");
//            try (BufferedReader myReader = new BufferedReader(new FileReader(dataDirectory + "/users.txt"))) {
                
// On the local computer                
            try (BufferedReader myReader = new BufferedReader(new FileReader("users.txt"))) {
                
                List <String> users = new ArrayList <> ();                
                String one_line;
                
                while ((one_line = myReader.readLine()) != null && uniqueUser == true) {
                    
                    String [] userPass;
                    userPass = one_line.split("\\|");                     
                    String user = userPass[0];                         
                        
                    if (userPass[0].equals(username)) {
                        uniqueUser = false;
                        request.setAttribute("error", "This username is already taken");
                        request.getRequestDispatcher("/failPage.jsp").forward(request, response);
                        return;
                    } else {
                        users.add(user);
                    }
                }
                
                // Uncomment this to see a list of the users                
//                request.setAttribute("users", users);
//                request.getRequestDispatcher("/show_users.jsp").forward(request, response);                                     
                                
            } catch (IOException ex) {
                request.setAttribute("error", "Failed to read");
                request.getRequestDispatcher("/failPage.jsp").forward(request, response);
                return;
            }            

            // Use this for the openshift directory 
 //           try (BufferedWriter myWriter = new BufferedWriter(new FileWriter(dataDirectory + "/users.txt", true))) {            
            try (BufferedWriter myWriter = new BufferedWriter(new FileWriter("users.txt", true))) {
                if(uniqueUser == true) {
                    myWriter.write(username + "|" + password);
                    myWriter.newLine();
                    myWriter.close();  
                }                
                
            } catch (IOException ex) {                
                request.setAttribute("error", "Failed to save username and password");
                request.getRequestDispatcher("/failPage.jsp").forward(request, response);                
                return;
            }



            //Automatic sign-in
            //To make it remember that you are logged in            
            request.getSession().setAttribute("loggedIn", "true");
            request.getSession().setAttribute("username", username);
            
            request.getRequestDispatcher("/enter_post.jsp").forward(request, response);

        } else {
            request.setAttribute("error", "Your passwords did not match");
            request.getRequestDispatcher("/failPage.jsp").forward(request, response);                                                            
            return;
        }
 
        
        processRequest(request, response);
        return; //ADDED
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
