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
import java.util.Collections;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

       
/**
 *
 * @author user
 */
@WebServlet(name = "load_file", urlPatterns = {"/load_file"})
public class load_file extends HttpServlet {

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
            out.println("<title>Servlet load_file</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet load_file at " + request.getContextPath() + "</h1>");
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
        
        
  //      String dataDirectory = System.getenv("OPENSHIFT_DATA_DIR");        
        
        
            try {
// For the Openshift environment                
 //               BufferedReader myReader = new BufferedReader(new FileReader(dataDirectory + "/posts.txt"));                
                
// For the local environment                
                BufferedReader myReader = new BufferedReader(new FileReader("posts.txt"));


                List <Post> postList = new ArrayList <> ();
                String one_line;
                
                int numPosts = 0;
                int stage = 1;
                
                Post one_post = new Post();
                
                while ((one_line = myReader.readLine()) != null) {
                    if(stage == 1) {                       
                        one_post.setUsername(one_line);
                        one_post.setText(" ");
                        stage = 2;
                    } else if (stage == 2) {
                        one_post.setTime(one_line);                        
                        stage = 3;
                    } else if (stage == 3) {
                        if (one_line.equals("|||")) {
                            try{
                                Post temp_post = (Post) one_post.clone();
                                postList.add(temp_post);
                            } catch (CloneNotSupportedException ex) {
                                request.setAttribute("error", "Failed to copy the post");
                                request.getRequestDispatcher("/failPage.jsp").forward(request, response);                                    
                            }

                            stage = 1;
                        } else {
                            one_post.addText(one_line);                        
                            one_post.addText("<br />");                     
                        }
                    }
             
                    numPosts++;
                }

                try {
                    Collections.reverse(postList);
                } catch (UnsupportedOperationException e){
                    request.setAttribute("error", "Failed to reverse the list");
                    request.getRequestDispatcher("/failPage.jsp").forward(request, response);
                }

                request.setAttribute("posts", postList);
                request.getRequestDispatcher("/view_posts.jsp").forward(request, response);                    

            } catch (IOException ex) {
                request.setAttribute("error", "Failed to read");
                request.getRequestDispatcher("/failPage.jsp").forward(request, response);
            }

        
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
