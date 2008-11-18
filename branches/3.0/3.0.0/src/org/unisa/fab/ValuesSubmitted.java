/* 
 * Fabulous - Fedora/Arrow Batch Utility With Lots of User services
 * Copyright (C) 2008  University of South Australia, Library
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 * 
 */
package org.unisa.fab;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.Enumeration;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class for Servlet: ValuesSubmitted
 *
 */
 public class ValuesSubmitted extends javax.servlet.http.HttpServlet implements javax.servlet.Servlet {
   static final long serialVersionUID = 1L;
   
   public final String DOCTYPE =
	    "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">"; 
   
    /* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#HttpServlet()
	 */
	public ValuesSubmitted() {
		super();
	}   	
	
	/* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
	}  	
	
	/* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		// TODO Auto-generated method stub
		response.setContentType("text/html");
	    PrintWriter out = response.getWriter();
	    String title = "Reading All Request Parameters";
	    
	    out.println(headWithTitle(title)+
                "<BODY BGCOLOR=\"#FDF5E6\">\n" +
                "<H1 ALIGN=CENTER>" + title + "</H1>\n" +
                "<TABLE BORDER=1 ALIGN=CENTER>\n" +
                "<TR BGCOLOR=\"#FFAD00\">\n" +
                "<TH>Parameter Name<TH>Parameter Value(s)");
                
	    out.println(headWithTitle(title));
	    Enumeration paramNames = request.getParameterNames();
	    while(paramNames.hasMoreElements()) {
	        String paramName = (String)paramNames.nextElement();
	        out.println("<TR><TD>" + paramName + "\n<TD>");
	        String[] paramValues = request.getParameterValues(paramName);
	        if (paramValues.length == 1) {
	          String paramValue = paramValues[0];
	          if (paramValue.length() == 0)
	            out.print("<I>No Value</I>");
	          else
	            out.print(paramValue);
	        } else {
	          out.println("<UL>");
	          for(int i=0; i<paramValues.length; i++) {
	            out.println("<LI>" + paramValues[i]);
	          }
	          out.println("</UL>");
	        }
	      }
	      out.println("</TABLE>\n</BODY></HTML>");
	    }

	
	public String headWithTitle(String title) {
	    return(DOCTYPE + "\n" +
	           "<HTML>\n" +
	           "<HEAD><TITLE>" + title + "</TITLE></HEAD>\n");
	  }   	  	    
}