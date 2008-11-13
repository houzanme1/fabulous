package org.unisa.fab;

import java.io.IOException;
//import java.io.PrintWriter;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.*;

/**
 * Servlet implementation class for Servlet: DisplayMarcxmlAsFormServlet
 *
 */
 public class DisplayMarcxmlAsFormServlet extends javax.servlet.http.HttpServlet implements javax.servlet.Servlet {
   static final long serialVersionUID = 1L;
   
    /* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#HttpServlet()
	 */
	public DisplayMarcxmlAsFormServlet() {
		super();
	}   	
	
	/* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.setContentType("text/html;charset=UTF-8");
        String pid = request.getParameter("pid").toString();
        String tempV="";
        try
        {
       
     // get the servlet context
        ServletContext context = getServletContext();

        // directory name where the file is located
        String realPath = context.getRealPath("/WEB-INF/stylesheet");

        // get real path to your file
        String propertyPath = realPath+"/marc2htmlForm.xslt"; 

      FedoraInterface fed = new FedoraInterface(context.getRealPath("/WEB-INF/settings")+"/fabulous.properties",pid);
      
      byte[] temp = fed.getMarcDatastream();
      byte[] marc= fed.transformXML(temp, propertyPath);
        
        tempV= new String(marc);
        tempV= "<form action=\"ProcessMetadataFormServlet\" method=\"POST\"><div id=\"data\"><input type=\"submit\" class=\"button\" value=\"Update\"/></div>"+tempV+"<input type=\"hidden\" id=\"pid\" name=\"pid\" value="+pid+" /><div id=\"data\"><input type=\"submit\" class=\"button\" value=\"Update\"/></div></form>";
        }
        
        catch(FabulousException exception)
        {
        	tempV="<div class=\"error\"><error_text>"+exception.getError()+"</error_text><div class=\"error_message\"><error_message>"+exception.getMessage()+"</error_message></div></div>";
        }
        catch(Exception ex)
        {
        	tempV="<div class=\"error\">"+ex.getMessage()+"</div>";
        }
        

        RequestDispatcher rd = request.getRequestDispatcher("/result.jsp");
        request.setAttribute("title", "Marcxml Edit Form");
        request.setAttribute("heading", "MarcXML for Record "+pid);
	    request.setAttribute("body", tempV );
	    rd.forward(request, response);
		
	}  	
	
	/* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		
	}   	  	    
}