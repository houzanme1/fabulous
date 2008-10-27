package org.unisa.fab;

import java.io.*;
import java.util.*;
//import java.lang.Object.*;

import javax.servlet.*;
import javax.servlet.http.*;

/**
 * Servlet implementation class for Servlet: ProcessMetadataFormServlet
 *
 */
 public class ProcessMetadataFormServlet extends javax.servlet.http.HttpServlet implements javax.servlet.Servlet {
   static final long serialVersionUID = 1L;
   
   public final String DOCTYPE =
	    "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">"; 
   
   /* (non-Java-doc)
	 * @see javax.servlet.http.HttpServlet#HttpServlet()
	 */
	public ProcessMetadataFormServlet() {
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
		//TreeMap map= new TreeMap();
		
	    String body="";
	    String pid="";
	    Enumeration paramNames = request.getParameterNames();
	    while(paramNames.hasMoreElements()) {
	      String paramName = (String)paramNames.nextElement();
	      String[] paramValues = request.getParameterValues(paramName);
	      //  String paramValue = paramValues[0];
	        
       
	      if(paramName.compareTo("pid")==0)
	        {
	    	  	pid=paramValues[0];
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
        body = fed.processModifiedRecord(pid, marcxml.getMarcXML(), propertyPath, "Modified by Fabulous "+now.toString());
    
        /*
        // testing
        String pidnew=fed.getNextPid(pidNamespace);
        String marc= marcxml.getMarcXML();
        
        body= body+"<MARC>"+marc+"</MARC>";
		byte[] tempDc =fed.marc2dcTransform(propertyPath, marc,pidnew );
        String dc=new String(tempDc);
       
        //remove xml syntax out of the newly created xml
        dc=dc.substring(39);
        body= body+"<DC>"+dc+"</DC>";
        byte [] foxml = fed.writeFoxml(pidnew,  marc, dc, pidNamespace+now.toString());
        body= body+"<FOXML>"+new String(foxml)+"</FOXML>";
        String op=fed.ingestObject(foxml);
        body= body+"<OP>"+op+"</OP>";
        
        
        //
	    
	    //create foxml
	    //// create DC
	    //// get PID for the namespace 
	    //ingest foxml
        
        */
	    }
	    catch(FabulousException exception)
	    {
	    	body=exception.toString();
	    }
	    
	    
	    
	    
	    
	    
	    
	    RequestDispatcher rd = request.getRequestDispatcher("/result.jsp");
	    request.setAttribute("title", "Result Marcxml Edit Form");
        request.setAttribute("heading", "MarcXML for Record ");
	    request.setAttribute("body", body);
	    rd.forward(request, response);
	  }
	
	public String headWithTitle(String title) {
	    return(DOCTYPE + "\n" +
	           "<HTML>\n" +
	           "<HEAD><TITLE>" + title + "</TITLE></HEAD>\n");
	  }
   	  	    
}