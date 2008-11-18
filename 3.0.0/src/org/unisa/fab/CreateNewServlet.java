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
import java.util.Enumeration;
import java.util.Hashtable;
import java.util.Date;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;



/**
 * Servlet implementation class for Servlet: CreateNewServlet
 *
 */
 public class CreateNewServlet extends javax.servlet.http.HttpServlet implements javax.servlet.Servlet {
   static final long serialVersionUID = 1L;
   
    /* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#HttpServlet()
	 */
	public CreateNewServlet() {
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
		response.setContentType("text/html");
	    
	    Hashtable hash= new Hashtable();
	    Enumeration paramNames = request.getParameterNames();
	    String pidNamespace="";
	    String body="";
	    while(paramNames.hasMoreElements()) 
	    {
	      String paramName = (String)paramNames.nextElement();     
	      String[] paramValues = request.getParameterValues(paramName);
	        
	        if(paramName.compareTo("pidNamespace")==0)
	        {
	        pidNamespace=paramValues[0];
	        }
	        else
	        {
    	   hash.put(paramName, paramValues[0]);
	        }
	    }
	    
	    try
	    {
	    MarcXML marcxml= new MarcXML(hash);	    
	    ServletContext context = getServletContext();
        String realPath = context.getRealPath("/WEB-INF/stylesheet");
        String propertyPath = realPath+"/marc2dc.xslt"; 
        FedoraInterface fed = new FedoraInterface(context.getRealPath("/WEB-INF/settings")+"/fabulous.properties");
        Date now= new Date();
       // body = fed.processNewRecord(pidNamespace, marcxml.getMarcXML(), propertyPath, pidNamespace+now.toString());
        body = fed.processNewRecord(marcxml.getMarcXML(), propertyPath, pidNamespace+now.toString());
    
       
	    }
	    catch(FabulousException exception)
	    {
	    	body=body+exception.toString();
	    }
	    RequestDispatcher rd = request.getRequestDispatcher("/result.jsp");
	    request.setAttribute("title", "Create");
        request.setAttribute("heading", pidNamespace+" Database");
	    request.setAttribute("body", body);
	    rd.forward(request, response);
	}   	  	    
}