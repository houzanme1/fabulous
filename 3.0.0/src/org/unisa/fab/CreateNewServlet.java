package org.unisa.fab;

import java.io.IOException;
/*
import java.io.PrintWriter;
import com.icl.saxon.exslt.Date;
*/
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
	       // String paramValue = paramValues[0];
	        
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
        body = fed.processNewRecord(pidNamespace, marcxml.getMarcXML(), propertyPath, pidNamespace+now.toString());
    
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
	    	body=body+exception.toString();
	    }
	    RequestDispatcher rd = request.getRequestDispatcher("/result.jsp");
	    request.setAttribute("title", "Create");
        request.setAttribute("heading", pidNamespace+" Database");
	    request.setAttribute("body", body);
	    rd.forward(request, response);
	}   	  	    
}